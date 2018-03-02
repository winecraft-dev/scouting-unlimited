var teamPage = "";

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

function pasteTeamPage(teamnumber)
{
	if(!offline)
	{
		loadTeams();

		$(document).ajaxStop(function() {
			if(teamsLoading)
			{
				teamsLoading = false;
				pasteTeamPageContent(teamnumber);
			}
		});
	}
	else
	{
		pasteTeamPageContent(teamnumber);
	}
}

function pasteTeamPageContent(teamnumber)
{
	document.title = "Team " + teamnumber + " - CRyptonite Robotics";

	var team = getTeam(teamnumber);

	$('.index-content').empty().append(teamPage);
	$('#pit-notes').text("Pit Notes - " + teamnumber);
	$('#team-number').text(teamnumber).hide();

	if(!offline)
		$('#image-iframe').attr('src', '/?c=teams&do=teamImage&team=' + teamnumber);
	else
		$('#image-iframe').replaceWith("You cannot view the image offline");

	for(index in team.pit_notes)
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
				$('#' + id).val(team.pit_notes[index]);
				break;
			case '1':
				$('#' + id).val(team.pit_notes[index]);
				break;
			case '2':
				$('#' + id).prop('checked', team.pit_notes[index] == 1);
				break;
			case '3':
				$('#' + id).val(team.pit_notes[index]);
				break;
			case '4':
				$('#' + id).val(team.pit_notes[index]);
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

	}
});

function submitPitNotes(values)
{
	request = $.ajax({
		url: "/?c=teams&do=enterPitNotes",
		type: "post",
		data: values
	}).done(function(response, textStatus, jqXHR) {
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
			alert("Pit notes for team " + values['team_number'] + " have been successfully uploaded.");
		}
	});
}