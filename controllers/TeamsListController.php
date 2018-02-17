<?php
class TeamsListController extends Controller
{
	public function display()
	{
	  if(Session::isLoggedIn())
		{
			if(Session::getLoggedInUser()->administrator >= 0)
        print (new TeamsListView())->render();
      else
        print (new ErrorView())->render("Not Enough Permissions!");
		}
		else
		{
		  echo "NOT LOGGED IN";
		}
	}
}

