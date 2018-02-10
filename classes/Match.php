<?php
class Match
{
  public $match_number;
  public $time;
  
  public $red_1;
  public $red_2;
  public $red_3;
  public $blue_1;
  public $blue_2;
  public $blue_3;
  
  //create the Match Object from MatchDatabaseModel data
  //appropriate call: 
  //(new Match((new ScheduleDatabaseModel())->getFromNumber($match_number)))
  public function __construct($data)
  {
    $this->match_number = $data['match_number'];
    $this->time = $data['time'];
    
    $this->red_1 = $data['red_1'];
    $this->red_2 = $data['red_2'];
    $this->red_3 = $data['red_3'];
    $this->blue_1 = $data['blue_1'];
    $this->blue_2 = $data['blue_2'];
    $this->blue_3 = $data['blue_3'];
  }
  
  //don't need a decode method because this is static data and
  //only needs to be sent to the client, not back to the server
  
  public function makeArray()
  {
    $match = array();
    
    $match['match_number'] = $this->match_number;
    $match['time'] = $this->time;
    
    $match['red_1'] = $this->red_1;
    $match['red_2'] = $this->red_2;
    $match['red_3'] = $this->red_3;
    $match['blue_1'] = $this->blue_1;
    $match['blue_2'] = $this->blue_2;
    $match['blue_3'] = $this->blue_3;
    
    return $match;
  }
  
  public function getRed1Match()
  {
    return (new MatchDataDatabaseModel())->getMatchData($this->match_number, $this->red_1);
  }
  
  public function getRed2Match()
  {
    return (new MatchDataDatabaseModel())->getMatchData($this->match_number, $this->red_2);
  }
  
  public function getRed3Match()
  {
    return (new MatchDataDatabaseModel())->getMatchData($this->match_number, $this->red_3);
  }
  
  public function getBlue1Match()
  {
    return (new MatchDataDatabaseModel())->getMatchData($this->match_number, $this->blue_1);
  }
  
  public function getBlue2Match()
  {
    return (new MatchDataDatabaseModel())->getMatchData($this->match_number, $this->blue_2);
  }
  
  public function getBlue3Match()
  {
    return (new MatchDataDatabaseModel())->getMatchData($this->match_number, $this->blue_3);
  }
  
  public function getRed1()
  {
    return (new TeamDatabaseModel())->getTeam($this->red_1);
  }
  
  public function getRed2()
  {
    return (new TeamDatabaseModel())->getTeam($this->red_2);
  }
  
  public function getRed3()
  {
    return (new TeamDatabaseModel())->getTeam($this->red_3);
  }
  
  public function getBlue1()
  {
    return (new TeamDatabaseModel())->getTeam($this->blue_1);
  }
  
  public function getBlue2()
  {
    return (new TeamDatabaseModel())->getTeam($this->blue_2);
  }
  
  public function getBlue3()
  {
    return (new TeamDatabaseModel())->getTeam($this->blue_3);
  }
}
