<?php
include("read_ini.php");
class MatchScheduleDatabaseModel{
	
	public function loadSchedule($eventcode){
			$auth = "Authorization: Basic " . base64_encode($ini['api_user']. ":".$ini['api_token']); 
		
			$opts = array(
				'http'=>array(
					'method'=>"GET",
					'header'=> $auth . "\r\n" . "Accept: application/json"
				)
			);
			
			$dbhost = $ini['dbhost'];
			$dbname = $ini['dbname'];
			$dbuser = $ini['dbuser'];
			$dbpass = $ini['dbpass'];
	
			$mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

			$context = stream_context_create($opts);
			$url="https://frc-api.firstinspires.org/v2.0/2017/schedule/".$eventCode."?tournamentLevel=qualification";
			$response = file_get_contents($url,false,$context);
			$json = json_decode($response, true);
			//echo json_encode($json[teams], JSON_PRETTY_PRINT);
			$query = "TRUNCATE TABLE schedule";
			$result = $mysqli->query($query);

			 foreach ($json as $schedule)
			 {	
				 //var_dump($schedule);
				 
				 foreach ($schedule as $match)
				 { 
					$matchNumber = $match["matchNumber"];
					$time = $match["startTime"];
					
				 	$alliances = $match["Teams"];
				 	//var_dump($alliances);
				 	$red1Teams=  $alliances[0];
					$red2Teams=  $alliances[1];
					$red3Teams=  $alliances[2];
					$blue1Teams= $alliances[3];
					$blue2Teams= $alliances[4];
					$blue3Teams= $alliances[5];
					
					$Red1 = $red1Teams["teamNumber"];
					$Red2 = $red2Teams["teamNumber"];
					$Red3 = $red3Teams["teamNumber"];
					$Blue1 = $blue1Teams["teamNumber"];
					$Blue2 = $blue2Teams["teamNumber"];
					$Blue3 = $blue3Teams["teamNumber"];
					
					$query2 = "INSERT INTO schedule (match_number,time,red_1,red_2,red_3,blue_1,blue_2,blue_3) 
					VALUES ('$matchNumber','$time','$Red1','$Red2','$Red3','$Blue1','$Blue2','$Blue3')";
					$result2 = $mysqli->query($query2);
				 }
		}

		
	}
	public function getAllMatches(){
		//get All Matches
	}
	public function getMatchByTeam($team){
		
		$dbhost = $ini['dbhost'];
		$dbname = $ini['dbname'];
		$dbuser = $ini['dbuser'];
		$dbpass = $ini['dbpass'];

		$mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

		$query1 = "SELECT 'match_number','time','red_1,'red_2','red_3','blue_1','blue_2','blue_3' FROM schedule
		 ORDER BY match_number ASC";
		$result=$mysqli->query(query1);

		$certainMatches = array();

		foreach($result as $match ){
			foreach($match as $m){
				if($m==$team){
					array_push($certainMatches,$match['match_number']);
				}
			}
		}
		return $certainMatches;
	}
}
 ?>