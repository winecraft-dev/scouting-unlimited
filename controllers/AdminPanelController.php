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
