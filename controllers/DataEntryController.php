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
  
  public function modules()
  {
    if(Session::isLoggedIn())
    {
      (new ModulesView())->render();
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
    $rawData = isset($_POST['data']) ? $_POST['data'] : null;
    if($rawData == null)
    {
      echo "NO DATA";
      return;
    }
    $matchData = MatchData::jsonDecode($rawData);
    (new MatchDataDatabaseModel())->enterData($matchData);
  }
}

