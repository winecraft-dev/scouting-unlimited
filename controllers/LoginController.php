<?php
class LoginController extends Controller
{
  public function display()
  {
    $redirectUrl = "/?";
    
    foreach($_GET as $key => $value)
    {
      if($key != 'p' && $key != 'do')
      {
        $redirectUrl .= substr($key, 1) . '=' . $value . '&'; 
      }
    }
     
    $_SESSION['redirect_url'] = substr($redirectUrl, 0, strlen($redirectUrl) - 1);
    
    if(!(Session::isLoggedIn()))
    {
      if(isset($_GET['register']))
      {
        (new LoginView())->render(true);
      }
      else
      {
        (new LoginView())->render(false);
      }
    }
    else
    {
      header("Location: /?p=dataentry");
    }  
  }
  
  public function login()
  {
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    
    if($password == null || $name == null)
    {
      echo "LACKING CREDENTIALS";
      return;
    }
    
    $model = new UserDatabaseModel();
    
    $user = $model->getFromName($name);
    
    if($user !== false && $user->checkPassword($password))
    {
      if($user->administrator == -1)
      {
        echo "NOT ENOUGH PERMISSIONS";
        return;
      }
      Session::logIn($user);
      
      if($_SESSION['redirect_url'] != null)
      {
        echo $_SESSION['redirect_url'];
      }
      else
      {
        echo "/?p=dataentry";
      }
      return;
    }
    else
    {
      echo "FALSE";
      return;
    }
  }
  
  public function register()
  {
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    
    $model = new UserDatabaseModel();
    $user = $model->getFromName($name);
    
    if($user !== false)
    {
      echo "User Exists";
      return;
    } 
    
    if(strlen($password) < 8)
    {
      echo "Password must be greater than 8 characters";
      return;
    }
    
    if((new UserDatabaseModel())->createUser($name, $password))
    {
      echo "REGISTERED";
    }
    else
    {
      echo "ERROR";
    }
  }
  
  public function logout()
  {
    Session::logout();
    header("Location: /?p=login");
  }
}
