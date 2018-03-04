<?php

class TeamsListView implements View
{
	public function render()
	{ 
	$teams = (new TeamsDatabaseModel())->getTeams(); ?>
		<div class="page-section">
			<div class="page-section-head"> Rankings </div>
			<div class="page-section-content">
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
					<th class="schedule-head" onclick="sortTableInt(2)">Place Holder</th>
					<th class="schedule-head" onclick="sortTableInt(3)">Place Holder</th>
				</tr>
				<?php $i = 0; 
					foreach($teams as $team) {
						if($i % 2 == 0) { ?>
							<tr class="schedule-zebra-dark">
								<td class="schedule-match-number schedule-mid"><?= $team->number ?></td>
								<td class="schedule-mid"><?= $team->name ?></td>
								<td class=""></td>
								<td class=""></td>
							</tr>
						<?php } else { ?>
							<tr class="schedule-zebra-light">
								<td class="schedule-match-number schedule-mid"><?= $team->number ?></td>
								<td class="schedule-mid"><?= $team->name ?></td>
								<td class=""></td>
								<td class=""></td>
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
