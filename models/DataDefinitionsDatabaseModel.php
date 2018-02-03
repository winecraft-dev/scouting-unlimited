<?php
class DataDefinitionsDatabaseModel extends DatabaseModel
{
  public function getDataDefinitions()
  {
    $query = self::$conn->prepare("SELECT data_definitions.*
        FROM data_definitions");
    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if($result !== false)
      return $result;
    return false;
  }
  
  public function getAverageDefinitions()
  {
    $query = self::$conn->prepare("SELECT average_definitions.*
        FROM average_definitions");
    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if($result !== false)
      return $result;
    return false;
  }
}
?>
