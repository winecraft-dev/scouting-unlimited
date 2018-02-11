<?php

class ScheduleView implements View
{
  public function render()
  { ?>
    <div class="page-section">
      <a href="/?c=login&do=logout">Logout</a>
      <a href="/?p=dataentry">Data Entry</a>
      <table>
        <tr>

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
      { ?>
        <tr>

          <td><?= $match->match_number ?></td>
          <td><?= $match->red_1 ?></td>
          <td><?= $match->red_2 ?></td>
          <td><?= $match->red_3 ?></td>
          <td><?= $match->blue_1 ?></td>
          <td><?= $match->blue_2 ?></td>
          <td><?= $match->blue_3 ?></td>
          <td><?= $match->time ?></td>
          
        </tr>

      <?php}
      ?>
    </table>
    </div>
  <?php }
}
}
?>
