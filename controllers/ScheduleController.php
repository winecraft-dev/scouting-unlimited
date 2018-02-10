<?php
class ScheduleController extends Controller
{
	public function display()
	{
		if(Session::isLoggedIn())
		{
			print (new ScheduleView())->render();
		}
		else
		{
		  echo "NOT LOGGED IN";
		  header("Location: /?c=login");
		}
	}
}
?>
