var teamsListPage = "";

function loadTeamsListPage() 
{
  request = $.ajax({
      url: "/?c=teams&do=display",
      type: "get"
  });
  request.done(function (response, textStatus, jqXHR) {
    if(response == "NOT LOGGED IN")
    {
      window.location.replace("/?p=login");
    }
    else
    {
      teamsListPage = response;
      localStorage.setItem("teamsListPage", teamsListPage);
    }
  });
}

function loadTeamsListPageOffline()
{
  teamsListPage = localStorage.getItem("teamsListPage");
}
