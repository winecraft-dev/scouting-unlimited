var teamsListPage = "";

function loadTeamsListPage() 
{
	request = $.ajax({
			url: "/?c=teams&do=display",
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

function loadTeamsListPageOffline()
{
	teamsListPage = localStorage.getItem("teamsListPage");
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
	
	