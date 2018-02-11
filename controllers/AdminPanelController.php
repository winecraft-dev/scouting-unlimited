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
        echo "NOT ENOUGH PERMISSIONS";
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
}    
?>
