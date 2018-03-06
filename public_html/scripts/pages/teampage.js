var teamPage = "";

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
		loadTeams();
		loadPitNotesDefinitions();

		loadPage();
		loadErrorPage();
	}
	else
	{
		loadTeamsOffline();
		loadPitNotesDefinitionsOffline();

		loadPageOffline();
		loadErrorPageOffline();
		
		completeAjax();
	}
}

function loadPage() 
{
	request = $.ajax({
			url: "/?p=teams&do=displayTeam",
			type: "get"
	});
	request.done(function(response, textStatus, jqXHR) {
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?p=login");
		}
		else
		{
			teamPage = response;
			localStorage.setItem("teamPage", teamPage);
		}
	});
}

function loadPageOffline()
{
	teamPage = localStorage.getItem("teamPage");
}

function pastePage()
{
	var url = new URL("http://localhost" + window.location.href);
	var teamPageTeam = url.searchParams.get("team");

	document.title = "Team " + teamPageTeam + " - CRyptonite Robotics";

	var team = getTeam(teamPageTeam);

	$('.index-content').empty().append(teamPage);
	$('#pit-notes').text("Pit Notes - " + teamPageTeam);
	$('#team-number').text(teamPageTeam).hide();

	if(!offline)
		$('#image-iframe').attr('src', '/?p=teams&do=teamImage&team=' + teamPageTeam);
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