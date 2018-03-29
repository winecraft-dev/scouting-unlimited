<?php
class UpcomingMatchesView implements View
{
	public function render()
	{ $definitions = (new DataDefinitionsDatabaseModel())->getAverageDefinitions(); ?>
		<div class="page-section">
			<div class="page-section-head">
				Upcoming Match 
			</div>
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
					<th class="schedule-head"><a id="red1" href="" style="color:white;">Red 1</a></th>
					<th class="schedule-head"><a id="red2" href="" style="color:white;">Red 2</a></th>
					<th class="schedule-head schedule-mid"><a id="red3" href="" style="color:white;">Red 3</a></th>
					<th class="schedule-head"><a id="blue1" href="" style="color:white;">Blue 1</a></th>
					<th class="schedule-head"><a id="blue2" href="" style="color:white;">Blue 2</a></th>
					<th class="schedule-head"><a id="blue3" href="" style="color:white;">Blue 3</a></th>
				</tr>
				<tr class="schedule-zebra-light">
					<td class="schedule-match-number schedule-mid">Image</td>
					<td class="">
						<iframe height="80px" id="red1-image-iframe" class="dataentry-module-text" style="padding: 0px; border: 0px;" src=""></iframe>
					</td>
					<td class="">
						<iframe height="80px" id="red2-image-iframe" class="dataentry-module-text" style="padding: 0px; border: 0px;" src=""></iframe>
					</td>
					<td class="schedule-mid">
						<iframe height="80px" id="red3-image-iframe" class="dataentry-module-text" style="padding: 0px; border: 0px;" src=""></iframe>
					</td>
					<td class="">
						<iframe height="80px" id="blue1-image-iframe" class="dataentry-module-text" style="padding: 0px; border: 0px;" src=""></iframe>
					</td>
					<td class="">
						<iframe height="80px" id="blue2-image-iframe" class="dataentry-module-text" style="padding: 0px; border: 0px;" src=""></iframe>
					</td>
					<td class="">
						<iframe height="80px" id="blue3-image-iframe" class="dataentry-module-text" style="padding: 0px; border: 0px;" src=""></iframe>
					</td>
				</tr>
				<?php $i = 0; foreach($definitions as $definition) { ?>
					<?php if($definition['driveteam_view'] == 1) { ?>
						<?php if($i % 2 == 0) { ?>
							<tr class="schedule-zebra-dark">
						<?php } else { ?>
							<tr class="schedule-zebra-light">
						<?php } ?>
							<td class="schedule-match-number schedule-mid">
								<?= $definition['title'] ?>
							</td>
							<td id=<?= 'red1-' . str_replace(" ", "-", $definition['title']) ?>></td>
							<td id=<?= 'red2-' . str_replace(" ", "-", $definition['title']) ?>></td>
							<td id=<?= 'red3-' . str_replace(" ", "-", $definition['title']) ?> class="schedule-mid"></td>
							<td id=<?= 'blue1-' . str_replace(" ", "-", $definition['title']) ?>></td>
							<td id=<?= 'blue2-' . str_replace(" ", "-", $definition['title']) ?>></td>
							<td id=<?= 'blue3-' . str_replace(" ", "-", $definition['title']) ?>></td>
						</tr>
					<?php $i ++; } ?>
				<?php } ?>
			</table>
		</div>
	<?php }
}