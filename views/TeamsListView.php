<?php

class TeamsListView implements View
{
	public function render()
	{ 
	$teams = (new TeamsDatabaseModel())->getTeams(); 
	$definitions = (new DataDefinitionsDatabaseModel())->getAverageDefinitions(); ?>
		<div class="page-section">
			<div class="page-section-head"> Rankings </div>
			<div class="page-section-content" style="overflow-x: scroll;">
				<table class="schedule" id="teamtable">
					<colgroup>
						<col span="1" style="width: 8%;">
						<col span="1" style="width: 8%;">
						<col span="1" style="width: 8%;">
						<col span="1" style="width: 8%;">
					</colgroup>
					<tr>
						<th class="schedule-corner schedule-mid" onclick="sortTableInt(0)">Team Number</th>
						<th class="schedule-head schedule-mid" onclick="sortTableString(1)">Team Name</th>
						<?php $i = 2; foreach($definitions as $definition) { 
							if($definition['data_type'] == 1) {?>
								<th class="schedule-head" onclick=<?= 'sortTableInt(' . $i. ')' ?>><?= $definition['title'] ?></th>
							<?php $i ++; } ?>
						<?php } ?>
					</tr>
					<?php $i = 0; 
						foreach($teams as $team) {
							if($i % 2 == 0) { ?>
								<tr class="schedule-zebra-dark">
									<td class="schedule-match-number schedule-mid">
										<mark class="schedule-undone" id=<?= $team->number ?>>
											<a href=<?= '/?p=teamdata&team=' . $team->number ?> style="color:black;">
												<?= $team->number ?>
											</a>
										</mark>
									</td>
									<td class="schedule-mid"><?= $team->name ?></td>
									<?php foreach($definitions as $definition) { 
										if($definition['data_type'] == 1) { ?>
											<td><?= $team->getAverage($definition['title']) == null ? 0 : $team->getAverage($definition['title']) ?></td>
										<?php } ?>
									<?php } ?>
								</tr>
							<?php } else { ?>
								<tr class="schedule-zebra-light">
									<td class="schedule-match-number schedule-mid">
										<mark class="schedule-undone" id=<?= $team->number ?>>
											<a href=<?= '/?p=teamdata&team=' . $team->number ?> style="color:black;">
												<?= $team->number ?>
											</a>
										</mark>
									</td>
									<td class="schedule-mid"><?= $team->name ?></td>
									<?php foreach($definitions as $definition) { 
										if($definition['data_type'] == 1) { ?>
											<td><?= $team->getAverage($definition['title']) == null ? 0 : $team->getAverage($definition['title']) ?></td>
										<?php } ?>
									<?php } ?>
								</tr>
							<?php } ?>
						<?php $i++; 
					} ?>
				</table>
			</div>
		</div>
	<?php }
}
?>
