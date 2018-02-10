<?php
class OfflineClientController extends Controller
{
  public function getSchedule()
  {
    $matches = (new MatchScheduleDatabaseModel())->getMatches();
    
    $match_array = array();
    
    foreach($matches as $match)
    {
      $match_array[] = $match->makeArray();
    }
    return json_encode($match_array);
  }
  
  public function getTeams()
  {
    $teams = (new TeamsDatabaseModel())->getTeams();
    
    $team_array = array();
    
    foreach($teams as $team)
    {
      $team_array[] = $team->makeArray();
    }
  }
  
  public function getMatchData()
  {
  
  }
  
  public function getDataDefinitions()
  {
    
  }
}
?>
