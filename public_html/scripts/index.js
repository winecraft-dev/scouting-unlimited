var oldPage = 0;
var currentPage = 1;

$(document).ready(function() {
  loadOffline();
});

$(document).ajaxStop(function() {
  setPage(currentPage);
  setInterval(setPageByUrl, 500);
});

function setPageByUrl() 
{
  var url = new URL(window.location.href);
  setPage(url.searchParams.get("p"));
}

$(document).on('click', 'a', function(e) {
  e.preventDefault();
  var url = new URL("http://localhost" + $(this).attr('href'));
  
  if(typeof(url.searchParams.get("c")) != "undefined" && url.searchParams.get("c") != null)
  {
    window.location.href = $(this).attr("href");
    return;
  }
  setPage(url.searchParams.get("p"));
  
});

//0 = data entry panel, 1 = schedule, 2 = teams list, 3 = rankings
function setPage(name)
{
  $('.index-content').empty();
  switch(name)
  {
    case 'login':
      window.location.href = "/?c=login";
      break;
    case 'dataentrypanel':
      document.title = "Data Panel - CRyptonite Robotics";
      //data entry panel
      break;
    case 'schedule':
      document.title = "Schedule - CRyptonite Robotics";
      $('.index-content').append(schedulePage);
      break;
    case 'dataentry':
      document.title = "Data Form - CRyptonite Robotics";
      //data entry
      break;
    case 'teams':
      document.title = "Teams - CRyptonite Robotics";
      //
      break;
    case 'rankings':
      document.title = "Rankings - CRyptonite Robotics";
      //
      break;
    case 'team':
      document.title = " - CRyptonite Robotics";
      //
      break;
    case 'match':
      //
      break;
  }
}
