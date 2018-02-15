<?php
class DataEntryController extends Controller
{
  public function display()
  {
    if(Session::isLoggedIn())
    {
      (new DataEntryFormView())->render();
    }
    else
    {
      echo "NOT LOGGED IN";
    }
  }
  
  public function panel()
  {
    if(Session::isLoggedIn())
    {
      (new DataEntryPanelView())->render();
    }
    else
    {
      echo "NOT LOGGED IN";
    }
  }
  
  public function enterData()
  {
    
  }
}

