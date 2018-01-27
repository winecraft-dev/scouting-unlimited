<?php
class TeamDatabaseModel extends DatabaseModel
{
  public function getFromNumber($number)
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
}
