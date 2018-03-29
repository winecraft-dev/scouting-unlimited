var initialAjaxCompleted = false;

$(document).ready(function() {
	loadOffline();
	storeSession();

	setInterval(function() {
		if(!offline)
			loadScoutingPosition();
	}, 20000);
});

$(document).ajaxStop(completeAjax);

function completeAjax()
{
	if(!initialAjaxCompleted) 
	{
		scheduleLoading = false;
		teamsLoading = false;
		matchDataLoading = false;
		dataDefinitionsLoading = false;
		pitNotesDefinitionsLoading = false;
		scoutingPositionLoading = false;
		offlineDataLoading = false;
		offlinePitNotesLoading = false;
		
		initialAjaxCompleted = true;
		
		pastePage();
	}
}
