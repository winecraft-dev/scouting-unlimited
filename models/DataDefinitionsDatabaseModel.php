<?php
class DataDefinitionsDatabaseModel extends DatabaseModel
{
  public function getDataDefinitions()
  {
    $query = self::$conn->prepare("SELECT data_definitions.*
        FROM data_definitions LIMIT 1");
    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if($result !== false)
      return $result;
    return false;
  }
}
?>
