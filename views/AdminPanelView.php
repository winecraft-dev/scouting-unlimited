<?php
class AdminPanelView extends PageView 
{
  protected $title = "Admin Panel - CRyptonite Robotics";

  public function renderBody()
  { ?>
    <div class="page">
      <div class="page-content">
        <p class="words">Put in event code:</p>
        <form class="loadData" action="/?p=adminpanel&do=loadTeams" method="post">
          <input type="text" name="eventCode"><br><br>
          <input type="submit" value="data_load" name="loadData"> 
        </form>
        <form class="loadData" action="/?p=adminpanel&do=loadSchedule" method="post">
          <input type="text" name="eventCode"><br><br>
          <input type="submit" value="data_load" name="loadData"> 
        </form>
      </div>
    </div>
  <?php }
}
?>

