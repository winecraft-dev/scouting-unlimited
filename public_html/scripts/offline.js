//database data
var schedule = [];
var teams = [];
var matchData = [];
var dataDefinitions = [];
var averageDefinitions = [];
var pitNotesDefinitions = [];
var scoutingPosition = 0;
var offlineData = [];
var offlinePitNotes = [];

var offline = false;

var scheduleLoading = false;
var teamsLoading = false;
var matchDataLoading = false;
var dataDefinitionsLoading = false;
var averageDefinitionsLoading = false;
var pitNotesDefinitionsLoading = false;
var scoutingPositionLoading = false;
var offlineDataLoading = false;
var offlinePitNotesLoading = false;

/*

Functions that get data, kinda like databasemodels, but only pulling from localStorage

*/

function isUpcoming(matchnumber)
{
	var match = getMatch(matchnumber);

	if(getMatchData(matchnumber, match.red_1) != null
		|| getMatchData(matchnumber, match.red_2) != null
		|| getMatchData(matchnumber, match.red_3) != null
		|| getMatchData(matchnumber, match.blue_1) != null
		|| getMatchData(matchnumber, match.blue_2) != null
		|| getMatchData(matchnumber, match.blue_3) != null)
	{
		return false;
	}
	return true;
}

function getMatchData(ma, t)
{
	for(match of matchData)
	{
		if(match.match_number == ma)
		{
			if(match.team_number == t)
			{
				return match;
			}
		}
	}
	return null;
}

function getMatchesByTeam(t)
{
	matches = [];
	for(match of schedule)
	{
		if(match.red_1 == t)
			matches.push(match);
		if(match.red_2 == t)
			matches.push(match);
		if(match.red_3 == t)
			matches.push(match);
		if(match.blue_1 == t)
			matches.push(match);
		if(match.blue_2 == t)
			matches.push(match);
		if(match.blue_3 == t)
			matches.push(match);
	}
	return matches;
}

function getMatch(matchnumber)
{
	for(match of schedule)
	{
		if(match.match_number == matchnumber)
			return match;
	}
}

function getTeam(t)
{
	for(te of teams)
	{
		if(te.number == t)
		{
			return te;
		}
	}
	return null;
}

function definitionDisplay(index, value)
{
	var definition = getDefinition(index);
	
	switch(definition['data_type'])
	{
		case '0':
			return value == 1 ? "True" : "False";
			break;
		case '1':
			switch(definition['module'])
			{
				case '4':
					return definition['dropdown_values'].split(",")[value - 1];
					break;
				default:
					return value;
					break;
			}
			break;
		case '2':
			return "\"" + value + "\"";
			break;
	}
}

function getDefinition(name)
{
	for(definition of dataDefinitions)
	{
		if(definition['title'] == name)
			return definition;
	}
	return null;
}

function getAverageDefinition(name)
{
	for(definition of averageDefinitions)
	{
		if(definition['title'] == name)
			return definition;
	}
	return null;
}

function getOfflinePitNotes(teamnumber)
{
	for(p of offlinePitNotes)
	{
		if(p['team_number'] == teamnumber)
		{
			return p;
		}
	}
	return null;
}

function getOfflineMatchData(m, t)
{
	for(match of offlineData)
	{
		if(match.match_number == m)
		{
			if(match.team_number == t)
			{
				return match;
			}
		}
	}
	return null;
}

/*

Basic Functions to call data from the database and store it in localStorage

*/

function loadSchedule()
{
	schedule = [];
	scheduleLoading = true;
	request = $.ajax({
		url: "/?p=offline&do=getSchedule",
		type: "get"
	}).done(function (response, textStatus, jqXHR) {
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?p=login");
		}
		else if(response == "NOT ENOUGH PERMISSIONS")
		{
			window.location.replace("/?p=login&do=logout");
		}
		else
		{
			var list = JSON.parse(response);
			list.forEach(function(item, index) {
				schedule.push(new Match(item['match_number'], item['time'], item['red_1'], item['red_2'], item['red_3'], item['blue_1'], item['blue_2'], item['blue_3']));
			});
			localStorage.setItem("schedule", response);
		}
	});
}

