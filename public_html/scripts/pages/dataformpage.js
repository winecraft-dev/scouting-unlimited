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
  if(scoutingPosition > 6 || scoutingPosition < 1)
  {
    pasteErrorPage("You have not been assigned a team by the Head Scout. When (s)he gives you a position, refresh the page.");
    return;
  }
  $('.index-content').empty();
  $('.index-content').append(dataFormPage);
  
  $('#prematch.dataentry-subform').css('display', 'block');
  $('#prematch.dataentry-tab').css('background-color', '#333');
  $('#prematch.dataentry-tab').css('color', '#ffffff');
}

$(document).on('click', '.dataentry-tab', function() {
  var id = $(this).attr('id');
  
  $('.dataentry-subform').css('display', 'none');
  $('#' + id + '.dataentry-subform').css('display', 'block');
  
  $('.dataentry-tab').css('background-color', '#777');
  $('.dataentry-tab').css('color', 'black');
  $('#' + id + '.dataentry-tab').css('background-color', '#333');
  $('#' + id + '.dataentry-tab').css('color', '#ffffff');
});

$(document).on('change', '#match_number.dataentry-module-number', function(e) {
  if($(this).val() >= schedule.length || $(this).val() < 1)
  {
    alert("Match does not exist");
    $(this).val("1");
  }
  console.log(schedule[$(this).val() - 1]);
  var team = "";
  var matchI = schedule[$(this).val() - 1];
  
  switch(scoutingPosition)
  {
    case '1':
      team = matchI.red_1;
      break;
    case '2':
      team = matchI.red_2;
      break;
    case '3':
      team = matchI.blue_3;
      break;
    case '4':
      team = matchI.blue_1;
      break;
    case '5':
      team = matchI.blue_2;
      break;
    case '6':
      team = matchI.blue_3;
      break;
    default:
      pasteErrorPage("You have not been assigned a team by the Head Scout. When (s)he gives you a position, refresh the page.");
      return;
  }
  console.log(matchI.red_1 + ' ' + scoutingPosition + ' ' + team);
  $('#team_number.dataentry-module-number').val(team);
});
