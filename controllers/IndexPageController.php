<?php
class IndexPageController extends Controller
{
	public function display()
	{
		if(Session::isLoggedIn())
		{
			if(Session::getLoggedInUser()->administrator >= 0)
				print (new IndexPageView())->render();
			else
				print (new ErrorView())->render("Not Enough Permissions!");
		}
		else
		{
			header("Location: /?c=login");
		}
	}
}
