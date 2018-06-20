<?php
class EditDefinitionsController extends Controller
{
	public function display()
	{
		if(Session::isLoggedIn())
		{
			if(Session::getLoggedInUser()->administrator == 1)
				print (new EditDefinitionsView())->render();
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
			(new IndexPageView('Edit Data Definitions - CRyptonite Robotics', ['/scripts/pages/editdefinitionspage.js']))->render();
		}
		else
		{
			header("Location: /?p=login");
		}
	}

	public function addDataDefinition()
	{
		$dataDefinitions = (new DataDefinitionsDatabaseModel())->getDataDefinitions();

		$title = $_POST['name'];
		$module = $_POST['module'];
		$section = $_POST['section'];
		$dropdown_values = $_POST['dropdown_values'];
		$data_type = -1;
		$number;

		switch($module)
		{
			case 0:
				$data_type = 1;
				break;
			case 1:
				$data_type = 1;
				break;
			case 2:
				$data_type = 0;
				break;
			case 3:
				$data_type = 2;
				break;
			case 4:
				$data_type = 1;
				break;
		}

		$definitionsOfType = array();

		foreach($dataDefinitions as $definition)
		{
			if($definition['section'] == $section && $definition['data_type'] == $data_type)
				$definitionsOfType[] = $definition;
			if($definition['title'] == $title)
			{
				echo "Title is already in Use";
				return;
			}
		}

		switch($data_type)
		{
			case 0:
				if(sizeof($definitionsOfType) >= 10)
				{
					echo "There are too many Booleans in this section";
					return;
				}
				else
				{
					$number = sizeof($definitionsOfType) + 1;
				}
				break;
			case 1:
				if(sizeof($definitionsOfType) >= 10)
				{
					echo "There are too many Numbers in this section";
					return;
				}
				else
				{
					$number = sizeof($definitionsOfType) + 1;
				}
				break;
			case 2:
				if(sizeof($definitionsOfType) >= 1)
				{
					echo "You cannot have more than one Text Field per section";
					return;
				}
				else
				{
					$number = 1;
				}
				break;
		}
		(new DataDefinitionsDatabaseModel())->addDataDefinition($title, $module, $section, $data_type, $number, $dropdown_values);
		header("Location: /?p=edit");
	}

	public function deleteDataDefinition()
	{

	}
}