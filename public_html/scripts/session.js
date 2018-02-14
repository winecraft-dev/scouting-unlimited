function storeSession() 
{
  var cookie = new URLSearchParams(document.cookie);
  var sessionID;
  if(cookie.has("PHPSESSID"))
  {
    sessionID = cookie.get("PHPSESSID");
    
    localStorage.setItem("PHPSESSID", sessionID);
  }
  
  setInterval(function() {
    cookie.set("PHPSESSID", localStorage.getItem("PHPSESSID"));
    console.log("test");
  }, 10000);
}

function reinstateSession() 
{
  cookie.set("PHPSESSID", localStorage.getItem("PHPSESSID"));
  window.location.href = "/";
}
