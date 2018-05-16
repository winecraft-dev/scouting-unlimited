var adminPanelPage = "";

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
			url: "/?p=adminpanel&do=display",
			type: "get"
	}).done(function (response, textStatus, jqXHR) {
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?p=login");
		}
		else
		{
			adminPanelPage = response;
			localStorage.setItem("adminPanelPage", adminPanelPage);
		}
	});
}

function loadPageOffline()
{
	adminPanelPage = localStorage.getItem("adminPanelPage");
}

async function pastePage()
{
	if(!offline)
	{
		pageLoading = false;
		$('.index-content').empty();
		$('.index-content').append(adminPanelPage);
		$('.adminpanel-load-message').fadeOut();
		selectScoutColor();
	}
	else
	{
		pasteErrorPage("You cannot use the Admin Panel while offline.");
	}
}

$(document).on('change', '.adminpanel-scouting-position', function() {
	var val = $(this).val();
	var id = $(this).attr('id');
	
	var values = {
		'id': id,
		'val': val
	};
	request = $.ajax({
			url: "/?p=adminpanel&do=editScoutingPosition",
			type: "post",
			data: values
	});
	request.done(function (response, textStatus, jqXHR) {
		if(response == "SUCCESS")
		{
			window.location.reload();
		}
		else if(response == "NOT ENOUGH PERMISSIONS")
		{
			window.location.href = "/";
		}
		else if(response == "NOT LOGGED IN")
		{
			window.location.href = "/?p=login";
		}
	});
});

$(document).on('change', '.adminpanel-administrator', function() {
	var val = $(this).val();
	var id = $(this).attr('id');
	
	var values = {
		'id': id,
		'val': val
	};
	request = $.ajax({
			url: "/?p=adminpanel&do=editAdministrator",
			type: "post",
			data: values
	});
	request.done(function (response, textStatus, jqXHR) {
		if(response == "SUCCESS")
		{
			if(val == -1)
			{
				$('#' + id + '.adminpanel-keep').replaceWith("<td class='adminpanel-trash' id=" + id + "></td>");
			}
			else
			{
				$('#' + id + '.adminpanel-trash').replaceWith("<td class='adminpanel-keep' id=" + id + "></td>");
			}
			window.location.reload();
		}
		else if(response == "NOT ENOUGH PERMISSIONS")
		{
			window.location.href = "/";
		}
		else if(response == "NOT LOGGED IN")
		{
			window.location.href = "/?p=login";
		}
	});
});

$(document).on('click', '.adminpanel-trash', function() {
	var id = $(this).attr('id');
	
	var values = {
		'id': id
	};
	request = $.ajax({
			url: "/?p=adminpanel&do=removeUser",
			type: "post",
			data: values
	});
	request.done(function (response, textStatus, jqXHR) {
		if(response == "SUCCESS")
		{
			$('#' + id + '.adminpanel-user').remove();
			window.location.reload();
		}
		else if(response == "NOT ENOUGH PERMISSIONS")
		{
			window.location.href = "/";
		}
		else if(response == "NOT LOGGED IN")
		{
			window.location.href = "/?p=login";
		}
	});
});

function selectScoutColor()
{
	$('.adminpanel-scouting-position').each(function() {
		var val = $(this).val();
		
		if(val == 0)
		{
			$(this).css('background', '#555555');
		}
		else if(val > 3)
		{
			$(this).css('background', 'rgba(0, 0, 255, .6)');
		}
		else
		{
			$(this).css('background', 'rgba(255, 0, 0, .6)');
		}
	});
}

$(document).on('click', '.adminpanel-button', function() {
	var id = $(this).attr('id');
	
	var values = {
		'eventcode': $('#eventcode-' + id).val(),
		'password': $('#password-' + id).val()
	};
	var url = "/?p=adminpanel&do=" + (id == 1 ? "loadTeams" : "loadSchedule");
	
	request = $.ajax({
			url: url,
			type: "post",
			data: values
	});
	request.done(function(response, textStatus, jqXHR) {
		if(response == "SUCCESS")
		{
			$('.adminpanel-load-message').fadeIn();
			$('.adminpanel-load-message').css('color', 'green');
			$('.adminpanel-load-message').text("Successfully Loaded");
		}
		else if(response == "INCORRECT PASSWORD")
		{
			$('.adminpanel-load-message').fadeIn();
			$('.adminpanel-load-message').css('color', 'red');
			$('.adminpanel-load-message').text("Incorrect Password");
		}
		else if(response == "NO ID")
		{
			$('.adminpanel-load-message').fadeIn();
			$('.adminpanel-load-message').css('color', 'red');
			$('.adminpanel-load-message').text("You must fill out all fields");
		}
		else if(response == "NOT ENOUGH PERMISSIONS")
		{
			window.location.href = "/";
		}
		else if(response == "NOT LOGGED IN")
		{
			window.location.href = "/?p=login";
		}
	});
});
