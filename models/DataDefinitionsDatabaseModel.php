<?php
class DataDefinitionsDatabaseModel extends DatabaseModel
{
	public function getDataDefinitions()
	{
		$query = self::$conn->prepare("SELECT data_definitions.*
				FROM data_definitions ORDER BY data_definitions.section, 
				data_definitions.data_type, data_definitions.number");
		$query->execute();

		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		if($result !== false)
			return $result;
		return false;
	}
	
	public function getAverageDefinitions()
	{
		$query = self::$conn->prepare("SELECT average_definitions.*
				FROM average_definitions");
		$query->execute();

		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		if($result !== false)
			return $result;
		return false;
	}

	public function getPitNotesDefinitions()
	{
		$query = self::$conn->prepare("SELECT pit_notes_definitions.*
				FROM pit_notes_definitions");
		$query->execute();

		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		if($result !== false)
			return $result;
		return false;
	}

	public function addDataDefinition($title, $module, $section, $data_type, $number, $dropdown_values)
	{
		$query = self::$conn->prepare("INSERT INTO data_definitions
				(title, module, section, data_type, number, dropdown_values) VALUES 
				(:title, :module, :section, :data_type, :number, :dropdown_values)");
		$query->bindValue(':title', $title);
		$query->bindValue(':module', $module);
		$query->bindValue(':section', $section);
		$query->bindValue(':data_type', $data_type);
		$query->bindValue(':number', $number);
		$query->bindValue(':dropdown_values', $dropdown_values);
		$query->execute();
	}
}
?>
