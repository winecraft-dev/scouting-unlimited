<?php
class OfflineClientController extends Controller
{
  public function getSchedule()
  {
    if(Session::isLoggedIn())
    {
      $matches = (new MatchScheduleDatabaseModel())->getMatches();
      
      $match_array = array();
      
      foreach($matches as $match)
      {
        $match_array[] = $match->makeArray();
      }
      echo json_encode($match_array);
    }
    else
    {
      echo "NOT LOGGED IN";
    }
  }
  
  public function getTeams()
  {
    if(Session::isLoggedIn())
    {
      $teams = (new TeamsDatabaseModel())->getTeams();
      
      $team_array = array();
      
      foreach($teams as $team)
      {
        $team_array[] = $team->makeArray();
      }
      echo json_encode($team_array);
    }
    else
    {
      echo "NOT LOGGED IN";
    }
  }
  
  public function getMatchData()
  {
  
  }
  
  public function getDataDefinitions()
  {
    
  }
  
  public function getErrorPage()
  {
    print (new ErrorView())->render("Error Text Here");
  }
}
?>
