<?php
class UserDatabaseModel extends DatabaseModel
{
  public function getFromId($id)
  {
    $query = self::$conn->prepare("SELECT users.*
        FROM users WHERE id=:id LIMIT 1");
    $query->bindValue(':id', $id);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return (new User($result));
  }
  
  public function getFromName($name)
  {
    $query = self::$conn->prepare("SELECT users.*
        FROM users WHERE name=:name LIMIT 1");
    $query->bindValue(':name', $name);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return (new User($result));
  }
  
  public function getUsers()
  {
    $query = self::$conn->prepare(
        'SELECT users.* ' .
        'FROM users ' .
        'WHERE users.approved=0 ' .
        'ORDER BY users.user_type, users.last_name, users.first_name');
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $users = array();
    foreach($result as $val)
    {
      $users[] = (new User($val));
    }
    return $users;
  }
  
  public function createUser($name, $password)
  {
    $hash = (new PasswordHash($name, $password))->hash();
    $query = self::$conn->prepare('INSERT INTO users ' .
        '(name, password) VALUES (:name, :password)');
    $query->bindValue(':name', $name);
    $query->bindValue(':password', $password);
    
    if($query->execute() === false) 
      return false;
    return true;
  }
  
  public function deleteUser($id)
  {
    $query = self::$conn->prepare('DELETE FROM users ' .
        'WHERE id=:id LIMIT 1');
    $query->bindValue(':id', $id);
    return $query->execute();
  }
  
  public function editUser($id, $key, $value)
  {
    $query = self::$conn->prepare('UPDATE users SET ' . $key . '=:value WHERE id=:id');
    $query->bindValue(':id', $id);
    $query->bindValue(':value', $value);
    return ($query->execute());
  }
}
