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
			var_dump((new TeamsDatabaseModel())->getTeam(216));
		}
		else
		{
			echo "NOT LOGGED IN";
		}
	}

	public function displayTeam()
	{
		if(Session::isLoggedIn())
		{
			if(Session::getLoggedInUser()->administrator >= 0)
				print (new TeamView())->render();
			else
				print (new ErrorView())->render("Not Enough Permissions!");
		}
		else
		{
			echo "NOT LOGGED IN";
		}
	}

	public function teamImage()
	{
		if(Session::isLoggedIn())
		{
			if(Session::getLoggedInUser()->administrator >= 0)
			{
				$team = isset($_GET['team']) ? $_GET['team'] : null; ?>
				<body style="margin: 0px; text-align: center;">
					<img style="margin: auto;" height="80px" width="80px" src=<?= "images/teampictures/" . $team . ".png" ?>></img>
				</body>
			<?php }
			else
				print (new ErrorView())->render("Not Enough Permissions!");
		}
		else
		{
			echo "NOT LOGGED IN";
		}
	}


	public function enterPitNotes()
	{
		if(Session::isLoggedIn())
		{
			if(Session::getLoggedInUser()->administrator >= 0)
			{
				$team_number = isset($_POST['team_number']) ? $_POST['team_number'] : null;
				$data = json_decode(isset($_POST['data']) ? $_POST['data'] : null);

				if($data == null || $team_number == null)
				{
					echo "NO DATA";
					return;
				}

				$team = (new TeamsDatabaseModel())->getTeam($team_number);
				$team->enterPitData($data);
				
				echo "SUCCESS";
				return;
			}
			else
			{
				echo "NOT ENOUGH PERMISSIONS";
				return;
			}
		}
		else
		{
			echo "NOT LOGGED IN";
			return;
		}
	}
}

