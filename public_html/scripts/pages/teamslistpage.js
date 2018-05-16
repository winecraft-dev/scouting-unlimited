var teamsListPage = "";

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
		loadTeams();
		loadSchedule();

		loadPage();
		loadErrorPage();
	}
	else
	{
		loadTeamsOffline();
		loadScheduleOffline();

		loadPageOffline();
		loadErrorPageOffline();
		
		completeAjax();
	}
}

function loadPage() 
{
	request = $.ajax({
			url: "/?p=teams&do=display",
			type: "get"
	});
	request.done(function (response, textStatus, jqXHR) {
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?p=login");
		}
		else
		{
			teamsListPage = response;
			localStorage.setItem("teamsListPage", teamsListPage);
		}
	});
}

function loadPageOffline()
{
	teamsListPage = localStorage.getItem("teamsListPage");
}

async function pastePage()
{
	$('.index-content').empty().append(teamsListPage);

	for(team of teams)
	{
		var allnull = true;
		for(index in team.pit_notes)
		{
			if(team.pit_notes[index] != null)
			{
				allnull = false;
			}
		}
		if(!allnull)
		{
			$('#' + team.number).removeClass('schedule-undone').addClass('schedule-done');
		}
	}

	for(pitNote of offlinePitNotes)
	{
		console.log(pitNote);
		teamnumber = pitNote['team_number'];
		data = JSON.parse(pitNote['data']);

		var allnull = true;
		for(index in data)
		{
			if(data[index] != null)
			{
				allnull = false;
			}
		}
		if(!allnull)
		{
			$('#' + teamnumber).removeClass('schedule-undone').addClass('schedule-done-offline');
		}
	}
}


//Sorting variation for Integers
function sortTableInt(n) {
	
	var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
	table = document.getElementById("teamtable");
	switching = true;
	dir = "asc"; 
	
	while (switching) {
		switching = false;
		rows = table.getElementsByTagName("TR");
	
		for (i = 1; i < (rows.length - 1); i++) {
		shouldSwitch = false;
		x = rows[i].getElementsByTagName("TD")[n];
		y = rows[i + 1].getElementsByTagName("TD")[n];

			if (dir == "asc") {
				if (parseFloat(x.innerHTML) > parseFloat(y.innerHTML)) {	
			shouldSwitch= true;
			break;			
				}
			} 
		
		else if (dir == "desc") {
				if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
			shouldSwitch= true;
			break;
		}
	}
}
		
	if (shouldSwitch) {
		rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		switching = true;
		switchcount ++;			
	} 
	
	else { 
			if (switchcount == 0 && dir == "asc") {			
		dir = "desc";
				switching = true;
		}
		}
	}
	
		for (i=1;i<(rows.length);i++){
		if (i % 2 == 1){
			$(rows[i]).css("background-color","rgba(10, 10, 10, .4)");
		}
	
	else{
			$(rows[i]).css("background-color","rgba(100, 100, 100, .4)");
	}
	}
}

//String variation for sorting
function sortTableString(n) {
	
	var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
	table = document.getElementById("teamtable");
	switching = true;
	dir = "asc"; 
	
	while (switching) {
		switching = false;
		rows = table.getElementsByTagName("TR");
	
		for (i = 1; i < (rows.length - 1); i++) {
		shouldSwitch = false;
		x = rows[i].getElementsByTagName("TD")[n];
		y = rows[i + 1].getElementsByTagName("TD")[n];

			if (dir == "asc") {
				if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {	
			shouldSwitch= true;
			break;			
				}
			} 
		
		else if (dir == "desc") {
				if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			shouldSwitch= true;
			break;
		}
			}
		}
		
	if (shouldSwitch) {
		rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		switching = true;
		switchcount ++;			
	} 
	
	else { 
			if (switchcount == 0 && dir == "asc") {			
		dir = "desc";
				switching = true;
		}
		}
	}
	
		for (i=1;i<(rows.length);i++){
		if (i % 2 == 1){
			$(rows[i]).css("background-color","rgba(10, 10, 10, .4)");
		}
	
	else{
			$(rows[i]).css("background-color","rgba(100, 100, 100, .4)");
	}
	}
}
	
	