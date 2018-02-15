var errorPage = "";

function loadErrorPage() 
{
  request = $.ajax({
      url: "/?c=offline&do=getErrorPage",
      type: "get"
  });
  request.done(function (response, textStatus, jqXHR) {
    if(response == "NOT LOGGED IN")
    {
      window.location.replace("/?p=login");
    }
    else
    {
      errorPage = response;
      localStorage.setItem("errorPage", errorPage);
    }
  });
}

function loadErrorPageOffline()
{
  errorPage = localStorage.getItem("errorPage");
}

function pasteErrorPage(errorText)
{
  $('.index-content').empty();
  $('.index-content').append(errorPage);
  $('.error-message').replaceWith("<div class='error-message'>" + errorText + "</div>");
}
