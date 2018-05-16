<?php
class Averager
{
	public $team;
	public $matchData;

	public static $data_definitions;
	
	public function __construct($team)
	{
		$this->team = $team;
		$this->matchData = $this->team->getMatchData();

		self::$data_definitions = (new DataDefinitionsDatabaseModel())->getDataDefinitions();
	}
	
	public function get($definition)
	{
		switch($definition['method'])
		{
			case 'matches':
				return $this->matches();
			case 'matchesdead':
				return $this->matchesDead();
			case 'matchesplayed':
				return $this->matchesPlayed();
			case 'matchesdeadshortly':
				return $this->matchesDeadShortly();
			case 'average':
				return $this->average($definition['column_1']);
			case 'percentaverage':
				return $this->percentAverage($definition['column_1']);
			case 'max':
				return $this->max($definition['column_1']);
			case 'concatstring':
				return $this->concatString($definition['column_1']);
			case 'dropdown':
				return $this->dropdown($definition['column_1']);
			case 'dropdownvaluepercent':
				return $this->dropdownValuePercent($definition['column_1'], $definition['value_1']);
			case 'successoverattempt':
				return $this->successOverAttempt($definition['column_1'], $definition['column_2']);
		}
	}

	public function dropdown($index)
	{
		$definition = self::getDataDefinition($index);
		$values = array();

		foreach(explode(",", $definition['dropdown_values']) as $s)
		{
			$values += [$s => 0];
		}

		foreach($this->matchData as $md)
		{
			if(!$md->dead)
			{
				$val = $md->getData($index);

				$i = 1;
				foreach($values as $key => $value)
				{
					if($i == $val)
						$values[$key] = $value + 1;
					$i ++;
				}
			}
		}

		$str = "";
		foreach($values as $key => $index)
		{
			$str .= '(' . $key . ':' . $index . ')';
		}
		return $str;
	}

	public function dropdownValuePercent($index, $k)
	{
		$definition = self::getDataDefinition($index);
		$values = array();

		foreach(explode(",", $definition['dropdown_values']) as $s)
		{
			$values += [$s => 0];
		}

		foreach($this->matchData as $md)
		{
			if(!$md->dead)
			{
				$val = $md->getData($index);

				$i = 1;
				foreach($values as $key => $value)
				{
					if($i == $val)
						$values[$key] = $value + 1;
					$i ++;
				}
			}
		}

		if($this->matchesPlayed() != 0)
			return round($values[$k] / $this->matchesPlayed(), 2) * 100 . '%';
		return '0%';
	}

	public function successOverAttempt($index1, $index2)
	{
		$successes = 0;
		$attempts = 0;

		foreach($this->matchData as $md)
		{
			if($md->dead == true)
			{

			}
			else if($md->getData($index2) == false)
			{
				if($md->getData($index1) > 0)
				{
					$successes += $md->getData($index1);
					$attempts ++;
				}
			}
			else
			{
				$successes += $md->getData($index1);
				$attempts ++;
			}
		}

		return $successes . "/" . $attempts;
	}

	public function average($index)
	{
		$total = 0;
		foreach($this->matchData as $md) 
		{
			if(!$md->dead)
				$total += $md->getData($index);
		}
		if($this->matchesPlayed() != 0)
			return round($total / $this->matchesPlayed(), 2);
		return 0;
	}

	public function percentAverage($index)
	{
		$total = 0;
		foreach($this->matchData as $md) 
		{
			if(!$md->dead)
				$total += $md->getData($index);
		}
		if($this->matchesPlayed() != 0)
			return (round($total / $this->matchesPlayed(), 2) * 100) . '%';
		return '0%';
	}

	public function max($index)
	{
		$max = 0;
		foreach($this->matchData as $md) 
		{
			if(!$md->dead)
				if($md->getData($index) > $max)
					$max = $md->getData($index);
		}
		if($this->matchesPlayed() != 0)
			return $max;
		return 0;
	}
	
	public function concatString($index)
	{
		$string = "";
		foreach($this->matchData as $md)
		{
			if(!$md->dead)
				$string .= "Match: " . $md->match_number . " (" . $md->getData($index) . ") ";
		}
		return $string;
	}
	
	public function matches()
	{
		return sizeof($this->matchData);
	} 
	
	public function matchesDead()
	{
		$matchesDead = 0;
		
		foreach($this->matchData as $md)
		{
			if($md->dead == true)
			{
				$matchesDead ++;
			}
		}
		return $matchesDead;
	}
	
	public function matchesPlayed()
	{
		return $this->matches() - $this->matchesDead();
	}
	
	public function matchesDeadShortly()
	{
		$matchesDeadShortly = 0;
		
		foreach($this->matchData as $md)
		{
			if($md->dead_shortly === true)
			{
				$matchesDeadShortly ++;
			}
		}
		return $matchesDeadShortly;
	}

	public static function getDataDefinition($index)
	{
		foreach(self::$data_definitions as $d)
		{
			if($d['title'] == $index)
			{
				return $d;
			}
		}
	}
} 
