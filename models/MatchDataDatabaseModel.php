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
      return (new MatchData($result));
    return false;
  }
}
?>
