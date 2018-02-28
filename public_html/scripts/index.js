var initialAjaxCompleted = false;

$(document).ready(function() {
  loadOffline();
  storeSession();
});

$(document).ajaxStop(completeAjax);

$(document).on('click', 'a', function(e) {
  e.preventDefault();
  var url = new URL("http://localhost" + $(this).attr('href'));
  
  if(typeof(url.searchParams.get("c")) != "undefined" && url.searchParams.get("c") != null)
  {
    window.location.href = $(this).attr("href");
    return;
  }
  localStorage.setItem("url", "http://localhost" + $(this).attr('href'));
  setPage(url);
});

function setPage(link)
{
  var url = new URL(link);
  $('.index-content').empty();
  switch(url.searchParams.get("p"))
  {
    case 'adminpanel':
      document.title = "Admin Panel - CRyptonite Robotics";
      pasteAdminPanelPage();
      break;
    case 'datapanel':
      document.title = "Data Panel - CRyptonite Robotics";
      //data entry panel
      break;
    case 'schedule':
      document.title = "Schedule - CRyptonite Robotics";
      $('.index-content').append(schedulePage);
      break;
    case 'dataentry':
      document.title = "Data Form - CRyptonite Robotics";
      pasteDataFormPage();
      break;
    case 'teams':
      document.title = "Teams - CRyptonite Robotics";
      $('.index-content').append(teamsListPage);
      break;
    case 'rankings':
      document.title = "Rankings - CRyptonite Robotics";
      //
      break;
    case 'team':
      document.title = " - CRyptonite Robotics";
      break;
    case 'matchdata':
      pasteMatchDataPage(url.searchParams.get("match"));
      break;
  }
}

function completeAjax()
{
  if(!initialAjaxCompleted) 
  {
    if(offline)
    {
      console.log("Data & Pages loaded locally.");
    }
    else
    {
      console.log("Data & Pages updated from Database.");
    }
    initialAjaxCompleted = true;
    setPage(localStorage.getItem("url"));
  }
}
