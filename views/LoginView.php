<?php
class LoginView implements View
{
  protected $title = 'Login - CRyptonite Robotics';
  
  public function render()
  { ?>
    <!DOCTYPE html>
    <html manifest="login.appcache">
      <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <title><?= $this->title ?></title>
        <link rel="icon" href="/favicon.ico">
        <meta name="theme-color" content="#222222">
        <link rel="stylesheet" type="text/css" href="/SuperCSSLoader.php">
        <script type="text/javascript" src="/scripts/jquery-3.3.1.min.js"></script>
        <script src="/scripts/login.js"></script>
      </head>
      <body>
        <div class="login-page">
        </div>
        <div class="login-daddy-table">
          <div class="login-child-cell">
            <div class="login-form-container">
              <div class="login-form-header"></div>
              <div class="login-form-message">  
                <?php if(isset($_GET['register'])) echo 'Your registration is pending approval'; ?>
              </div>
              <form autocomplete="on" id="login-form">
                <input class="login-form-input" id="name" type="text" placeholder="Username"></input>
                <input class="login-form-input" id="password" type="password" placeholder="Password"></input>
                <button id='login' class="login-button">Login</button>
              </form>
              <a href="#" class="login-link" id="register">Register</a>
            </div>
          </div>
        </div>
      </body>
    </html>
  <?php }
}
?>
