<?php
class ModulesView extends PageView
{
  protected $title = 'Data Entry Panel - CRyptonite Robotics';
  
  protected function renderBody()
  { ?>
    <div class="page">
	<link rel="stylesheet" type="text/css" href="/stylesheets/styles/Modules/integer.css"/>
	<script type="text/javascript" src="/scripts/modules/integer.js"></script>
      <div class="page-content">
        <? /* 
          Daniel, put all of your test modules here. Make a CSS and JS file in the folder
          for each of your modules so that calling them is really easy. To get to this page,
          type http://localhost/form into the URL bar.
          
          In order to call all of the CSS, open public_html/SuperCSSLoader.php and add the
          filepaths to the list. With JS, open views/PageView.php and call them like I have.
        */ ?>
		<div class="integer-container">
		<form action="/">
		
		<div class="number-rows">
		+
		
		<br>

		<div id="test">INT_Place_Holder: <input type="number1" name="Int_Value" value=0>
			
		<div class="number-rows">
		-
		</div>		
		</div>
		</div>
			<br>
			INT_Place_Holder: <input type="number2" name="Int_Value" value="0">
			<img class="integer-arrowup" src="images/add-one.gif">
			<img class="integer-arrowdown" src="images/minus-one.gif" >
			<br>
		<input type="submit" value="Submit">
		</form>
		</div>


      </div>
    </div>
  <?php }
}
?>
