<?php
class ModulesView extends PageView
{
  protected $title = 'Data Entry Panel - CRyptonite Robotics';
  
  public function renderBody()
  { ?>
    <div class="page">
      <div class="page-content">
        <? /* 
          Daniel, put all of your test modules here. Make a CSS and JS file in the folder
          for each of your modules so that calling them is really easy. To get to this page,
          type http://localhost/form into the URL bar.
          
          In order to call all of the CSS, open public_html/SuperCSSLoader.php and add the
          filepaths to the list. With JS, open views/PageView.php and call them like I have.
        */ ?>
    <div class="dataentry-module-number-arrowup"></div>
	  <input id="test" class="dataentry-module-number" type="number" value=0>
    <div class="dataentry-module-number-arrowdown"></div>
			
		<br>
		</div></div>
  <?php }
}
?>
