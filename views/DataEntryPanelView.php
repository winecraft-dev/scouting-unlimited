<?php
class DataEntryPanelView extends PageView
{
  protected $title = 'Data Entry Panel - CRyptonite Robotics';
  
  protected function renderBody()
  { ?>
    <div class="page">
      <div class="page-content">
        <?php echo (new MatchDataDatabaseModel())->getMatchData(21, 624)->encode(); ?>
      </div>
    </div>
  <?php }
}
?>
