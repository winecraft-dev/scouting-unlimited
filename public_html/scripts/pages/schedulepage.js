var schedulePage = "";

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
		loadSchedule();

		loadPage();
		loadErrorPage();
	}
	else
	{
		loadMatchDataOffline();
		loadScheduleOffline();

		loadPageOffline();
		loadErrorPageOffline();
		
		completeAjax();
	}
}

function loadPage() 
{
	request = $.ajax({
			url: "/?p=schedule&do=display",
			type: "get"
	});
	request.done(function (response, textStatus, jqXHR) {
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?p=login");
		}
		else
		{
			schedulePage = response;
			localStorage.setItem("schedulePage", schedulePage);
		}
	});
}

function loadPageOffline()
{
	schedulePage = localStorage.getItem("schedulePage");
}

function pastePage()
{
	$('.index-content').empty().append(schedulePage);
	for(d of matchData)
	{
		$('#' + d.match_number + '-' + d.team_number).removeClass('schedule-undone').addClass('schedule-done');
	}
	for(d of offlineData)
	{
		$('#' + d.match_number + '-' + d.team_number).removeClass('schedule-undone').addClass('schedule-done-offline');
	}

	for(match of schedule)
	{
		if(!isUpcoming(match.match_number))
		{
			$('#' + match.match_number).attr('href', '/?=matchdata&match=' + match.match_number);
		}
	}
}