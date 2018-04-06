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

	public function displayUpcoming()
	{
		if(Session::isLoggedIn())
		{
			if(Session::getLoggedInUser()->administrator >= 0)
			{
				print (new UpcomingMatchesView())->render();
			}
			else
				print (new ErrorView())->render("Not Enough Permissions!");
		}
		else
		{
			echo "NOT LOGGED IN";
		}
	}

	public function viewUpcoming()
	{
		if(Session::isLoggedIn())
		{
			(new IndexPageView('Upcoming Matches - CRyptonite Robotics', ['/scripts/pages/upcomingmatchespage.js']))->render();
		}
		else
		{
			header("Location: /?p=login");
		}
	}
}
?>
