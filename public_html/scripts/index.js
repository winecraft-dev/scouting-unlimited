var initialAjaxCompleted = false;

$(document).ready(function() {
	localStorage.setItem("oldURLs", "");
	loadOffline();
	storeSession();
	history.pushState(null, document.title, location.href);
	window.addEventListener('popstate', function (event)
	{
		if(localStorage.getItem("oldURLs") != null 
			&& localStorage.getItem("oldURLs") != "" 
			&& localStorage.getItem("oldURLs") != "null")
		{	
			goBack();
		}
		else
		{

			window.history.back();
		}
	});
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
			document.title = "Data Entry - CRyptonite Robotics";
			pasteDataFormPage();
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
			pasteTeamsListPage();
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

function goBack()
{
	oldURLs = localStorage.getItem("oldURLs").split(",");
	console.log(oldURLs);

	setPage(oldURLs[oldURLs.length - 1]);
	oldURLs.splice(oldURLs.length - 1, 1);
	console.log(oldURLs);
	var newString = ""
	for(url of oldURLs)
	{
		newString += url + ",";
	}
	newString = newString.substr(0, newString.length - 1);
	localStorage.setItem("oldURLs", newString);
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
		offlinePitNotesLoading = false;
		
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
