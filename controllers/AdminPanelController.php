<?php
	class AdminPanelController extends Controller{
		$ini = parse_ini_file("./config.ini");
		
		$auth = "Authorization: Basic " . base64_encode($ini['api_user']. ":".$ini['api_token']); 
		
		$opts = array(
			'http'=>array(
				'method'=>"GET",
				'header'=> $auth . "\r\n" . "Accept: application/json"
				)
			);
			
		$context = stream_context_create($opts);
		
		public function loadSchedule($eventcode){
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
				 $alliances = $match["Teams"];
				 //var_dump($alliances);
				 $red1Teams=  $alliances[0];
				 $red2Teams=  $alliances[1];
				 $red3Teams=  $alliances[2];
				 $blue1Teams= $alliances[3];
				 $blue2Teams= $alliances[4];
				 $blue3Teams= $alliances[5];
								 
				 $matchNumber = $match["matchNumber"];
				 $time = $match["startTime"];
				 
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
   
    
    
?>
