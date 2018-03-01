<?php
class OfflineClientController extends Controller
{
	public function getSchedule()
	{
		if(Session::isLoggedIn())
		{
			if(Session::getLoggedInUser()->administrator >= 0)
			{
				$matches = (new MatchScheduleDatabaseModel())->getMatches();
				
				$match_array = array();
				
				foreach($matches as $match)
				{
					$match_array[] = $match->makeArray();
				}
				echo json_encode($match_array);
			}
			else
			{ 
				echo "NOT ENOUGH PERMISSIONS";
			}
		}
		else
		{
			echo "NOT LOGGED IN";
		}
	}
	
	public function getTeams()
	{
		if(Session::isLoggedIn())
		{
			if(Session::getLoggedInUser()->administrator >= 0)
			{
				$teams = (new TeamsDatabaseModel())->getTeams();
				
				$team_array = array();
				
				foreach($teams as $team)
				{
					$team_array[] = $team->makeArray();
				}
				echo json_encode($team_array);
			}
			else
			{
				echo "NOT ENOUGH PERMISSIONS";
			}
		}
		else
		{
			echo "NOT LOGGED IN";
		}
	}
	
	public function getDataDefinitions()
	{
		if(Session::isLoggedIn())
		{
			$user = Session::getLoggedInUser();
			if($user->administrator >= 0)
			{
				echo json_encode((new DataDefinitionsDatabaseModel())->getDataDefinitions());
			}
			else
			{
				echo "NOT ENOUGH PERMISSIONS";
			}
		}
		else
		{
			echo "NOT LOGGED IN";
		}
	}
	
	public function getMatchData()
	{
		if(Session::isLoggedIn())
		{
			$user = Session::getLoggedInUser();
			if($user->administrator >= 0)
			{
				$matchData = (new MatchDataDatabaseModel())->getAllMatchData($user->id);
				
				$array = array();
				foreach($matchData as $data)
				{
					$array[] = $data->makeArray();
				}
				echo json_encode($array);
			}
			else
			{
				echo "NOT ENOUGH PERMISSIONS";
			}
		}
		else
		{
			echo "NOT LOGGED IN";
		}
	}
	
	public function getErrorPage()
	{
		print (new ErrorView())->render("Error Text Here");
	}
}
?>
