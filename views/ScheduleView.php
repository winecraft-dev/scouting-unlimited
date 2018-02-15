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
              <td class="schedule-mid schedule-match-number"><?= $match->match_number ?></td>
              <td class="schedule-red">
                <?php $this->checkMatchScouted($match->match_number, $match->red_1); ?>
              </td>
              <td class="schedule-red">
                <?php $this->checkMatchScouted($match->match_number, $match->red_2); ?>
              </td>
              <td class="schedule-red schedule-mid">
                <?php $this->checkMatchScouted($match->match_number, $match->red_3); ?>
              </td>
              <td class="schedule-blue">
                <?php $this->checkMatchScouted($match->match_number, $match->blue_1); ?>
              </td>
              <td class="schedule-blue">
                <?php $this->checkMatchScouted($match->match_number, $match->blue_2); ?>
              </td>
              <td class="schedule-blue">
                <?php $this->checkMatchScouted($match->match_number, $match->blue_3); ?>
              </td>
            </tr>
          <?php $i ++; } ?>
        </table>
      </div>
    </div>
  <?php }
  
  private function checkMatchScouted($match_number, $team_number)
  {
    if((new MatchDataDatabaseModel())->getMatchData($match_number, $team_number) != false)
    { ?>
      <mark class="schedule-done"><?= $team_number ?></mark>
    <?php } else { ?>
      <mark class="schedule-undone"><?= $team_number ?></mark>
    <?php }
  }
}
?>
