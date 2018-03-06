var dataFormPage = "";

function loadOffline()
{
	offline = !navigator.onLine;
	setInterval(function() {
		checkOffline();
	}, 500);

	loadOfflineMatchData();
	loadOfflinePitNotes();

	if(!offline)
	{
		loadSchedule();
		loadTeams();
		loadMatchData();
		loadScoutingPosition();

		loadPage();
		loadErrorPage();
	}
	else
	{
		loadScheduleOffline();
		loadTeamsOffline();
		loadMatchDataOffline();
		loadScoutingPositionOffline();
		
		loadPageOffline();
		loadErrorPageOffline();
		
		completeAjax();
	}
}

function loadPage() 
{
	request = $.ajax({
			url: "/?p=dataentry&do=display",
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

function loadPageOffline()
{
	dataFormPage = localStorage.getItem("dataFormPage");
}

function pastePage()
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
	if($(this).val() > schedule.length || $(this).val() < 1)
	{
		alert("Match does not exist");
		$(this).val("1");
	}
	var team = "";
	var matchI = schedule[$(this).val() - 1];
	
	console.log(matchI);
	switch(scoutingPosition)
	{
		case '1':
			team = matchI.red_1;
			break;
		case '2':
			team = matchI.red_2;
			break;
		case '3':
			team = matchI.red_3;
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
	$('#team_number.dataentry-module-number').val(team);
});

$(document).on('click', '.dataentry-module-number-arrowup',function() {
	var id = $(this).attr('id');
	var value = parseInt($('#' + id + '.dataentry-module-number').val()) + 1;
	$('#' + id + '.dataentry-module-number').val(value);
});

$(document).on('click', '.dataentry-module-number-arrowdown', function() {
	var id = $(this).attr('id');
	var value = parseInt($('#' + id + '.dataentry-module-number').val()) - 1;
	$('#' + id + '.dataentry-module-number').val(value);
});

$(document).on('click', '#data-entry.dataentry-submit', function() {
	var pass = true;
	var data = new Object();
	$('.dataentry-module-number').each(function() {
		data[$(this).attr('id').replace(/-/gi, " ")] = ($(this).val() === "" ? 0 : parseInt($(this).val()));
	});
	$('.dataentry-module-boolean').each(function() {
		data[$(this).attr('id').replace(/-/gi, " ")] = ($(this).is(':checked') ? 1 : 0);
	});
	$('.dataentry-module-text').each(function() {
		data[$(this).attr('id').replace(/-/gi, " ")] = $(this).val().replace(/'/gi, "").replace(/"/gi, "");
	});
	$('.dataentry-module-dropdown').each(function() {
		if($(this).val() == "0")
		{
			if(!$('#dead').is(':checked'))
			{
				alert("You must fill out the dropdown: " + $(this).attr('id').replace(/-/gi, " "));
				pass = false;
			}
		}
		data[$(this).attr('id').replace(/-/gi, " ")] = $(this).val();
	});
	
	if(!pass)
	{
		return;
	}
	
	var team_number = data['team_number'];
	delete data['team_number'];
	var match_number = data['match_number'];
	delete data['match_number'];
	
	if(team_number == 0 || match_number == 0)
	{
		alert("You must provide Match and Team numbers");
		return;
	}
	var dead = data['dead'];
	delete data['dead'];
	var dead_shortly = data['dead_shortly'];
	delete data['dead_shortly'];

	var values = {
		'data': JSON.stringify({
			'team_number': team_number,
			'match_number': match_number,
			'dead': dead,
			'dead_shortly': dead_shortly,
			'data': data
		})
	};
	
	if(!offline)
	{
		submitMatchData(values);
	}
	else
	{
		switch(storeOfflineMatchData(values['data']))
		{
			case "OVERRIDE?":
				if(confirm("This match has already been scouted. Would you like to override it?"))
				{
					switch(overrideOfflineMatchData(values['data']))
					{
						case "SUCCESS":
							alert("Match " + match_number + ", Team " + team_number + " successfully overriden offline");
							window.location.reload();
							break;
					}
				}
				break;
			case "SUCCESS":
				alert("Match " + match_number + ", Team " + team_number + " successfully scouted offline");
				window.location.reload();
				break;
		}
	}
});