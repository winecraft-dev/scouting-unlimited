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
    $definitions = (new DataDefinitionsDatabaseModel())->getDataDefinitions();
    
    $this->averages = array();
    
    if($definitions === false)
      return false;
      
    foreach($definitions as $definition)
    {
      
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
  
  public function calculateAverages()
  {
    $matchData = $this->getMatchData();
    
    
  }
}
