//Javascript to display a predictive search field for the breweries in the database.
$(document).ready(function() {
	var breweryNames = [];
	var breweryIDs = [];

	$.getJSON("files/getBreweries.php", function(data) {
		var i;
		for(i = 0; i < data.length; i++) {
			breweryIDs[i] = data[i][0];
			breweryNames[i] = data[i][1];
		}	

		//listen for enter key and submit search if it is pressed
		$("#pred-search").keypress(function(event) {
			if(event.which == 13) {
				event.preventDefault();
				location.href = "beer.php?breweryName=" + $(".pred-search-input").val();
			}
		});

		//on keyup display possible matches
		$(".pred-search-input").on("keyup", function() {
			$(".results").empty();
			var input = $(".pred-search-input").val();
			var j = 0;
			var breweryList = new Array();
			var breweryListIDs = new Array();

			if(input.length > 0) {
				for(i = 0; i < breweryNames.length; i++) {
					if(breweryNames[i].substring(0, input.length).toLowerCase() == input.toLowerCase()) {
						breweryList[j] = breweryNames[i];
						breweryListIDs[j] = breweryIDs[i];
						j++;
					}
				}
			}

			if(breweryList.length > 0) {
				$(".results").show();
				$(".results").css("visibility", "visible");
				for(j = 0; j < breweryList.length; j++) {
					var name = breweryList[j].toLowerCase();
					var link = "<li class=\"brewery-item\"><a class=\"brew-search-item\" href=\"beer.php?brewery=" + 
											breweryListIDs[j] + "\">" + name + "</a></li>"; 
					$(".results").append(link);
				}
			}
			else {
				$(".results").hide();
			}
		});
	});
});