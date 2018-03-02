var schedulePage = "";

function loadSchedulePage() 
{
	request = $.ajax({
			url: "/?c=schedule&do=display",
			type: "get"
	});
	request.done(function (response, textStatus, jqXHR) {
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?c=login");
		}
		else
		{
			schedulePage = response;
			localStorage.setItem("schedulePage", schedulePage);
		}
	});
}

function loadSchedulePageOffline()
{
	schedulePage = localStorage.getItem("schedulePage");
}

function pasteSchedulePage()
{
	if(!offline)
	{
		loadMatchData();
		
		$(document).ajaxStop(function() {
			if(matchDataLoading)
			{
				matchDataLoading = false;
				$('.index-content').empty().append(schedulePage);
				for(d of matchData)
				{
					$('#' + d.match_number + '-' + d.team_number).removeClass('schedule-undone').addClass('schedule-done');
				}
				for(d of offlineData)
				{
					$('#' + d.match_number + '-' + d.team_number).removeClass('schedule-undone').addClass('schedule-done-offline');
				}
			}
		});
	}
	else
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
	}
}