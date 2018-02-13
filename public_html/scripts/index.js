$(document).ready(function() {
  loadOffline();
  storeSession();
});

$(document).ajaxStop(function() {
  setPage(localStorage.getItem("url"));
});

$(document).on('click', 'a', function(e) {
  e.preventDefault();
  var url = new URL("http://localhost" + $(this).attr('href'));
  
  if(typeof(url.searchParams.get("c")) != "undefined" && url.searchParams.get("c") != null)
  {
    window.location.href = $(this).attr("href");
    return;
  }
  localStorage.setItem("url", $(this).attr('href'));
  setPage(localStorage.getItem("url"));
});

//0 = data entry panel, 1 = schedule, 2 = teams list, 3 = rankings
function setPage(link)
{
  var url = new URL("http://localhost" + link);
  $('.index-content').empty();
  switch(url.searchParams.get("p"))
  {
    case 'adminpanel':
      document.title = "Admin Panel - CRyptonite Robotics";
      $('.index-content').append(adminPanelPage);
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
