<?php
class DataEntryFormView implements View
{	
	public function render()
	{ 
		$data_definitions = (new DataDefinitionsDatabaseModel())->getDataDefinitions(); ?>
		<div class="page-section">
			<div class="page-section-head">
				Data Form
			</div>
			<a href="/?p=teamdata&team=216">link</a>
			<div class="page-section-content" style="overflow-x: hide;">
				<div class="dataentry-form">
					<div class="dataentry-sections">
						<div id="prematch" class="dataentry-tab">Prematch</div>
						<div id="auton" class="dataentry-tab">Auton</div>
						<div id="teleop" class="dataentry-tab">Teleop</div>
						<div id="endgame" class="dataentry-tab">End Game</div>
					</div>
					<div id="prematch" class="dataentry-subform">
						<div class="dataentry-module">
							Match Number<br>
							<input id="match_number" type="number" class="dataentry-module-number"></input>
						</div>
						<div class="dataentry-module">
							Team Number<br>
							<input style="background-color: #aaa" readonly id="team_number" type="number" class="dataentry-module-number"></input>
						</div>
						<div class="dataentry-module">
							No Show<br>
							<input id="dead" type="checkbox" class="dataentry-module-boolean"></input>
						</div>
						<div class="dataentry-module">
							Lost Comms<br>
							<input id="dead_shortly" type="checkbox" class="dataentry-module-boolean"></input>
						</div>
					</div>
					<div id="auton" class="dataentry-subform">
						<?php foreach($data_definitions as $definition) { 
							if($definition['section'] == 0) { ?>
								<div style="background-color: rgba(255, 0, 0, .15);" class="dataentry-module">
									<?= $definition['title'] ?><br>
									<?= $this->getInputByDefinition($definition) ?>
								</div>
							<?php } 
						}?>
					</div>
					<div id="teleop" class="dataentry-subform">
						<?php foreach($data_definitions as $definition) { 
							if($definition['section'] == 1) { ?>
								<div style="background-color: rgba(0, 255, 0, .15);" class="dataentry-module">
									<?= $definition['title'] ?><br>
									<?= $this->getInputByDefinition($definition) ?>
								</div>
							<?php } 
						}?>
					</div>
					<div id="endgame" class="dataentry-subform">
						<?php foreach($data_definitions as $definition) { 
							if($definition['section'] == 2) { ?>
								<div style="background-color: rgba(0, 0, 255, .15);" class="dataentry-module">
									<?= $definition['title'] ?><br>
									<?= $this->getInputByDefinition($definition) ?>
								</div>
							<?php } 
						}?>
					</div>
				</div>
			</div>
			<button id="data-entry" class="dataentry-submit">Submit</button>
		</div>
	<?php }
	
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
