<?php
class PasswordHash 
{
  protected $user;
  protected $pass;
  protected $phpass;
  
  public function __construct($user, $pass) 
  {
    $this->user = $user;
    $this->pass = $pass;
    $this->phpass = new phpass(8, false);
  }
  
  public function hash() 
  {
    $startTime = microtime(true);
    
    $result = $this->phpass->HashPassword($this->user . $this->pass);
    
    $length = microtime(true) - $startTime;
//    echo '<!-- hashed in ' . $length * 1000 . ' ms -->';
    return $result;
  }
  
  public function verify($hash) 
  {
    return $this->phpass->CheckPassword($this->user . $this->pass, $hash);
  }
}
