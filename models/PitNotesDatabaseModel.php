<?php
class PitNotesDatabaseModel extends DatabaseModel
{
	public function getPitNotes($team_number)
	{
		$query = self::$conn->prepare("SELECT pit_notes.*
				FROM pit_notes WHERE team_number=:team_number LIMIT 1");
		$query->bindValue(':team_number', $team_number);
		$query->execute();

		$result = $query->fetch(PDO::FETCH_ASSOC);
		if($result !== false)
			return $result;
		return false;	
	}
	
	public function deletePitNotes($team_number)
	{
		$query = self::$conn->prepare('DELETE FROM pit_notes ' .
				'WHERE team_number=:team_number LIMIT 1');
		$query->bindValue(':team_number', $team_number);
		return $query->execute();
	}

	public function enterPitNotes($team, $scout)
	{
		$data = array();
		$pitDefinitions = (new DataDefinitionsDatabaseModel())->getPItNotesDefinitions();
		
		foreach($team->pit_notes as $key => $val)
		{
			$definition;
			foreach($pitDefinitions as $def)
			{
				if($def["title"] == $key)
				{
					$definition = $def;
					break;
				}
			}
			$index = (MatchData::getDataType($definition["data_type"])) . "_" . $definition["number"];
			$data += array($index => $val);
		}
		
		$queryString = "INSERT INTO pit_notes SET ";
		$queryString .= "team_number='" . $team->number . "', ";
		$queryString .= "scout='" . $scout . "', ";

		foreach($data as $index => $value)
		{
			$queryString .= $index . "='" . $value . "', ";
		}
		$queryString = substr($queryString, 0, strlen($queryString) - 2);
		$query = self::$conn->prepare($queryString);
		if(!$query->execute()) 
			return false;
	}
}