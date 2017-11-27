<?php
abstract class Controller {
  protected $action;
  
  public function __construct($action) {
    $this->action = $action;
  }
  
  public function executeAction() 
  {
    if(method_exists(get_class($this), $this->action))
    {
      $this->{$this->action}();
    }
    else
    {
      (new ErrorView())->render("Undefined request! Perhaps link is broken.");
    }
  }
}
