<?php

class ScheduleView implements View
{
  public function render()
  { ?>
    <div class="schedule-content">
      <a href="/?c=login&do=logout">Logout</a>
      <a href="/?p=dataentry">Data Entry</a>
    </div>
  <?php }
}
?>
