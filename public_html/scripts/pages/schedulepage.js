var schedulePage = "";

function loadSchedulePage() 
{
  request = $.ajax({
      url: "/?c=schedule&do=display",
      type: "get"
  });
  request.done(function (response, textStatus, jqXHR) {
    if(response == "NOT LOGGED IN")
    {
      window.location.replace("/?c=login");
    }
    else
    {
      schedulePage = response;
      localStorage.setItem("schedulePage", schedulePage);
    }
  });
}

function loadSchedulePageOffline()
{
  schedulePage = localStorage.getItem("schedulePage");
}
