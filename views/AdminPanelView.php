<?php
class AdminPanelView implements View {

    protected $title = "Setup - CRyptonite Robotics";

    public function render(){
        ?>
        <!DOCTYPE html>
        <html>
          <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">  
            <title><?= $this->title ?></title>
            <link rel="icon" href="/favicon.ico">
            <meta name="theme-color" content="#222222">
            <link rel="stylesheet" type="text/css" href="/SuperCSSLoader.php">
            <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
          </head>
          <body>
          <p class="words">Put in event code:</p>
          <form class="loadData" method="post">
                <input type="text" name="eventCode"><br><br>
                <input type="submit" value="data_load" name="loadData"> //load team list,match schedule,rankings
          </form>
          </body>
        </html>
        <?php
    }
}
?>

