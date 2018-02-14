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
      header("Location: /?c=login");
    }
  }  
  
  public function loadTeams()
  {
    if(Session::isLoggedIn())
    {
      if(Session::getLoggedInUser()->administrator == 1)
      {
		    if(empty($_POST['eventCode']))
		    {
			    header("Location: /?p=adminpanel");
		    }
		    else
		    {
		      (new TeamsDatabaseModel())->loadTeamsFromApi($_POST['eventCode']);
	      }
	    }
	  }
  }
  
  public function loadSchedule()
  {
    if(Session::isLoggedIn())
    {
      if(Session::getLoggedInUser()->administrator == 1)
      {
		    if(empty($_POST['eventCode']))
		    {
			    header("Location: /?p=adminpanel");
		    }
		    else
		    {
		      (new MatchScheduleDatabaseModel())->loadMatchesFromApi($_POST['eventCode']);
	      }
	    }
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
