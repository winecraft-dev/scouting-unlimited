var initialAjaxCompleted = false;

$(document).ready(function() {
	localStorage.setItem("oldURLs", "");
	loadOffline();
	storeSession();
	window.onbeforeunload = function(event) {
	  alert("location: " + document.location + ", state: " + JSON.stringify(event.state));
	};
});

$(document).ajaxStop(completeAjax);

$(document).on('click', 'a', function(e) {
	e.preventDefault();
	var link = "http://localhost" + $(this).attr('href')
	var url = new URL(link);
	
	if(typeof(url.searchParams.get("c")) != "undefined" && url.searchParams.get("c") != null)
	{
		window.location.href = $(this).attr("href");
		return;
	}
	setPage(link);
});

function setPage(link)
{
	storeURLs(link);

	var url = new URL(link);

	$('.index-content').empty();
	switch(url.searchParams.get("p"))
	{
		case 'adminpanel':
			document.title = "Admin Panel - CRyptonite Robotics";
			pasteAdminPanelPage();
			break;
		case 'datapanel':
			document.title = "Data Panel - CRyptonite Robotics";
			//data entry panel
			break;
		case 'schedule':
			document.title = "Schedule - CRyptonite Robotics";
			pasteSchedulePage();
			break;
		case 'dataentry':
			document.title = "Data Form - CRyptonite Robotics";
			pasteDataFormPage();
			break;
		case 'teams':
			document.title = "Teams - CRyptonite Robotics";
			$('.index-content').append(teamsListPage);
			break;
		case 'rankings':
			document.title = "Rankings - CRyptonite Robotics";
			//
			break;
		case 'teamdata':
			pasteTeamPage(url.searchParams.get("team"));
			break;
		case 'matchdata':
			pasteMatchDataPage(url.searchParams.get("match"));
			break;
	}
}

function storeURLs(link)
{
	if(localStorage.getItem("oldURLs") != null 
			&& localStorage.getItem("oldURLs") != "" 
			&& localStorage.getItem("oldURLs") != "null")
	{
		oldURLs = localStorage.getItem("oldURLs").split(",");
		if(oldURLs[oldURLs.length - 1] != localStorage.getItem("url"))
			localStorage.setItem("oldURLs", oldURLs + "," + localStorage.getItem("url"));
	}
	else
	{
		localStorage.setItem("oldURLs", localStorage.getItem("url"));
	}
	localStorage.setItem("url", link);
}

function goBack(e)
{
	e.preventDefault();
	alert("test");
}

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
		
		if(offline)
		{
			console.log("Data & Pages loaded locally.");
		}
		else
		{
			console.log("Data & Pages updated from Database.");
		}
		initialAjaxCompleted = true;
		setPage(localStorage.getItem("url"));
	}
}
