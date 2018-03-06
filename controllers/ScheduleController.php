<?php
class ScheduleController extends Controller
{
	public function display()
	{
		if(Session::isLoggedIn())
		{
			if(Session::getLoggedInUser()->administrator >= 0)
				print (new ScheduleView())->render();
			else
				print (new ErrorView())->render("Not Enough Permissions!");
		}
		else
		{
			echo "NOT LOGGED IN";
		}
	}

	public function view()
	{
		if(Session::isLoggedIn())
		{
			(new IndexPageView('Schedule - CRyptonite Robotics', ['/scripts/pages/schedulepage.js']))->render();
		}
		else
		{
			header("Location: /?p=login");
		}
	}
}
?>
