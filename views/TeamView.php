<?php
class TeamView implements View
{
	public function render()
	{ ?>
		<div id="team-number"></div>
		<div class="page-section" style="overflow-x: hide;">
			<div class="page-section-head" id="pit-notes">
			</div>
			<?php 
				$pDefinitions = (new DataDefinitionsDatabaseModel())->getPitNotesDefinitions();
			?>
			<div class="page-section-content">
				<div class="dataentry-module">
					<iframe height="80px" id="image-iframe" class="dataentry-module-text" style="padding: 0px; border: 0px;" src=""></iframe>
				</div>
				<?php foreach($pDefinitions as $definition) { ?>
					<div class="dataentry-module">
						<?= $definition['title'] ?><br>
						<?= $this->getInputByDefinition($definition) ?>
					</div>
				<?php } ?>
				<button id="pit_notes" class="dataentry-submit">Update Pit Data</button>
			</div>
		</div>
		<?php 
			$averageDefinitions = (new DataDefinitionsDatabaseModel())->getAverageDefinitions();
			$this->section($averageDefinitions, 0);
			$this->section($averageDefinitions, 1);
			$this->section($averageDefinitions, 2);
		?>
		<div class="page-section">
			<div class="page-section-head">
				Matches
			</div>
			<div class="page-section-content">
				<table id="matches" class="schedule">
					<colgroup>
						<col span="1" style="width: 5%;">
						<col span="1" style="width: 15.833333333%;">
						<col span="1" style="width: 15.833333333%;">
						<col span="1" style="width: 15.833333333%;">
						<col span="1" style="width: 15.833333333%;">
						<col span="1" style="width: 15.833333333%;">
						<col span="1" style="width: 15.833333333%;">
					</colgroup>
					<tr>
						<th class="schedule-corner schedule-mid">Match</th>
						<th class="schedule-head">Red 1</th>
						<th class="schedule-head">Red 2</th>
						<th class="schedule-head schedule-mid">Red 3</th>
						<th class="schedule-head">Blue 1</th>
						<th class="schedule-head">Blue 2</th>
						<th class="schedule-head">Blue 3</th>
					</tr>
				</table>
			</div>
		</div>
	<?php }

	public function section($averageDefinitions, $section)
	{ ?>
		<div class="page-section">
			<div class="page-section-head">
				<?php switch($section) { 
					case 0:
						echo "Auto Averages";
						break;
					case 1:
						echo "Teleop Averages";
						break;
					case 2:
						echo "Endgame Averages";
				} ?>
			</div>
			<div class="page-section-content">
				<?php 
				foreach($averageDefinitions as $definition) { 
					if($definition['section'] == $section) { ?>
						<div style="<?php switch($section) {
							case 0:
								echo "background-color: rgba(255, 0, 0, .15);";
								break;
							case 1:
								echo "background-color: rgba(0, 255, 0, .15);";
								break;
							case 2:
								echo "background-color: rgba(0, 0, 255, .15);";
								break;

						} ?>" class="dataentry-module">
							<?= $definition['title'] ?><br>
							<?php $this->output($definition); ?>
						</div>
					<?php } ?>
				<?php } ?>
				</div>
			</div>
		</div>
	<?php }

	public function output($definition) 
	{
		switch($definition['method'])
		{
			case 'matches':
			case 'matchesdead':
			case 'matchesplayed':
			case 'matchesdeadshortly':
			case 'max':
			case 'percentaverage':
			case 'average':
			case 'dropdownvaluepercent':
			case 'successoverattempt': ?>
				<div id=<?= str_replace(" ", "-", $definition['title'])?> class="dataentry-number"></div>
				<?php break;
			case 'dropdown':
			case 'concatstring': ?>
				<div id=<?= str_replace(" ", "-", $definition['title']) ?> class="dataentry-text"></div>
				<?php break;
		}
	}

	public function getInputByDefinition($definition)
	{
		$id = str_replace(" ", "-", $definition['title']);
		
		switch($definition['module'])
		{
			case 0: ?>
				<input id=<?= $id ?> type="number" class="dataentry-module-number"></input>
				<?php break;
			case 1: ?>
				<div id=<?= $id ?> class="dataentry-module-number-arrowup"></div>
				<input id=<?= $id ?> class="dataentry-module-number" type="number" value=0>
				<div id=<?= $id ?> class="dataentry-module-number-arrowdown"></div>
				<?php break;
			case 2: ?>
				<input id=<?= $id ?> type="checkbox" class="dataentry-module-boolean"></input>
				<?php break;
			case 3: ?>
				<textarea rows="6" cols="100" id=<?= $id ?> class="dataentry-module-text"></textarea>
				<?php break;
			case 4: 
				$options = explode(",", $definition['dropdown_values']); ?>
				
				<select id=<?= $id ?> class="dataentry-module-dropdown">
					<option value="0" selected>Not Selected</option>
					<?php $i = 1; foreach($options as $option) { ?>
						<option value=<?= $i ?>><?= $option ?></option> 
					<?php $i ++; } ?>
				</select>
				<?php break;
		}
	}
}