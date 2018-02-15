var dataFormPage = "";

function loadDataFormPage() 
{
  request = $.ajax({
      url: "/?c=dataentry&do=display",
      type: "get"
  });
  request.done(function (response, textStatus, jqXHR) {
    if(response == "NOT LOGGED IN")
    {
      window.location.replace("/?p=login");
    }
    else
    {
      dataFormPage = response;
      localStorage.setItem("dataFormPage", dataFormPage);
    }
  });
}

function loadDataFormPageOffline()
{
  dataFormPage = localStorage.getItem("dataFormPage");
}

function pasteDataFormPage()
{
  $('.index-content').empty();
  $('.index-content').append(dataFormPage);
}
