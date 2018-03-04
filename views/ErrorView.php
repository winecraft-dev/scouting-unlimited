<?php
class ErrorView
{  
  public function render($errorText)
  { ?>
    <div class="page">
		  <div class="error-text">
			  <h1>Error!</h1>
			  <p><div class="error-message"><?=$errorText?></div> Redirect to <a href="/?p=dataform">Data Form</a>.</p>
		  </div>
		</div>
  <?php }
}
?>
