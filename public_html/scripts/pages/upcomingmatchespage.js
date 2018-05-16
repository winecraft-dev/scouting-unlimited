var upcomingMatchesPage = "";

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
		loadMatchData();
		loadTeams();
		loadSchedule();

		loadPage();
		loadErrorPage();
	}
	else
	{
		loadMatchDataOffline();
		loadTeams();
		loadSchedule();
		
		loadPageOffline();
		loadErrorPageOffline();
		
		completeAjax();
	}
}

function loadPage() 
{
	request = $.ajax({
			url: "/?p=schedule&do=displayUpcoming",
			type: "get"
	});
	request.done(function (response, textStatus, jqXHR) {
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?p=login");
		}
		else
		{
			upcomingMatchesPage = response;
			localStorage.setItem("upcomingMatchesPage", upcomingMatchesPage);
		}
	});
}

function loadPageOffline()
{
	upcomingMatchesPage = localStorage.getItem("upcomingMatchesPage");
}

async function pastePage()
{
	var url = new URL("http://localhost" + window.location.href);
	var matchnumber = url.searchParams.get("match");
	document.title = "Upcoming Match " + matchnumber + " - CRyptonite Robotics";
	$('.index-content').empty().append(upcomingMatchesPage);

	$('.page-section-head').text('Upcoming Match ' + matchnumber);
	var match = getMatch(matchnumber);

	$('#red1').text(match.red_1).attr('href', "/?p=teamdata&team=" + match.red_1);
	$('#red2').text(match.red_2).attr('href', "/?p=teamdata&team=" + match.red_2);
	$('#red3').text(match.red_3).attr('href', "/?p=teamdata&team=" + match.red_3);
	$('#blue1').text(match.blue_1).attr('href', "/?p=teamdata&team=" + match.blue_1);
	$('#blue2').text(match.blue_2).attr('href', "/?p=teamdata&team=" + match.blue_2);
	$('#blue3').text(match.blue_3).attr('href', "/?p=teamdata&team=" + match.blue_3);

	updateIframe('red1', match.red_1);
	updateIframe('red2', match.red_2);
	updateIframe('red3', match.red_3);
	updateIframe('blue1', match.blue_1);
	updateIframe('blue2', match.blue_2);
	updateIframe('blue3', match.blue_3);

	updateAverages('red1', getTeam(match.red_1));
	updateAverages('red2', getTeam(match.red_2));
	updateAverages('red3', getTeam(match.red_3));
	updateAverages('blue1', getTeam(match.blue_1));
	updateAverages('blue2', getTeam(match.blue_2));
	updateAverages('blue3', getTeam(match.blue_3));
}

function updateIframe(position, team)
{
	$('#' + position + '-image-iframe').attr('src', '/?p=teams&do=teamImage&team=' + team);
}

function updateAverages(position, team)
{
	for(var key in team.averages)
	{
		var average = team.averages[key];

		$('#' + position + '-' + key.replace(/ /g, "-")).text(average);
	}
}