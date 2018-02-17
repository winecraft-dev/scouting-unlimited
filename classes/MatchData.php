<?php
class MatchData
{  
  public $team_number;
  public $match_number;
  
  public $scout;
  
  public $dead;
  public $dead_shortly;
  
  //the associative array that all of the datasets go into
  public $data;
  
  public function __construct()
  {   
    $this->team_number = -1;
    $this->match_number = -1;
    
    $this->scout = -1;
    
    $this->dead = -1;
    $this->dead_shortly = -1;
    
    $this->data = array();
  }
  
  public static function jsonDecode($string)
  {
    $array = json_decode($string, true);
    
    $matchData = (new MatchData());
    
    $matchData->team_number = $array['team_number'];
    $matchData->match_number = $array['match_number'];
    
    $matchData->scout = Session::getLoggedInUser()->id;
    
    $matchData->dead = $array['dead'];
    $matchData->dead_shortly = $array['dead_shortly'];
    
    $matchData->data = $array['data'];
    
    return $matchData;
  }
  
  public static function databaseDecode($data)
  {
    $matchData = (new MatchData());
    
    $matchData->team_number = $data['team_number'];
    $matchData->match_number = $data['match_number'];
    
    $matchData->scout = $data['scout'];
    
    $matchData->dead = $data['dead'];
    $matchData->dead_shortly = $data['dead_shortly'];
    
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
    
    $matchData['team_number'] = $this->team_number;
    $matchData['match_number'] = $this->match_number;
    
    $matchData['scout'] = $this->scout;
    
    $matchData['dead'] = $this->dead;
    $matchData['dead_shortly'] = $this->dead_shortly;
    
    $matchData['data'] = $this->data;
    
    return $matchData;
  }
  
  public function getScout()
  {
    (new UserDatabaseModel())->getFromId($this->scout);
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
        return 'comment';
    }
  }
}

