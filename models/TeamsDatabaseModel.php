<?php
class TeamsDatabaseModel extends DatabaseModel
{
  public function getTeam($number)
  {
    $query = self::$conn->prepare("SELECT teams.*
        FROM teams WHERE number=:number LIMIT 1");
    $query->bindValue(':number', $number);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    if($result !== false)
      return (new Team($result));
    return false;
  }
  
  public function getTeams()
  {
    $query = self::$conn->prepare("SELECT teams.* FROM teams");
    $query->execute();

    $teams = array();
    
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
    if($results === false)
      return false;
    
    foreach($results as $result)
    {
      $teams[] = (new Team($result));
    }
    return $teams;
  }
  
  public function editTeam($team, $key, $value)
  {
    $query = self::$conn->prepare('UPDATE teams SET ' . $key . '=:value WHERE number=:number');
    $query->bindValue(':number', $team);
    $query->bindValue(':key', $key);
    $query->bindValue(':value', $value);
    return ($query->execute());
  }
  
  public function loadTeamsFromApi($eventCode)
  {
    $query1 = self::$conn->prepare("DELETE FROM schedule");
		$query1->execute();

		$query2 = self::$conn->prepare("DELETE FROM teams");
		$query2->execute();

		$query3 = self::$conn->prepare("DELETE FROM match_data");
		$query3->execute();

		$query4 = self::$conn->prepare("DELETE FROM regional");
		$query4->execute();
		
		$query6 = self::$conn->prepare("INSERT INTO regional (eventCode) VALUES ('$eventCode')");
		$query6->bindValue(':code', $eventCode, PDO::PARAM_STR);
		$query6->execute();
		
		$config = $GLOBALS['config'];
		
		$auth = "Authorization: Basic " . base64_encode($config->get('api_key') . ':' . $config->get('api_password')); 
		$opts = array(
			'http'=>array(
			  'method'=>"GET",
			  'header'=> $auth . "\r\n" . "Accept: application/json"
			)
		);
		$context = stream_context_create($opts);
		$url = "https://frc-api.firstinspires.org/v2.0/2017/teams?eventCode=". $eventCode . "&state=state";
		$response = file_get_contents($url,false,$context);
		$json = json_decode($response, true);
		
		foreach ($json["teams"] as $team)
		{	
			//var_dump($team);
			$teamName = $team["nameShort"];
			$teamNumber = $team["teamNumber"];
		
			
			$query7 = self::$conn->prepare('INSERT INTO teams SET ' .
			'number = :num, ' .
			'name = :name');
			$query7->bindValue(':num', $teamNumber, PDO::PARAM_INT);
			$query7->bindValue(':name', $teamName, PDO::PARAM_INT);
			if(!$query7->execute()) return false;
		}
  }
}
