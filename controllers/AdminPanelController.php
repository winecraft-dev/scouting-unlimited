<?php
class AdminPanelController extends Controller
{
  public function display()
  {
    if(Session::isLoggedIn())
    {
      if(Session::getLoggedInUser()->administrator == 1)
        (new AdminPanelView())->render();
      else
        (new ErrorView())->render("You must be an administrator to view this page.");
    }
    else
    {
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
