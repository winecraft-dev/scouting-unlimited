var chartView = "";

function loadPopup() 
{
	request = $.ajax({
			url: "/?p=teams&do=displayChart",
			type: "get"
	});
	request.done(function(response, textStatus, jqXHR) {
		if(response == "NOT LOGGED IN")
		{
			window.location.replace("/?p=login");
		}
		else
		{
			chartView = response;
			localStorage.setItem("chartView", chartView);
		}
	});
}

function loadPopupOffline()
{
	chartView = localStorage.getItem("chartView");
}

$(document).on('click', 'a.chart-link', function(e) {	
	e.preventDefault();

	var teamNumber = $(this).attr("teamnumber");
	var field = ($(this).attr('id')).replace(new RegExp("-", 'g'), " ");

	$('.index-content').append(chartView);
	$('#pop-up.page-section-head').text(teamNumber + " - " + field);

	pasteChart(teamNumber, getAverageDefinition(field));
});

$(document).keyup(function(e) {
	if (e.keyCode == 27) 
	{
		$('.popup-section').remove();
	}
});

$(document).on('click', '.popup-section-exit', function() {
	$('.popup-section').remove();
});

function pasteChart(team, definition)
{
	matches = getMatchesByTeam(team);

	var matchLabels = [];
	var data = [];
	var yLabels = {};

	var useYLabels = true;

	switch(definition['method'])
	{
		case 'max':
		case 'percentaverage':
		case 'average':
			useYLabels = false;

			for(match of matches)
			{
				matchLabels.push("Match " + match.match_number);

				d = getMatchData(match.match_number, team);
				
				if(d != null)
				{
					data.push(d.data[definition['column_1']]);
				}
				else
				{
					data.push(0);
				}
			}
			break;
		case 'dropdownvaluepercent':
			yLabels = getDefinition(definition['column_1'])['dropdown_values'].split(",");
			for(match of matches)
			{
				matchLabels.push("Match " + match.match_number);

				d = getMatchData(match.match_number, team);
				
				if(d != null)
				{
					data.push(d.data[definition['column_1']] - 1);
				}
				else
				{
					data.push(0);
				}
			}
			break;
		case 'successoverattempt':
			yLabels = {
				'-1': 'Did Not Attempt',
				'0': 'Attempted'
			};
			for(match of matches)
			{
				matchLabels.push("Match " + match.match_number);

				d = getMatchData(match.match_number, team);
				
				if(d != null)
				{
					if(d.data[definition['column_2']] == 1 || d.data[definition['column_1']] > 0)
					{
						data.push(d.data[definition['column_1']]);
					}
					else
					{
						data.push(-1);
					}
				}
				else
				{
					data.push(-1);
				}
			}
			break;
	}
	var ctx = document.getElementById("statsChart");
	var statsChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: matchLabels,
			datasets: [{
				label: definition['column_1'],
				data: data,
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)'
				],
				borderColor: [
					'rgba(255,99,132,1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true,
						callback: function(value, index, values) {
							if(!useYLabels)
								return value;
							else
							{
								if(value in yLabels)
								{
									return yLabels[value];
								}
								else
								{
									return value;
								}
							}
						}
					}
				}]
			},
			zoom: { enabled: false },
			pan: { enabled: true }
		}
	});
}