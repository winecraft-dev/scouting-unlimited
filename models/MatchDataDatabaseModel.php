<?php
class MatchDataDatabaseModel extends DatabaseModel
{
  public function getMatchData($match_number, $team_number)
  {
    $query = self::$conn->prepare("SELECT * FROM match_data " .
        "WHERE match_number=:match_number AND team_number=:team_number LIMIT 1");
    $query->bindValue(':match_number', $match_number);
    $query->bindValue(':team_number', $team_number);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    if($result !== false)
      return MatchData::databaseDecode($result);
    return false;
  }
  
  public function getTeamMatchData($team_number)
  {
    $query = self::$conn->prepare("SELECT * FROM match_data " .
        "WHERE team_number=:team_number");
    $query->bindValue(':team_number', $team_number);
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    if($result === false)
      return false;
      
    $matchData = array();
    
    foreach($results as $result)
    {
      $matchData[] = MatchData::databaseDecode($result);
    }
    return $matchData;
  } 
  
  public function dataEntry($team_number, $match_number, $dead, $dead_shortly, 
      $auto_boolean_1, $auto_boolean_2, $auto_boolean_3, $auto_boolean_4, $auto_boolean_5, 
      $auto_boolean_6, $auto_boolean_7, $auto_boolean_8, $auto_boolean_9, $auto_boolean_10, 
      $auto_number_1, $auto_number_2, $auto_number_3, $auto_number_4, $auto_number_5, 
      $auto_number_6, $auto_number_7, $auto_number_8, $auto_number_9, $auto_number_10, 
      $teleop_boolean_1, $teleop_boolean_2, $teleop_boolean_3, $teleop_boolean_4, 
      $teleop_boolean_5, $teleop_boolean_6, $teleop_boolean_7, $teleop_boolean_8, 
      $teleop_boolean_9, $teleop_boolean_10, $teleop_number_1, $teleop_number_2, 
      $teleop_number_3, $teleop_number_4, $teleop_number_5, $teleop_number_6, $teleop_number_7, 
      $teleop_number_8, $teleop_number_9, $teleop_number_10, $end_boolean_1, $end_boolean_2, 
      $end_boolean_3, $end_boolean_4, $end_boolean_5, $end_boolean_6, $end_boolean_7, 
      $end_boolean_8, $end_boolean_9, $end_boolean_10, $end_number_1, $end_number_2, 
      $end_number_3, $end_number_4, $end_number_5, $end_number_6, $end_number_7, $end_number_8, 
      $end_number_9, $end_number_10, $comment_text_1, $comment_text_2, $comment_text_3, $comment_text_4, $comment_text_5)
  {
    $query = self::$conn->prepare("INSERT INTO match_data SET " . 
		    "team_number = :team_number, " .
		    "match_number = :match_number, " .
		    "dead = :dead, " .
		    "dead_shortly = :dead_shortly, " .
		    "auto_boolean_1 = :auto_boolean_1, " .
		    "auto_boolean_2 = :auto_boolean_2, " .
		    "auto_boolean_3 = :auto_boolean_3, " .
		    "auto_boolean_4 = :auto_boolean_4, " .
		    "auto_boolean_5 = :auto_boolean_5, " .
		    "auto_boolean_6 = :auto_boolean_6, " .
		    "auto_boolean_7 = :auto_boolean_7, " .
		    "auto_boolean_8 = :auto_boolean_8, " .
		    "auto_boolean_9 = :auto_boolean_9, " .
		    "auto_boolean_10 = :auto_boolean_10, " .
		    "auto_number_1 = :auto_number_1, " .
		    "auto_number_2 = :auto_number_2, " . 
		    "auto_number_3 = :auto_number_3, " .
		    "auto_number_4 = :auto_number_4, " .
		    "auto_number_5 = :auto_number_5, " .
		    "auto_number_6 = :auto_number_6, " .
		    "auto_number_7 = :auto_number_7, " . 
		    "auto_number_8 = :auto_number_8, " .
		    "auto_number_9 = :auto_number_9, " .
		    "auto_number_10 = :auto_number_10, " . 
		    "teleop_boolean_1 = :teleop_boolean_1, " .
		    "teleop_boolean_2 = :teleop_boolean_2, " .
		    "teleop_boolean_3 = :teleop_boolean_3, " .
		    "teleop_boolean_4 = :teleop_boolean_4, " .
		    "teleop_boolean_5 = :teleop_boolean_5, " .
		    "teleop_boolean_6 = :teleop_boolean_6, " .
		    "teleop_boolean_7 = :teleop_boolean_7, " .
		    "teleop_boolean_8 = :teleop_boolean_8, " .
		    "teleop_boolean_9 = :teleop_boolean_9, " .
		    "teleop_boolean_10 = :teleop_boolean_10, " .
		    "teleop_number_1 = :teleop_number_1, " .
		    "teleop_number_2 = :teleop_number_2, " .
		    "teleop_number_3 = :teleop_number_3, " .
		    "teleop_number_4 = :teleop_number_4, " .
		    "teleop_number_5 = :teleop_number_5, " .
		    "teleop_number_6 = :teleop_number_6, " .
		    "teleop_number_7 = :teleop_number_7, " .
		    "teleop_number_8 = :teleop_number_8, " .
		    "teleop_number_9 = :teleop_number_9, " .
		    "teleop_number_10 = :teleop_number_10, " .
		    "end_boolean_1 = :end_boolean_1, " .
		    "end_boolean_2 = :end_boolean_2, " .
		    "end_boolean_3 = :end_boolean_3, " .
		    "end_boolean_4 = :end_boolean_4, " .
		    "end_boolean_5 = :end_boolean_5, " .
		    "end_boolean_6 = :end_boolean_6, " .
		    "end_boolean_7 = :end_boolean_7, " .
		    "end_boolean_8 = :end_boolean_8, " .
		    "end_boolean_9 = :end_boolean_9, " .
		    "end_boolean_10 = :end_boolean_10, " .
		    "end_number_1 = :end_number_1, " .
		    "end_number_2 = :end_number_2, " .
		    "end_number_3 = :end_number_3, " .
		    "end_number_4 = :end_number_4, " .
		    "end_number_5 = :end_number_5, " .
		    "end_number_6 = :end_number_6, " .
		    "end_number_7 = :end_number_7, " .
		    "end_number_8 = :end_number_8, " .
		    "end_number_9 = :end_number_9, " .
		    "end_number_10 = :end_number_10, " .
		    "comment_text_1 = :comment_text_1, " .
		    "comment_text_2 = :comment_text_2, " .
		    "comment_text_3 = :comment_text_3, " .
		    "comment_text_4 = :comment_text_4, " .
		    "comment_text_5 = :comment_text_5");
		$query->bindValue(':team_number', $team_number);
		$query->bindValue(':match_number', $match_number);
		$query->bindValue(':dead', $dead);
		$query->bindValue(':dead_shortly', $dead_shortly);
		$query->bindValue(':auto_boolean_1', $auto_boolean_1);
		$query->bindValue(':auto_boolean_2', $auto_boolean_2);
		$query->bindValue(':auto_boolean_3', $auto_boolean_3);
		$query->bindValue(':auto_boolean_4', $auto_boolean_4);
		$query->bindValue(':auto_boolean_5', $auto_boolean_5);
		$query->bindValue(':auto_boolean_6', $auto_boolean_6);
		$query->bindValue(':auto_boolean_7', $auto_boolean_7);
		$query->bindValue(':auto_boolean_8', $auto_boolean_8);
		$query->bindValue(':auto_boolean_9', $auto_boolean_9);
		$query->bindValue(':auto_boolean_10', $auto_boolean_10);
		$query->bindValue(':auto_number_1', $auto_number_1);
		$query->bindValue(':auto_number_2', $auto_number_2);
		$query->bindValue(':auto_number_3', $auto_number_3);
		$query->bindValue(':auto_number_4', $auto_number_4);
		$query->bindValue(':auto_number_5', $auto_number_5);
		$query->bindValue(':auto_number_6', $auto_number_6);
		$query->bindValue(':auto_number_7', $auto_number_7);
		$query->bindValue(':auto_number_8', $auto_number_8);	
		$query->bindValue(':auto_number_9', $auto_number_9);
		$query->bindValue(':auto_number_10', $auto_number_10);
		$query->bindValue(':teleop_boolean_1', $teleop_boolean_1);
		$query->bindValue(':teleop_boolean_2', $teleop_boolean_2);
		$query->bindValue(':teleop_boolean_3', $teleop_boolean_3);
		$query->bindValue(':teleop_boolean_4', $teleop_boolean_4);
		$query->bindValue(':teleop_boolean_5', $teleop_boolean_5);
		$query->bindValue(':teleop_boolean_6', $teleop_boolean_6);
		$query->bindValue(':teleop_boolean_7', $teleop_boolean_7);
		$query->bindValue(':teleop_boolean_8', $teleop_boolean_8);
		$query->bindValue(':teleop_boolean_9', $teleop_boolean_9);
		$query->bindValue(':teleop_boolean_10', $teleop_boolean_10);
		$query->bindValue(':teleop_number_1', $teleop_number_1);
		$query->bindValue(':teleop_number_2', $teleop_number_2);
		$query->bindValue(':teleop_number_3', $teleop_number_3);
		$query->bindValue(':teleop_number_4', $teleop_number_4);
		$query->bindValue(':teleop_number_5', $teleop_number_5);
		$query->bindValue(':teleop_number_6', $teleop_number_6);
		$query->bindValue(':teleop_number_7', $teleop_number_7);
		$query->bindValue(':teleop_number_8', $teleop_number_8);
		$query->bindValue(':teleop_number_9', $teleop_number_9);
		$query->bindValue(':teleop_number_10', $teleop_number_10);
		$query->bindValue(':end_boolean_1', $end_boolean_1);
		$query->bindValue(':end_boolean_2', $end_boolean_2);
		$query->bindValue(':end_boolean_3', $end_boolean_3);
		$query->bindValue(':end_boolean_4', $end_boolean_4);
		$query->bindValue(':end_boolean_5', $end_boolean_5);
		$query->bindValue(':end_boolean_6', $end_boolean_6);
		$query->bindValue(':end_boolean_7', $end_boolean_7);
		$query->bindValue(':end_boolean_8', $end_boolean_8);	
		$query->bindValue(':end_boolean_9', $end_boolean_9);
		$query->bindValue(':end_boolean_10', $end_boolean_10);
		$query->bindValue(':end_number_1', $end_number_1);
		$query->bindValue(':end_number_2', $end_number_2);
		$query->bindValue(':end_number_3', $end_number_3);
		$query->bindValue(':end_number_4', $end_number_4);
		$query->bindValue(':end_number_5', $end_number_5);
		$query->bindValue(':end_number_6', $end_number_6);
		$query->bindValue(':end_number_7', $end_number_7);
		$query->bindValue(':end_number_8', $end_number_8);
		$query->bindValue(':end_number_9', $end_number_9);
		$query->bindValue(':end_number_10', $end_number_10);
		$query->bindValue(':comment_text_1', $comment_text_1);
		$query->bindValue(':comment_text_2', $comment_text_2);
		$query->bindValue(':comment_text_3', $comment_text_3);	
		$query->bindValue(':comment_text_4', $comment_text_4);
		$query->bindValue(':comment_text_5', $comment_text_5);
		if(!$query->execute()) return false;
  }
}
?>
