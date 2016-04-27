$(document).ready(function() {
	var xml = new XMLHttpRequest();
	xml.onreadystatechange = function() {
		if(xml.readyState == 4 && xml.status == 200) {
			var sections = JSON.parse(xml.responseText);
			assignHandlers(sections);
		}
	};

	xml.open("GET", "files/homebrew.txt", true);
	xml.send();

	function assignHandlers(sections) {
		var index = 0;
		var maxIndex = sections.length - 1;

		//set the section to index 0 by default
		updateSection(sections, index);

		$("#next").on("click", function(e) {
			e.preventDefault();
			index++;
			if(index > 0) {
				$("#prev").attr("disabled", false);
			}
			if(index >= maxIndex) {
				$("#next").attr("disabled", true);
			}

			updateSection(sections, index);
		});

		$("#prev").on("click", function(e) {
			e.preventDefault();
			index--;
			if(index < maxIndex) {
				$("#next").attr("disabled", false);
			}
			if(index <= 0) {
				$("#prev").attr("disabled", true);
			}

			updateSection(sections, index); 
		});
	}

	function updateSection(sections, index) {
		var contents = "";

		//$("#home_brew_section").empty();

		contents += "<h2 class=\"blog-post-title\">" + sections[index].heading + "</h2>";
		contents += "<img class=\"brew-img\" src=\"" + sections[index].image + "\">";
		contents += "<p>" + sections[index].text + "</p>";

		$("#home_brew_section").html(contents);
	}
});