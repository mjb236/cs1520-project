$(document).ready(function() {
	var xml = new XMLHttpRequest();
	xml.onreadystatechange = function() {
		if(xml.readyState == 4 && xml.status == 200) {
			var posts = JSON.parse(xml.responseText);
			assignHandlers(posts);
		}
	};

	xml.open("GET", "files/posts.txt", true);
	xml.send();

	function assignHandlers(posts) {
		var index = 0;
		var maxIndex = posts.length - 1;

		//set the post to index 0 by default
		updatePost(posts, index);

		$("#oldBtn").on("click", function(e) {
			e.preventDefault();
			index++;

			//update button displays if necessary
			if(index > 0) {
				$("#newBtn").attr("disabled", false);
			}
			if(index >= maxIndex) {
				$("#oldBtn").attr("disabled", true);
			}

			updatePost(posts, index);

			//found this little code snippet on StackOverflow - will scroll the page to top of the blog post
			//http://stackoverflow.com/questions/6677035/jquery-scroll-to-element - top answer from user CZX
			$('html, body').animate({
				scrollTop: $("#blog_section").offset().top
			}, 1000);
		});

		$("#newBtn").on("click", function(e) {
			e.preventDefault();
			index--;

			//update button displays if necessary
			if(index < maxIndex) {
				$("#oldBtn").attr("disabled", false);
			}
			if(index <= 0) {
				$("#newBtn").attr("disabled", true);
			}

			updatePost(posts, index); 

			//found this little code snippet on StackOverflow - will scroll the page to top of the blog post
			//http://stackoverflow.com/questions/6677035/jquery-scroll-to-element - top answer from user CZX
			$('html, body').animate({
				scrollTop: $("#blog_section").offset().top
			}, 1000);
		});
	}

	//display the post information at the given index
	function updatePost(posts, index) {
		var contents = "";

		contents += "<h2 class=\"blog-post-title\">" + posts[index].heading + "</h2>";
		contents += "<p class=\"blog-post-meta\">" + posts[index].date + " by <a href=\"about.php\">" + posts[index].author + "</a></p>";
		contents += "<img class=\"blog-img\" src=\"" + posts[index].image + "\" alt=\"" + posts[index].alt + "\">";
		contents += "<p>" + posts[index].text + "</p>";

		$("#blog_section").html(contents);
	}
});