<?php
class LoginController extends Controller
{
  public function display()
  {
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
      
      echo "/?p=dataentrypanel";
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
    header("Location: /?c=login");
  }
}