function loadScheduleOffline()
{
	schedule = [];
	scheduleLoading = true;
	response = localStorage.getItem("schedule");
	var list = JSON.parse(response);
	list.forEach(function(item, index) {
		schedule.push(new Match(item['match_number'], item['time'], item['red_1'], item['red_2'], item['red_3'], item['blue_1'], item['blue_2'], item['blue_3']));
	});
}

function loadTeams()
{
	teams = [];
	teamsLoading = true;
	request = $.ajax({
		url: "/?p=offline&do=getTeams",
		type: "get"
	}).done(function (response, textStatus, jqXHR) {
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?p=login");
		}
		else if(response == "NOT ENOUGH PERMISSIONS")
		{
			window.location.replace("/?p=login&do=logout");
		}
		else
		{
			var list = JSON.parse(response);
			list.forEach(function(item, index) {
				teams.push(new Team(item['number'], item['name'], item['pit_notes'], item['averages']));
			});
			localStorage.setItem("teams", response);
		}
	});
}

function loadTeamsOffline()
{
	teams = [];
	teamsLoading = true;
	response = localStorage.getItem("teams");
	var list = JSON.parse(response);
	list.forEach(function(item, index) {
		teams.push(new Team(item['number'], item['name'], item['pit_notes'], item['averages']));
	});
}

function loadMatchData()
{
	matchData = [];
	matchDataLoading = true;
	request = $.ajax({
		url: "/?p=offline&do=getMatchData",
	type: "get"
	}).done(function (response, textStatus, jqXHR) 
	{
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?p=login");
		}
		else if(response == "NOT ENOUGH PERMISSIONS")
		{
			window.location.replace("/?p=login&do=logout");
		}
		else
		{
			var list = JSON.parse(response);
			list.forEach(function(item, index) {
				matchData.push(new MatchData(item['match_number'], item['team_number'], item['scout'], item['dead'], item['dead_shortly'], item['data']));
			});
			localStorage.setItem("matchData", response);
		}
	});
}

function loadMatchDataOffline()
{
	matchData = [];
	matchDataLoading = true;
	response = localStorage.getItem("matchData");
	var list = JSON.parse(response);
	list.forEach(function(item, index) {
		matchData.push(new MatchData(item['match_number'], item['team_number'], item['scout'], item['dead'], item['dead_shortly'], item['data']));
	});
}

function loadDataDefinitions()
{
	dataDefinitions = [];
	dataDefinitionsLoading = true;
	request = $.ajax({
		url: "/?p=offline&do=getDataDefinitions",
		type: "get"
	}).done(function (response, textStatus, jqXHR) 
	{
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?p=login");
		}
		else if(response == "NOT ENOUGH PERMISSIONS")
		{
			window.location.replace("/?p=login&do=logout");
		}
		else
		{
			var list = JSON.parse(response);
			list.forEach(function(item, index) {
				dataDefinitions.push(item);
			});
			localStorage.setItem("dataDefinitions", response);
		}
	});
}

function loadDataDefinitionsOffline()
{
	dataDefinitions = [];
	dataDefinitionsLoading = true;
	response = localStorage.getItem("dataDefinitions");
	var list = JSON.parse(response);
	list.forEach(function(item, index) {
		dataDefinitions.push(item);
	});
}

function loadAverageDefinitions()
{
	averageDefinitions = [];
	averageDefinitionsLoading = true;
	request = $.ajax({
		url: "/?p=offline&do=getAverageDefinitions",
		type: "get"
	}).done(function (response, textStatus, jqXHR) 
	{
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?p=login");
		}
		else if(response == "NOT ENOUGH PERMISSIONS")
		{
			window.location.replace("/?p=login&do=logout");
		}
		else
		{
			var list = JSON.parse(response);
			list.forEach(function(item, index) {
				averageDefinitions.push(item);
			});
			localStorage.setItem("averageDefinitions", response);
		}
	});
}

