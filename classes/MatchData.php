<?php
class MatchData
{
  public $id;
  
  public $team_number;
  public $match_number;
  
  //the associative array that all of the datasets go into
  public $data;
  
  public function __construct()
  {
    $this->id = -1;
    
    $this->team_number = -1;
    $this->match_number = -1;
    
    $this->data = array();
  }
  
  public static function jsonDecode($string)
  {
    $array = json_decode($string, true);
    
    var_dump($array);
    $matchData = (new MatchData());
    
    $matchData->id = $array['id'];
    
    $matchData->team_number = $array['team_number'];
    $matchData->match_number = $array['match_number'];
    
    $matchData->data = $array['data'];
    
    return $matchData;
  }
  
  public static function databaseDecode($data)
  {
    $matchData = (new MatchData());
    
    $matchData->id = $data['id'];
    
    $matchData->team_number = $data['team_number'];
    $matchData->match_number = $data['match_number'];
    
    $definitions = (new DataDefinitionsDatabaseModel())->getDataDefinitions();
    
    $matchData->data = array();
    
    if($definitions === false)
      return false;
    
    foreach($definitions as $definition)
    {
      $section = self::getSection($definition['section']);
      $data_type = self::getDataType($definition['data_type']);
      $number = $definition['number'];
      
      $matchData->data[] = [$definition['title'] => $data[$section . '_' . $data_type . '_' . $number]];
    }
    return $matchData;
  }
  
  public function makeArray()
  {
    $matchData = array();
    
    $matchData['id'] = $this->id;
    
    $matchData['team_number'] = $this->team_number;
    $matchData['match_number'] = $this->match_number;
    
    $matchData['data'] = $this->data;
    
    return $matchData;
  }
  
  public function getTeam()
  {
    (new TeamsDatabaseModel())->getTeam($this->team_number);
  }
  
  public function getMatch()
  {
    (new MatchScheduleDatabaseModel())->getMatch($this->match_number);
  }
  
  public function getData($index)
  {
    return $this->data[$index];
  }
  
  public static function getSection($number)
  {
    switch($number)
    {
      case 0:
        return 'auto';
      case 1:
        return 'teleop';
      case 2:
        return 'end';
      case 3:
        return 'comment';
    }
  }
  
  public static function getDataType($number)
  {
    switch($number)
    {
      case 0:
        return 'boolean';
      case 1:
        return 'number';
      case 2:
        return 'text';
    }
  }
}

