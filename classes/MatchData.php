<?php
class MatchData
{
  public $id;
  
  public $team_number;
  public $match_number;
  
  //the associative array that all of the datasets go into
  public $data;
  
  public function __construct($data)
  {
    $this->id = $data['id'];
    
    $this->team_number = $data['team_number'];
    $this->match_number = $data['match_number'];
    
    $definitions = (new DataDefinitionsDatabaseModel())->getDataDefinitions();
    
    $this->data = array();
    
    if($definitions === false)
      return false;
    
    foreach($definitions as $definition)
    {
      $section = self::getSection($definition['section']);
      $data_type = self::getDataType($definition['data_type']);
      $number = $definition['number'];
      
      $this->data[] = [$definition['title'] => $data[$section . '_' . $data_type . '_' . $number]];
    }
  }
  
  public function getTeam()
  {
    (new TeamsDatabaseModel())->getTeam($this->team_number);
  }
  
  public function getMatch()
  {
    (new MatchScheduleDatabaseModel())->getMatch($this->match_number);
  }
  
  public function encode()
  {
    $matchData = array();
    
    $matchData['id'] = $this->id;
    
    $matchData['team_number'] = $this->team_number;
    $matchData['match_number'] = $this->match_number;
    
    $matchData['data'] = $this->data;
    
    return json_encode($matchData);
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

