var teamPage = "";
var chartView = "";

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
		loadMatchData();
		loadSchedule();
		loadDataDefinitions();
		loadAverageDefinitions();
		loadPitNotesDefinitions();

		loadPopup();
		loadPage();
		loadErrorPage();
	}
	else
	{
		loadTeamsOffline();
		loadMatchDataOffline();
		loadScheduleOffline();
		loadDataDefinitionsOffline();
		loadAverageDefinitionsOffline();
		loadPitNotesDefinitionsOffline();

		loadPopupOffline();
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

async function pastePage()
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

		$('div#' + id).text(team.averages[index]);
	}

	var i = 0;
	var matches = getMatchesByTeam(teamPageTeam);
	for(m of matches)
	{
		var append = '';
		if(i % 2 == 0)
		{
			append += '<tr class="schedule-zebra-light">';
		}
		else
		{
			append += '<tr class="schedule-zebra-dark">';
		}

		if(isUpcoming(m.match_number))
		{
			append += '<td class="schedule-mid schedule-match-number">' +
						'<a href="/?p=upcoming&match=' + m.match_number + '">' + m.match_number + '</a></td>';
		}
		else
		{
			append += '<td class="schedule-mid schedule-match-number">' +
						'<a href="/?p=matchdata&match=' + m.match_number + '">' + m.match_number + '</a></td>';
		}
		
		append += pasteTeamInMatch(teamPageTeam, m.match_number, m.red_1, true);
		append += pasteTeamInMatch(teamPageTeam, m.match_number, m.red_2, true);
		append += pasteTeamInMatch(teamPageTeam, m.match_number, m.red_3, true);

		append += pasteTeamInMatch(teamPageTeam, m.match_number, m.blue_1, false);
		append += pasteTeamInMatch(teamPageTeam, m.match_number, m.blue_2, false);
		append += pasteTeamInMatch(teamPageTeam, m.match_number, m.blue_3, false);
		i ++;
		$('#matches.schedule').append(append);
	}

	$('.chart-link').attr('teamnumber', teamPageTeam)
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

function pasteTeamInMatch(teamPageTeam, match, team, red)
{
	var append = "";

	if(teamPageTeam == team)
	{
		append += '<td class="schedule-yellow">';
	}
	else if(red)
	{
		append += '<td class="schedule-red">';
	}
	else
	{
		append += '<td class="schedule-blue">';
	}
	if(getOfflineMatchData(m.match_number, team) != null)
	{
		append += '<a style="color:black;" href="/?p=teamdata&team=' + team
				+ '"><mark class="schedule-done-offline">' + team 
				+ '</mark></a>';
	}
	else if(getMatchData(m.match_number, team) != null)
	{
		append += '<a style="color:black;" href="/?p=teamdata&team=' + team 
				+ '"><mark class="schedule-done">' + team 
				+ '</mark></a>';
	}
	else
	{
		append += '<a style="color:black;" href="/?p=teamdata&team=' + team 
				+ '"><mark class="schedule-undone">' + team 
				+ '</mark></a>';
	}
	append += '</td>';
	return append;
}