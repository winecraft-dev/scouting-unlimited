<?php
class User 
{
  public $id;
  
  public $name;
	public $password; //the password hash
	
	public $administrator; //permissions_level: -1=not approved, 0=scout, 1=admin
	
	public function __construct($data)
	{
	  $this->id = $data['id'];
	  
		$this->name = $data['name'];
		$this->password = $data['password'];
		
		$this->administrator = $data['administrator'];
	}
	
	public function checkPassword($checkPass) 
  {
    return (new PasswordHash($this->name, $checkPass))->verify($this->password);
  }
  
  public function editUser($key, $value)
  {
    (new UserDatabaseModel())->editUser($this->id, $key, $value);
  }
  
  public function administrator()
  {
    return $this->administrator == 1;
  }
}
