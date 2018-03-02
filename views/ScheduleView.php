<?php
class ScheduleView implements View
{
	public function render()
	{ 
		$schedule = (new MatchScheduleDatabaseModel())->getMatches(); ?>
		<div class="page-section">
			<div class="page-section-head">Schedule</div>
			<div class="page-section-content">
				<table class="schedule">
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
					<?php 
					$i = 0; 
					foreach($schedule as $match) { 
						if($i % 2 == 0) { ?>
							<tr class="schedule-zebra-light">
						<?php } else { ?>
							<tr class="schedule-zebra-dark">
						<?php } ?>
							<td class="schedule-mid schedule-match-number"><a href=<?= "/?p=matchdata&match=" . $match->match_number ?>><?= $match->match_number ?></a></td>
							<td class="schedule-red">
								<a style="color: black;" href=<?= '/?p=teamdata&team=' . $match->red_1 ?>>
									<mark class="schedule-undone" 
											id=<?= $match->match_number . '-' . $match->red_1 ?>>
										<?= $match->red_1 ?>
									</mark>
								</a>
							</td>
							<td class="schedule-red">
								<a style="color: black;" href=<?= '/?p=teamdata&team=' . $match->red_2 ?>>
									<mark class="schedule-undone" 
											id=<?= $match->match_number . '-' . $match->red_2 ?>>
										<?= $match->red_2 ?>
									</mark>
								</a>
							</td>
							<td class="schedule-red schedule-mid">
								<a style="color: black;" href=<?= '/?p=teamdata&team=' . $match->red_3 ?>>
									<mark class="schedule-undone" 
											id=<?= $match->match_number . '-' . $match->red_3 ?>>
										<?= $match->red_3 ?>
									</mark>
								</a>
							</td>
							<td class="schedule-blue">
								<a style="color: black;" href=<?= '/?p=teamdata&team=' . $match->blue_1 ?>>
									<mark class="schedule-undone" 
											id=<?= $match->match_number . '-' . $match->blue_1 ?>>
										<?= $match->blue_1 ?>
									</mark>
								</a>
							</td>
							<td class="schedule-blue">
								<a style="color: black;" href=<?= '/?p=teamdata&team=' . $match->blue_2 ?>>
									<mark class="schedule-undone" 
											id=<?= $match->match_number . '-' . $match->blue_2 ?>>
										<?= $match->blue_2 ?>
									</mark>
								</a>
							</td>
							<td class="schedule-blue">
								<a style="color: black;" href=<?= '/?p=teamdata&team=' . $match->blue_3 ?>>
									<mark class="schedule-undone" 
											id=<?= $match->match_number . '-' . $match->blue_3 ?>>
										<?= $match->blue_3 ?>
									</mark>
								</a>
							</td>
						</tr>
					<?php $i ++; } ?>
				</table>
			</div>
		</div>
	<?php }
}
?>
