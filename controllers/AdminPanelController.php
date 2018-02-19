<?php
class AdminPanelController extends Controller
{
  public function display()
  {
    if(Session::isLoggedIn())
    {
      if(Session::getLoggedInUser()->administrator == 1)
        print (new AdminPanelView())->render();
      else
        print (new ErrorView())->render("Not Enough Permissions!");
    }
    else
    {
		  echo "NOT LOGGED IN";
    }
  }  
  
  public function getScoutingPosition()
  {
    if(Session::isLoggedIn())
    {
      echo Session::getLoggedInUser()->scouting_position;
    }
    else
    {
		  echo "NOT LOGGED IN";
    }
  }
  
  public function loadTeams()
  {
    if(Session::isLoggedIn())
    {
      if(Session::getLoggedInUser()->administrator == 1)
      {
		    $eventcode = isset($_POST['eventcode']) ? $_POST['eventcode'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        
        if(Session::getLoggedInUser()->checkPassword($password))
        {
          if($eventcode != null)
          {
            if((new TeamsDatabaseModel())->loadTeamsFromApi($eventcode))
            {
              echo "SUCCESS";
              return;
            }
            echo "ERROR";
            return;
          }
          echo "NO ID";
          return;
        }
        echo "INCORRECT PASSWORD";
        return;
	    }
	    echo "NOT ENOUGH PERMISSIONS";
	    return;
	  }
	  echo "NOT LOGGED IN";
	  return;
  }
  
  public function loadSchedule()
  {
    if(Session::isLoggedIn())
    {
      if(Session::getLoggedInUser()->administrator == 1)
      {
		    $eventcode = isset($_POST['eventcode']) ? $_POST['eventcode'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        
        if(Session::getLoggedInUser()->checkPassword($password))
        {
          if($eventcode != null)
          {
            if((new MatchScheduleDatabaseModel())->loadMatchesFromApi($eventcode))
            {
              echo "SUCCESS";
              return;
            }
            echo "ERROR";
            return;
          }
          echo "NO ID";
          return;
        }
        echo "INCORRECT PASSWORD";
        return;
	    }
	    echo "NOT ENOUGH PERMISSIONS";
	    return;
	  }
	  echo "NOT LOGGED IN";
	  return;
  }
  
  public function getCSV()
  {
    header('Content-Disposition: attachment; filename=data.csv');
		$output = fopen('php://output', 'w');
		$csv = [];
		
		$teams = (new TeamsDatabaseModel())->getTeams();
		
		foreach($teams as $team)
		{
		  $team->updateAverages();
		}
		
		$averageDefinitions = (new DataDefinitionsDatabaseModel())->getAverageDefinitions();
		
		$csv[0][] = "Number";
		$csv[0][] = "Name";
		$csv[0][] = "Pit Notes";
		
		foreach($averageDefinitions as $definition)
		{
		  $csv[0][] = $definition['title'];
		}
		
		$i = 1;
		foreach($teams as $team)
		{
		  $csv[$i][] = $team->number;
		  $csv[$i][] = $team->name;
		  $csv[$i][] = $team->pit_notes;
		  
		  foreach($team->averages as $average)
		  {
		    $csv[$i][] = $average;
		  }
		  $i ++;
		}
		
		foreach($csv as $row)
		{
			fputcsv($output, $row);
		}
  }
  
  public function editScoutingPosition()
  {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $val = isset($_POST['val']) ? $_POST['val'] : null;
    
    if(!Session::isLoggedIn())
    {
      echo "NOT LOGGED IN";
      return;
    }
    if(Session::getLoggedInUser()->administrator != 1)
    {
      echo "NOT ENOUGH PERMISSIONS";
      return;
    }
    if((new UserDatabaseModel())->editUser($id, 'scouting_position', $val))
    {
      echo "SUCCESS";
      return;
    }
  }
  
  public function editAdministrator()
  {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $val = isset($_POST['val']) ? $_POST['val'] : null;
    
    if(!Session::isLoggedIn())
    {
      echo "NOT LOGGED IN";
      return;
    }
    if(Session::getLoggedInUser()->administrator != 1)
    {
      echo "NOT ENOUGH PERMISSIONS";
      return;
    }
    if((new UserDatabaseModel())->editUser($id, 'administrator', $val))
    {
      echo "SUCCESS";
      return;
    }
  }
  
  public function removeUser()
  {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    if(!Session::isLoggedIn())
    {
      echo "NOT LOGGED IN";
      return;
    }
    if(Session::getLoggedInUser()->administrator != 1)
    {
      echo "NOT ENOUGH PERMISSIONS";
      return;
    }
    if((new UserDatabaseModel())->deleteUser($id))
    {
      echo "SUCCESS";
      return;
    }
  }
}    
?>
