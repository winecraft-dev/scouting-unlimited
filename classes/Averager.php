<?php
class Averager
{
  public $team;
  public $matchData;
  
  public function __construct($team)
  {
    $this->team = $team;
    
    $this->matchData = $this->team->getMatchData();
  }
  
  public function average($index)
  {
    $total = 0;
    foreach($this->matchData as $md) 
    {
      $total += $md->getData($index);
    }
    if($this->matchesPlayed() != 0)
      return $total / $this->matchesPlayed();
    return 0;
  }
  
  public function concatString($index)
  {
    $string = "";
    foreach($this->matchData as $md)
    {
      $string .= "Match: " . $md->match_number . " [" . $md->getData($index) . "]";
    }
    return $string;
  }
  
  public function matches()
  {
    return sizeof($this->matchData);
  } 
  
  public function matchesDead()
  {
    $matchesDead = 0;
    
    foreach($this->matchData as $md)
    {
      if($md->dead === true)
      {
        $matchesDead ++;
      }
    }
    return $matchesDead;
  }
  
  public function matchesPlayed()
  {
    return $this->matches() - $this->matchesDead();
  }
} 
