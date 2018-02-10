<?php
class Team 
{
  public $number;
  public $name;
  
  public $pit_notes;
  
  public $averages;
  
  public function __construct($data)
  {
    $this->number = $data['number'];
    $this->name = $data['name'];
    
    $this->pit_notes = $data['pit_notes'];
    
    //figure out averages when we get the averaging methods
    $definitions = (new DataDefinitionsDatabaseModel())->getAverageDefinitions();
    
    $this->averages = array();
    
    if($definitions === false)
      return false;
      
    foreach($definitions as $definition)
    {
      $section = self::getSection($definition['section']);
      $data_type = self::getDataType($definition['data_type']);
      $number = $definition['number'];
      
      $this->averages[] = [$definition['title'] => [$data[$section . '_' . $data_type . '_' . $number]]];
    }
  }
  
  public function getMatches()
  {
    return (new MatchScheduleDatabaseModel())->getMatchesByTeam($this->number);
  }
  
  public function getMatchData()
  {
    return (new MatchDataDatabaseModel())->getTeamMatchData($this->number);
  }
  
  public function makeArray()
  {
    $team = array();
    
    $team['number'] = $this->number;
    $team['name'] = $this->name;
    
    $team['pit_notes'] = $this->pit_notes;
    
    $team['averages'] = $this->averages;
    
    return $team;
  }
  
  public function getAverage($index)
  {
    return $this->averages[$index];
  }
  
  public function updateAverages()
  {
    $matchData = $this->getMatchData();
    
    $averageDefinitions = (new DataDefinitionsDatabaseModel())->getAverageDefinitions();
    
    foreach($averageDefinitions as $definition)
    {
      $formula = $definition['formula'];
      
      $section = self::getSection($definition['section']);
      $data_type = self::getDataType($definition['data_type']);
      $number = $definition['number'];
      
      $value;
      
      (new TeamsDatabaseModel())->editTeam($this->number, $section . '_' . $data_type . '_' . $number, $value);
    }
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
