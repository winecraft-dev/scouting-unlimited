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
      header("Location: /?p=login");
    }
  }  
  
  public function loadSchedule()
  {
		if(empty($_POST['eventCode']))
		{
			header("Location: /?controller=admin&action=display");
		}
		else
		{
		  (new MatchScheduleDatabaseModel())->loadSchedule($_POST['eventCode']);
		  header("Location: /?controller=admin&action=display&loaded=true");
	  }
  }
}    
?>
