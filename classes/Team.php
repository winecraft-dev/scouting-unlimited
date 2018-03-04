<?php
class Team 
{
	public $number;
	public $name;
	
	public $averages;
	public $pit_notes;
	
	public function __construct($data)
	{
		$this->number = $data['number'];
		$this->name = $data['name'];
		
		$this->averages = array();
		$definitions = (new DataDefinitionsDatabaseModel())->getAverageDefinitions();

		foreach($definitions as $definition)
		{
			$this->averages += [$definition['title'] => $data[self::getSection($definition['section']) . '_' . $definition['number']]];
		}

		//gets pit notes and stores it in the object with Title => Value
		$this->pit_notes = array();
		$notes = (new PitNotesDatabaseModel())->getPitNotes($this->number);
		$definitions = (new DataDefinitionsDatabaseModel())->getPitNotesDefinitions();
		
		if($definitions === false)
			return false;
		
		foreach($definitions as $definition)
		{
			$data_type = MatchData::getDataType($definition['data_type']);
			$number = $definition['number'];
			
			$this->pit_notes += [$definition['title'] => $notes[$data_type . '_' . $number]];
		}
	}

	public function enterPitData($pit_notes)
	{
		$this->pit_notes = $pit_notes;
		(new PitNotesDatabaseModel())->deletePitNotes($this->number);
		(new PitNotesDatabaseModel())->enterPitNotes($this, Session::getLoggedInUser()->id);
	}
	
	public function getMatches()
	{
		return (new MatchScheduleDatabaseModel())->getMatchesByTeam($this->number);
	}
	
	public function getMatchData()
	{
		return (new MatchDataDatabaseModel())->getTeamMatchData($this->number);
	}
	
	public function makeArray()
	{
		$team = array();
		
		$team['number'] = $this->number;
		$team['name'] = $this->name;
		
		$team['pit_notes'] = $this->pit_notes;
		
		$team['averages'] = $this->averages;
		
		return $team;
	}
	
	public function getAverage($index)
	{
		return $this->averages[$index];
	}
	
	public function updateAverages()
	{
		$this->averages = array();

		$averager = (new Averager($this));
		$definitions = (new DataDefinitionsDatabaseModel())->getAverageDefinitions();

		foreach($definitions as $definition)
		{
			$val = $averager->get($definition);
			$this->averages += [$definition['title'] => $val];
			(new TeamsDatabaseModel())->editTeam($this->number, self::getSection($definition['section']) . '_' . $definition['number'], $val);
		}
	}
	
	public static function getSection($number)
	{
		switch($number)
		{
			case 0:
				return 'auto';
			case 1:
				return 'teleop';
			case 2:
				return 'endgame';
		}
	}
}
