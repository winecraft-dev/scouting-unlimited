var upcomingMatchesPage = "";

$(document).ready(function() {
	var open = false;
	$('.menu-dropdown').hide();
	$('.menu-bar-icon').click(function() {
		if(open)
		{
			open = false;
			$('.menu-dropdown').hide();
		}
		else
		{
			open = true;
			$('.menu-dropdown').show();
		}
	});
	$('.page').click(function() {
	  if(open)
		{
			open = false;
			$('.menu-dropdown').hide();
		}
	});
});
