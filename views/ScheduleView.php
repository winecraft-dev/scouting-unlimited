<?php

class ScheduleView implements View
{
  public function render()
  { ?>
    <div class="page-section">
      <a href="/?c=login&do=logout">Logout</a>
      <a href="/?p=dataentry">Data Entry</a>
      <table class=ScheduleTable>
        <tr class="top-bar">

					<th><b>Match</b></th>

					<th><b>Red 1</b></th>

					<th><b>Red 2</b></th>

					<th><b>Red 3</b></th>

					<th><b>Blue 1</b></th>

					<th><b>Blue 2</b></th>

					<th><b>Blue 3</b></th>

					<th><b>Time</b></th>

				</tr>
      <?php
      $schedule = (new MatchScheduleDatabaseModel())->getMatches();
      foreach($schedule as $match)
      {
        ?><td><?php$match->matchnumber;?></td>

      }
      ?>
    </table>
    </div>
  <?php }
}
?>
