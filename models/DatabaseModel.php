<?php
class DatabaseModel 
{
  protected static $conn;
  public function __construct() 
  {
    try {
      if (!isset(self::$conn)) 
      {
        $config = $GLOBALS['config'];
        self::$conn = (new PDO($config->get('dbpath'), 
                               $config->get('dbuser'), 
                               $config->get('dbpass'), 
                               array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")));
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
    } catch (PDOException $ex) {
      (new ErrorView())->render("Database Connection has failed!");
    }
  }
}
