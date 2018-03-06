var initialAjaxCompleted = false;

$(document).ready(function() {
	loadOffline();
	storeSession();
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
		
		pastePage();
	}
}
