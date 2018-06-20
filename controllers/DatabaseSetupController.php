<?php
class DatabaseSetupController extends Controller
{
	public function display()
	{
		if(Session::isLoggedIn())
		{
			if(Session::getLoggedInUser()->administrator == 1)
				(new DatabaseSetupView())->render();
			else
				(new ErrorView())->render("Not Enough Permissions!");
		}
		else
		{
			echo "NOT LOGGED IN";
		}
	}
}