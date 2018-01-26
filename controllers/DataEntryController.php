<?php
class DataEntryController extends Controller
{
  public function display()
  {
    if(Session::isLoggedIn())
    {
      (new DataEntryPanelView())->render();
    }
    else
    {
      header("Location: /?p=login");
    }
  }
  
  public function form()
  {
    if(Session::isLoggedIn())
    {
      (new ModulesView())->render();
    }
    else
    {
      header("Location: /?p=login");
    }
  }
  
  public function enterData()
  {
    
  }
}

