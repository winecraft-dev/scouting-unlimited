<?php
class UpdateDatabaseModel extends DatabaseModel
{
	public function updateDatabase()
	{
		$randomValue = rand(1, 100000);
		$query = self::$conn->prepare('UPDATE updates SET value=:val WHERE id=1');
		$query->bindValue(':val', $randomValue);
		return ($query->execute());
	}

	public function getUpdate()
	{
		$query = self::$conn->prepare("SELECT updates.value FROM updates WHERE id=1 LIMIT 1");
		$query->execute();

		return $query->fetch(PDO::FETCH_ASSOC)['value'];
	}
}