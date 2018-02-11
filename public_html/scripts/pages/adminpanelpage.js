var adminPanelPage = "";

function loadAdminPanelPage() 
{
  request = $.ajax({
      url: "/?c=adminpanel&do=display",
      type: "get"
  });
  request.done(function (response, textStatus, jqXHR) {
    if(response == "NOT LOGGED IN")
    {
      window.location.replace("/?p=login");
    }
    else
    {
      adminPanelPage = response;
      localStorage.setItem("adminPanelPage", adminPanelPage);
    }
  });
}

function loadAdminPanelPageOffline()
{
  adminPanelPage = localStorage.getItem("adminPanelPage");
}
