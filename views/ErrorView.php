<?php
class ErrorView
{  
  public function render($errorText)
  { ?>
  	<!DOCTYPE html>
  	<html>
  		<head>
  			<meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <title><?php echo "Error! - CRyptonite Robotics"; ?></title>
        <link rel="icon" href="/favicon.ico">
        <meta name="theme-color" content="#222222">
        <link rel="stylesheet" type="text/css" href="/SuperCSSLoader.php">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  		</head>
  		<body>
				<div class="page">
					<div class="error-text">
						<h1>Error!</h1>
						<p><?=$errorText?> Redirect to <a href="/?p=dataentry">Data Entry Panel</a>.</p>
					</div>
				</div>
				<?php PageView::renderFooter(); ?>
			</body>
		</html>
  <?php }
}
?>
