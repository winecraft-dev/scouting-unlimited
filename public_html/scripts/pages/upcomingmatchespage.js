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

function pastePage()
{
	$('.index-content').empty().append(upcomingMatchesPage);
}