function loadAverageDefinitionsOffline()
{
	averageDefinitions = [];
	averageDefinitionsLoading = true;
	response = localStorage.getItem("averageDefinitions");
	var list = JSON.parse(response);
	list.forEach(function(item, index) {
		averageDefinitions.push(item);
	});
}

function loadPitNotesDefinitions()
{
	pitNotesDefinitions = [];
	pitNotesDefinitionsLoading = true;
	request = $.ajax({
		url: "/?p=offline&do=getPitNotesDefinitions",
		type: "get"
	}).done(function (response, textStatus, jqXHR) 
	{
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?p=login");
		}
		else if(response == "NOT ENOUGH PERMISSIONS")
		{
			window.location.replace("/?p=login&do=logout");
		}
		else
		{
			var list = JSON.parse(response);
			list.forEach(function(item, index) {
				pitNotesDefinitions.push(item);
			});
			localStorage.setItem("pitNotesDefinitions", response);
		}
	});
}

function loadPitNotesDefinitionsOffline()
{
	pitNotesDefinitions = [];
	pitNotesDefinitionsLoading = true;
	response = localStorage.getItem("pitNotesDefinitions");
	var list = JSON.parse(response);
	list.forEach(function(item, index) {
		pitNotesDefinitions.push(item);
	});
}

function loadScoutingPosition()
{
	scoutingPosition = 0;
	scoutingPositionLoading = true;
	request = $.ajax({
		url: "/?p=adminpanel&do=getScoutingPosition",
		type: "get"
	}).done(function (response, textStatus, jqXHR) 
	{
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?p=login");
		}
		else
		{
			scoutingPosition = response;
			localStorage.setItem("scoutingPosition", response);
			console.log("Scouting Position: " + scoutingPosition);
		}
	});
}

function loadScoutingPositionOffline()
{	
	scoutingPosition = 0;
	scoutingPositionLoading = true;
	scoutingPosition = localStorage.getItem("scoutingPosition");
}

//offlineData

function loadOfflineMatchData()
{
	offlineData = [];
	offlineDataLoading = true;
	response = localStorage.getItem("offlineData");
	if(response == "null" || response == null)
		return;
	var list = JSON.parse(response);
	list.forEach(function(item, index) {
		offlineData.push(new MatchData(item['match_number'], item['team_number'], item['scout'], item['dead'], item['dead_shortly'], item['data']));
	});
}

function storeOfflineMatchData(data)
{
	data = JSON.parse(data);

	for(d of matchData)
	{
		if(d.match_number == data['match_number'] && d.team_number == data['team_number'])
			return "OVERRIDE?";		
	}
	for(d of offlineData)
	{
		if(d.match_number == data['match_number'] && d.team_number == data['team_number'])
			return "OVERRIDE?";		
	}

	offlineData.push(new MatchData(data['match_number'], data['team_number'], -1, data['dead'], data['dead_shortly'], data['data']));

	localStorage.setItem("offlineData", JSON.stringify(offlineData));
	return "SUCCESS";
}

function overrideOfflineMatchData(data)
{
	data = JSON.parse(data);

	for(index in offlineData)
	{
		d = offlineData[index];
		if(d.match_number == data['match_number'] && d.team_number == data['team_number'])
			offlineData.splice(index, 1);
	}

	offlineData.push(new MatchData(data['match_number'], data['team_number'], -1, data['dead'], data['dead_shortly'], data['data']));
	localStorage.setItem("offlineData", JSON.stringify(offlineData));
	return "SUCCESS";
}

