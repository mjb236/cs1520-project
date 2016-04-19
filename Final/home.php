<?php
	//Michael Bowen
	//CS1520 - Mon/Wed 4:30pm Recitation Tue 5:00pm
	//
	//Home page for the project site.

	//start session - used for verifying whether the user has verified age or not
	session_start();
	
	//declare an array with the links for the nav bar
	$navItems = ["Home" => "home.php", "Breweries & Beer" => "beer.php", "About" => "about.php",  
							"Contact" => "contact.php"];
	
	//keep track of the initial page visit and the active page name
	$_SESSION["initPage"] = "home.php";
	$active = "Home";

	if(!isset($_SESSION["ofAge"])) {
		//user has not verified age - redirect to the age verification
		header("Location: splash.php");
	}
	else {
		//user has verified age - display content			
		include("files/header.php");
		include("files/footer.php");
		include("files/navbar.php");
		display_navbar($navItems, $active);
		
		//page setup
		?>
		<div class="container">
			<div class="blog-header">
				<h1 class="blog-title">Blog</h1>
				<p class="lead blog-description">My adventures in the wonderful world of fermented drinks.</p>
			</div>
			
			<div class="row">
				<div class="col-sm-9 blog-main">
		<?php
		
		//open the file containing information to posted in the about page.
		$data = file("files/blog.txt");
		$length = count($data);
		$i = 0;
		while($i < $length) {
			$title = $data[$i];
			$date = $data[$i + 1];
			$author = $data[$i + 2];
			$img = $data[$i + 3];
			$imgAlt = $data[$i + 4];
			$text = $data[$i + 5];
			display_post($title, $date, $author, $img, $imgAlt, $text);
			$i = $i + 6;
		}
				
		//end the main blog section of the page.
		?>
				</div> <!-- ends blog-main section -->
		<?php
		
		//display the other sections of the document
		display_sidebar();
		display_footer();
		?>

		<!-- close body and html tags -->	
		</body>
		</html>

		<?php
	}
	
	//display a blog post
	function display_post($title, $date, $author, $img, $imgAlt, $text) {
		?>
		
		<div class="blog-post">
		<?php
			echo "<h2 class=\"blog-post-title\">$title</h2>\n";
			echo "<p class=\"blog-post-meta\">$date by <a href=\"about.php\">$author</a></p>\n";
			echo "<img class=\"blog-img\" src=\"$img\" alt=\"$imgAlt\">\n";
			echo "<p>$text</p>";
		?>
		</div> <!-- ends section -->
		
		<?php
	}

	//displays the sidebar
	function display_sidebar() {
		?>
				<div class="col-sm-2 col-sm-offset-1 blog-sidebar">
					<div class="sidebar-module sidebar-module-inset">
						<h4>About</h4>
						<p>Here you are able to read about some of the breweries I've visited, beers I've had, or even my attempts at brewing my own ales and lagers.</p>
					</div> <!-- ends sidebar module -->
					<div class="sidebar-module">
						<h4>Jump To</h4>
						<ol class="list-unstyled">
							<li><a href="#">Top</a></li>
						</ol>
					</div> <!-- ends sidebar module -->
					<div class="sidebar-module">
						<h4>Other Places</h4>
						<ol class="list-unstyled">
							<li><a href="https://www.facebook.com/mike.bowen.562">Facebook</a></li>
							<li><a href="https://twitter.com/bowmeta">Twitter</a></li>
						</ol>
					</div> <!-- ends sidebar module -->
				</div> <!-- ends the sidebar -->
			</div> <!-- ends the row division -->
		</div> <!-- ends the container division -->			
		<?php
	}
?>