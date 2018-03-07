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
		<div class="page-section">
			<div class="page-section-head">
				Averages
			</div>
			<div class="page-section-content">
				<table class="schedule">
					<colgroup>
						<col span="1" style="width: 35%;">
						<col span="1" style="width: 55%;">
					</colgroup>
					<tr>
						<th class="schedule-head schedule-mid">Title</th>
						<th class="schedule-head">Value</th>
					</tr>
					<?php 
						$aDefinitions = (new DataDefinitionsDatabaseModel())->getAverageDefinitions(); 
						$i = 0;
						foreach($aDefinitions as $definition) { ?>
							<tr class=<?= $i % 2 == 0 ? "schedule-zebra-light" : "schedule-zebra-dark" ?>>
								<td class="schedule-mid"><?= $definition['title'] ?></td>
								<td id=<?= str_replace(" ", "-", $definition['title']) ?>></td>
							</tr>
						<?php $i ++; 
					} ?>
				</table>
			</div>
		</div>
		<div class="page-section">
			<div class="page-section-head">
				Matches
			</div>
			<div class="page-section-content">
				<table id="matches" class="schedule">
					<colgroup>
						<col span="1" style="width: 35%;">
						<col span="1" style="width: 55%;">
					</colgroup>
					<tr>
						<th class="schedule-head schedule-mid">Match</th>
					</tr>
				</table>
			</div>
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