function deleteOfflineMatchData(teamnumber, matchnumber)
{
	for(index in offlineData)
	{
		var md = offlineData[index];

		if(md.team_number == teamnumber && md.match_number == matchnumber)
		{
			offlineData.splice(index, 1);
		}
	}
	localStorage.setItem("offlineData", JSON.stringify(offlineData));
}

function loadOfflinePitNotes()
{
	offlinePitNotes = [];
	offlinePitNotesLoading = true;
	response = localStorage.getItem("offlinePitNotes");
	if(response == "null" || response == null)
		return;
	var list = JSON.parse(response);
	list.forEach(function(item, index) {
		offlinePitNotes.push(item);
	});
}

function storeOfflinePitNotes(values)
{
	team_number = values['team_number'];
	deleteOfflinePitNotes(team_number);
	data = JSON.parse(values['data']);

	offlinePitNotes.push(values);

	localStorage.setItem("offlinePitNotes", JSON.stringify(offlinePitNotes));
	return "SUCCESS";
}

function deleteOfflinePitNotes(teamnumber)
{
	for(index in offlinePitNotes)
	{
		var pn = offlinePitNotes[index];

		if(pn['team_number'] == teamnumber)
		{
			offlinePitNotes.splice(index, 1);
		}
	}
	localStorage.setItem("offlinePitNotes", JSON.stringify(offlinePitNotes));
}

function checkOffline()
{
	offline = !navigator.onLine;
	if(!offline)
	{
		if(offlineData.length > 0)
		{
			alert("You are now online. Your match data will be uploaded now.");

			for(index in offlineData)
			{
				var d = offlineData[index];

				var values = {
					'data': JSON.stringify({
						'team_number': d.team_number,
						'match_number': d.match_number,
						'dead': d.dead,
						'dead_shortly': d.dead_shortly,
						'data': d.data
					})
				};

				submitMatchData(values);
			}
		}
		if(offlinePitNotes.length > 0)
		{
			alert("You are now online. Your pit notes will be uploaded now.");

			for(index in offlinePitNotes)
			{
				var p = offlinePitNotes[index];
				submitPitNotes(p);
			}
		}
	}
}


function submitMatchData(values)
{
	var team_number = JSON.parse(values['data'])['team_number'];
	var match_number = JSON.parse(values['data'])['match_number'];

	request = $.ajax({
			url: "/?p=dataentry&do=enterData",
			type: "post",
			data: values
	}).done(function(response, textStatus, jqXHR) {
		console.log(response);
		if(response == "NOT LOGGED IN")
		{
			window.location.href = "/?p=login";
		}
		else if(response == "NOT ENOUGH PERMISSIONS")
		{
			location.reload();
		}
		else if(response == "NO DATA")
		{
			
		}
		else if(response == "MATCH HAS ALREADY BEEN SCOUTED")
		{
			if(confirm("Match " + match_number + ", Team " + team_number + " has already been scouted. Would you like to override it?"))
			{
				request = $.ajax({
						url: "/?p=dataentry&do=updateData",
						type: "post",
						data: values
				}).done(function(response, textStatus, jqXHR) {
					if(response == "SUCCESS")
					{
						deleteOfflineMatchData(team_number, match_number);
						alert("Match " + match_number + ", Team " + team_number + " successfully overridden");
						window.location.reload();
					}
				});
			}
		}
		else if(response == "SUCCESS")
		{
			deleteOfflineMatchData(team_number, match_number);
			alert("Match " + match_number + ", Team " + team_number + " successfully scouted");
			window.location.reload();
		}
	});
}

function submitPitNotes(values)
{
	request = $.ajax({
		url: "/?p=teams&do=enterPitNotes",
		type: "post",
		data: values
	}).done(function(response, textStatus, jqXHR) {
		console.log(response);
		if(response == "NOT LOGGED IN")
		{
			window.location.href = "/?p=login";
		}
		else if(response == "NOT ENOUGH PERMISSIONS")
		{
			window.location.href = "/?p=login&do=logout";
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