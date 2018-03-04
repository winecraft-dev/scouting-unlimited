var teamPage = "";

var teamPageTeam = -1;

function loadTeamPage() 
{
	request = $.ajax({
			url: "/?c=teams&do=displayTeam",
			type: "get"
	});
	request.done(function(response, textStatus, jqXHR) {
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?c=login");
		}
		else
		{
			teamPage = response;
			localStorage.setItem("teamPage", teamPage);
		}
	});
}

function loadTeamPageOffline()
{
	teamPage = localStorage.getItem("teamPage");
}

function pasteTeamPage(t)
{
	if(!offline)
	{
		teamPageTeam = t;
		pasteTeamPageContent(teamPageTeam);
	}
	else
	{
		teamPageTeam = t;
		pasteTeamPageContent(teamPageTeam);
	}
}

function pasteTeamPageContent()
{
	pastingTeamPage = false;
	document.title = "Team " + teamPageTeam + " - CRyptonite Robotics";

	var team = getTeam(teamPageTeam);

	$('.index-content').empty().append(teamPage);
	$('#pit-notes').text("Pit Notes - " + teamPageTeam);
	$('#team-number').text(teamPageTeam).hide();

	if(!offline)
		$('#image-iframe').attr('src', '/?c=teams&do=teamImage&team=' + teamPageTeam);
	else
		$('#image-iframe').replaceWith("You cannot view the image offline");

	var pit_notes;
	if(getOfflinePitNotes(teamPageTeam) == null)
		pit_notes = team.pit_notes;
	else
	{
		$('#pit-notes').text("Pit Notes - " + teamPageTeam + " - Scouted Offline");
		var op = getOfflinePitNotes(teamPageTeam);
		pit_notes = JSON.parse(op['data']);
	}

	for(index in pit_notes)
	{
		var id = index.replace(/ /g, "-");

		var definition;
		for(d of pitNotesDefinitions)
		{
			if(d['title'] == index)
			{
				definition = d;
				break;
			}
		}

		switch(definition['module'])
		{
			case '0':
				$('#' + id).val(pit_notes[index]);
				break;
			case '1':
				$('#' + id).val(pit_notes[index]);
				break;
			case '2':
				$('#' + id).prop('checked', pit_notes[index] == 1);
				break;
			case '3':
				var val = pit_notes[index] == null ? 0 : pit_notes[index];
				$('#' + id).val(val);
				break;
			case '4':
				$('#' + id).val(pit_notes[index]);
				break;
		}
	}

	for(index in team.averages)
	{
		var id = index.replace(/ /g, "-");

		$('#' + id).text(team.averages[index]);
	}
}

$(document).on('click', '#pit_notes.dataentry-submit', function() {
	var team = $('#team-number').text();

	var data = {};
	for(d of pitNotesDefinitions)
	{
		var id = d['title'].replace(/ /g, "-");
		if(d['module'] == '2')
		{
			data[d['title']] = $('#' + id).prop('checked') == true ? 1 : 0;
		}
		else
		{
			data[d['title']] = $('#' + id).val();
		}
	}

	var values = {
		team_number: team,
		data: JSON.stringify(data)
	};
	
	if(!offline)
	{
		submitPitNotes(values);
	}
	else
	{
		switch(storeOfflinePitNotes(values))
		{
			case "SUCCESS":
				window.location.reload();
				alert("Team " + team_number + " pit notes successfully scouted offline");
				break;
		}
	}
});

function submitPitNotes(values)
{
	request = $.ajax({
		url: "/?c=teams&do=enterPitNotes",
		type: "post",
		data: values
	}).done(function(response, textStatus, jqXHR) {
		console.log(response);
		if(response == "NOT LOGGED IN")
		{
			window.location.href = "/?c=login";
		}
		else if(response == "NOT ENOUGH PERMISSIONS")
		{
			window.location.href = "/?c=login&do=logout";
		}
		else if(response == "NO DATA")
		{
			
		}
		else if(response == "SUCCESS")
		{
			window.location.reload();
			deleteOfflinePitNotes(values['team_number']);
			alert("Pit notes for team " + values['team_number'] + " have been successfully uploaded.");
		}
	});
}