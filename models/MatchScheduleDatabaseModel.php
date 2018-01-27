<?php
class MatchScheduleDatabaseModel extends DatabaseModel
{
	//USE THE ABSTRACT CLASS
	
  public function getMatch($match_number)
  {
    $query = self::$conn->prepare("SELECT schedule.*
        FROM teams WHERE match_number=:match_number LIMIT 1");
    $query->bindValue(':match_number', $match_number);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    if($result !== false)
      return (new Match($result));
    return false;
  }
  
  public function loadMatchesFromApi($eventCode)
  {
    $query = self::$conn->prepare("DELETE FROM schedule");
		$query->execute();

		$query6 = self::$conn->prepare("DELETE FROM match_data");
		$query6->execute();

		$query3 = self::$conn->prepare("DELETE FROM regional");
		$query3->execute();
		
		$query4 = self::$conn->prepare("INSERT INTO regional (eventCode) VALUES ('$eventCode')");
		$query4->bindValue(':code', $eventCode, PDO::PARAM_STR);
		$query4->execute();
		
    $config = $GLOBALS['config'];
		
		$auth = "Authorization: Basic " . base64_encode($config->get('api_key') . ':' . $config->get('api_password')); 
		$opts = array(
			'http'=>array(
			'method'=>"GET",
			'header'=> $auth . "\r\n" . "Accept: application/json"
			)
		);
		
		$context = stream_context_create($opts);
		$url = "https://frc-api.firstinspires.org/v2.0/2017/schedule/" . $eventCode . "?tournamentLevel=qual";
		$response = file_get_contents($url, false, $context);
		$json = json_decode($response, true);
		
		foreach ($json as $schedule)
		{
			foreach($schedule as $match)
			{
				$alliances = $match["Teams"];
				$red1Teams = $alliances[0];
				$red2Teams = $alliances[1];
				$red3Teams = $alliances[2];
				$blue1Teams = $alliances[3];
				$blue2Teams = $alliances[4];
				$blue3Teams = $alliances[5];
							
				$matchNumba = $match["matchNumber"];
				$time = $match["startTime"];
			
				$Red1 = $red1Teams["teamNumber"];
				$Red2 = $red2Teams["teamNumber"];
				$Red3 = $red3Teams["teamNumber"];
				$Blue1 = $blue1Teams["teamNumber"];
				$Blue2 = $blue2Teams["teamNumber"];
				$Blue3 = $blue3Teams["teamNumber"];
			
				$query2 = self::$conn->prepare("INSERT INTO schedule (match_number,time,red_1,red_2,red_3,blue_1,blue_2,blue_3) VALUES ('$matchNumba','$time','$Red1','$Red2','$Red3','$Blue1','$Blue2','$Blue3')");
				$query2->execute();
			}
		}
  }
}
?>
