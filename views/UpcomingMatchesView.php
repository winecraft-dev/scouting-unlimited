<?php
class UpcomingMatchesView implements View
{
	public function render()
	{ ?>
		<div class="page-section">
			<div class="page-section-head">
				Upcoming Matches
			</div>
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
				</table>
			</div>
		</div>
	<?php }
}