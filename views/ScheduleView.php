<?php

class ScheduleView implements View
{
  public function render()
  { ?>
    <div class="page-section">
      <a href="/?c=login&do=logout">Logout</a>
      <a href="/?p=dataentry">Data Entry</a>
    </div>
  <?php }
}
?>
