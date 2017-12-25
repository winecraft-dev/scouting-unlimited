<?php
class ScheduleController extends Controller
{
	public function display()
	{
		if(Session::isLoggedIn())
		{
			(new ScheduleView())->render();
		}
	}
}
?>