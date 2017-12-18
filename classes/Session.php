<?php
class Session 
{  
  protected static $user;
  
  public static function setup() 
  {
    session_start();
    
    if(isset($_SESSION['user_id']))
    {
      self::$user = (new UserDatabaseModel())->getFromId($_SESSION['user_id']);
    }    
  }
  
  public static function getLoggedInUser() 
  {
    if(self::isLoggedIn())
    {
      return self::$user;
    }
    return false;
  }
  
  public static function isLoggedIn() 
  {
    return isset($_SESSION['user_id']);
  }
  
  public static function logOut() 
  {
    self::$user = null;
    unset($_SESSION['user_id']);
  }
  
  public static function logIn($user) 
  {
    self::$user = $user;
    $_SESSION['user_id'] = $user->id;
  }
  
  public static function redirectOut()
  {
    $urlToDirectTo = "/?p=login&";
    
    foreach($_GET as $key => $value)
    {
      $urlToDirectTo .= 't' . $key . '=' . $value . '&';
    }
    $urlToDirectTo = substr($urlToDirectTo, 0, strlen($urlToDirectTo) - 1);
    echo $urlToDirectTo;
    header("Location: " . $urlToDirectTo);
  }
}
