var editDefinitionsPage = "";

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
		loadPage();
		loadErrorPage();
	}
	else
	{
		loadPageOffline();
		loadErrorPageOffline();
		
		completeAjax();
	}
}

function loadPage() 
{
	pageLoading = true;
	request = $.ajax({
			url: "/?p=edit&do=display",
			type: "get"
	}).done(function (response, textStatus, jqXHR) {
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?p=login");
		}
		else
		{
			editDefinitionsPage = response;
			localStorage.setItem("editDefinitionsPage", editDefinitionsPage);
		}
	});
}

function loadPageOffline()
{
	editDefinitionsPage = localStorage.getItem("editDefinitionsPage");
}

async function pastePage()
{
	if(!offline)
	{
		pageLoading = false;
		$('.index-content').empty();
		$('.index-content').append(editDefinitionsPage);
		$('.adminpanel-load-message').fadeOut();
	}
	else
	{
		pasteErrorPage("You cannot use the Admin Panel while offline.");
	}
}