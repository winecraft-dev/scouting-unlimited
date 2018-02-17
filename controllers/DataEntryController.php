<?php
class DataEntryController extends Controller
{
  public function display()
  {
    if(Session::isLoggedIn())
    {
      if(Session::getLoggedInUser()->administrator >= 0)
        print (new DataEntryFormView())->render();
      else
        print (new ErrorView())->render("Not Enough Permissions!");
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
      if(Session::getLoggedInUser()->administrator >= 0)
        print (new ModulesView())->render();
      else
        print (new ErrorView())->render("Not Enough Permissions!");
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
      if(Session::getLoggedInUser()->administrator >= 0)
        print (new DataEntryPanelView())->render();
      else
        print (new ErrorView())->render("Not Enough Permissions!");
    }
    else
    {
      echo "NOT LOGGED IN";
    }
  }
  
  public function enterData()
  {
    if(Session::isLoggedIn())
    {
      if(Session::getLoggedInUser()->administrator >= 0)
      {
        $rawData = isset($_POST['data']) ? $_POST['data'] : null;
        if($rawData == null)
        {
          echo "NO DATA";
          return;
        }
        $matchData = MatchData::jsonDecode($rawData);
        
        if((new MatchDataDatabaseModel())->getMatchData($matchData->match_number, $matchData->team_number) !== false)
        {
          echo "MATCH HAS ALREADY BEEN SCOUTED";
          return;
        }
        if((new MatchDataDatabaseModel())->enterData($matchData) !== false)
        {
          echo "SUCCESS";
          return;
        }
        echo "ERROR";
        return;
      }
      else
      {
        echo "NOT ENOUGH PERMISSIONS";
        return;
      }
    }
    else
    {
      echo "NOT LOGGED IN";
      return;
    }
  }
  
  public function updateData()
  {
    if(Session::isLoggedIn())
    {
      if(Session::getLoggedInUser()->administrator >= 0)
      {
        $rawData = isset($_POST['data']) ? $_POST['data'] : null;
        if($rawData == null)
        {
          echo "NO DATA";
          return;
        }
        $matchData = MatchData::jsonDecode($rawData);
        
        (new MatchDataDatabaseModel())->deleteData($matchData->match_number, $matchData->team_number);
        if((new MatchDataDatabaseModel())->enterData($matchData) !== false)
        {
          echo "SUCCESS";
          return;
        }
        echo "ERROR";
        return;
      }
      else
      {
        echo "NOT ENOUGH PERMISSIONS";
        return;
      }
    }
    else
    {
      echo "NOT LOGGED IN";
      return;
    }
  }
}

