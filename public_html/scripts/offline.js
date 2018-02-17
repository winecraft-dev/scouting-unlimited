//database data
var schedule = [];
var teams = [];
var matchData = [];
var dataDefinitions = [];

var scoutingPosition = 0;

//static pages stored for offline use will be in their own js files <name>page.js
var offline = false;

function loadOffline()
{
  offline = !navigator.onLine;
  setInterval(function() {
    offline = !navigator.onLine;
  }, 500);
  
  if(!offline)
  {
    //load schedule
    request = $.ajax({
        url: "/?c=offline&do=getSchedule",
        type: "get"
    });
    request.done(function (response, textStatus, jqXHR) {
      if(response == "NOT LOGGED IN")
      {
        window.location.replace("/?c=login");
      }
      else
      {
        var list = JSON.parse(response);
        list.forEach(function(item, index) {
          schedule.push(new Match(item['match_number'], item['time'], item['red_1'], item['red_2'], item['red_3'], item['blue_1'], item['blue_2'], item['blue_3']));
        });
        localStorage.setItem("schedule", response);
      }
    });
    
    //load teams
    request = $.ajax({
        url: "/?c=offline&do=getTeams",
        type: "get"
    });
    request.done(function (response, textStatus, jqXHR) {
      if(response == "NOT LOGGED IN")
      {
        window.location.replace("/?c=login");
      }
      else
      {
        var list = JSON.parse(response);
        list.forEach(function(item, index) {
          teams.push(new Team(item['number'], item['name'], item['pit_notes'], item['averages']));
        });
        localStorage.setItem("teams", response);
      }
    });
    
    //get scouting position
    request = $.ajax({
        url: "/?c=adminpanel&do=getScoutingPosition",
        type: "get"
    });
    request.done(function (response, textStatus, jqXHR) {
      if(response == "NOT LOGGED IN")
      {
        window.location.replace("/?c=login");
      }
      else
      {
        scoutingPosition = response;
        localStorage.setItem("scoutingPosition", response);
      }
    });
    
    //load static pages
    loadSchedulePage();
    loadAdminPanelPage();
    loadErrorPage();
    loadDataFormPage();
  }
  else
  {
    response = localStorage.getItem("schedule");
    var list = JSON.parse(response);
    list.forEach(function(item, index) {
      schedule.push(new Match(item['match_number'], item['time'], item['red_1'], item['red_2'], item['red_3'], item['blue_1'], item['blue_2'], item['blue_3']));
    });
    
    response = localStorage.getItem("teams");
    var list = JSON.parse(response);
    list.forEach(function(item, index) {
      teams.push(new Team(item['number'], item['name'], item['pit_notes'], item['averages']));
    });
    
    scoutingPosition = localStorage.getItem("scoutingPosition");
        
    loadSchedulePageOffline();
    loadAdminPanelPageOffline();
    loadErrorPageOffline();
    loadDataFormPageOffline();
    
    completeAjax();
  }
}
