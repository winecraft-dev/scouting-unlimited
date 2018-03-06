<?php
class IndexPageView extends PageView
{
	public function __construct($title, $script)
	{
		parent::__construct($title, $script);
	}
  public function renderBody()
  { ?>
    <div class="page">
      <div class="index-content">
      
      </div>
    </div>
  <?php }
}
?>
