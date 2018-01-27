<?php
class Team 
{
  public $number;
  public $name;
  
  public function __construct($data)
  {
    $this->number = $data['number'];
    $this->name = $data['name'];
  }
}
