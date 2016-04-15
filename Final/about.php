<?php
	//Michael Bowen
	//CS1520 - Mon/Wed 4:30pm Recitation Tue 5:00pm
	//
	//About page for the project site.
	
	//start session - used for verifying whether the user has verified age or not
	session_start();
	
	//declare an array with the links for the nav bar
	$navItems = ["Home" => "home.php", "Breweries & Beer" => "beer.php", "About" => "about.php",  
							"Contact" => "contact.php"];
	
	//keep track of the initial page visit and the active page name
	$_SESSION["initPage"] = "about.php";
	$active = "About";

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
				<h1 class="blog-title">About</h1>
				<p class="lead blog-description">Learn about me! I dare you!</p>
			</div>
			
			<div class="row">
				<div class="col-sm-9 blog-main">
					<div class="blog-post">
						<img src="img/mike.jpg" alt="A picture of Mike.">
					</div>
		<?php
		
		//open the file containing information to posted in the about page.
		$data = file("files/about.txt");
		$length = count($data);
		$ids = array();
		$sects = array();
		for($i = 0; $i < $length; $i++) {
			//push the header for each section to an array for the sidebar
			array_push($sects, $data[$i]);
			$sectId = str_replace(' ', '', $data[$i]);
			array_push($ids, $sectId);
			display_post($sectId, $data[$i + 1]);
			$i++;
		}			
		
		//end the main blog section of the page.
		?>
				</div> <!-- ends blog section -->
		<?php
		
		display_sidebar($ids, $sects);
		display_footer();
	}
	
	//display a section of the about using the blog post setup
	function display_post($title, $info) {
		?>
		
		<div class="blog-post">
		<?php
			echo "<h2 class=\"blog-post-title\" id=$title>$title</h2>\n";
			echo "<p>$info</p>";
		?>
		</div> <!-- ends section -->
		
		<?php
	}
	
	//displays the sidebar
	function display_sidebar($ids, $sects) {
		?>
				<div class="col-sm-2 col-sm-offset-1 blog-sidebar">
					<div class="sidebar-module sidebar-module-inset">
						<h4>About</h4>
						<p>This page is all about me! There is some background info on my work and education, as well as hobbies and interests. Please contact me with any questions.</p>
					</div>
					<div class="sidebar-module">
						<h4>Jump To</h4>
						<ol class="list-unstyled">
						<?php
							$numSect = count($ids);
							for($i = 0; $i < $numSect; $i++) {
								echo "<li><a href=\"#$ids[$i]\">$sects[$i]</a></li>\n";
							}
						?>
							<li><a href="#">Top</a></li>
						</ol>
					</div>
					<div class="sidebar-module">
						<h4>Other Places</h4>
						<ol class="list-unstyled">
							<li><a href="https://www.facebook.com/mike.bowen.562">Facebook</a></li>
							<li><a href="https://twitter.com/bowmeta">Twitter</a></li>
						</ol>
					</div>
				</div> <!-- ends the sidebar -->
			</div> <!-- ends the row division -->
		</div> <!-- ends the container division -->				
		<?php
	}
?>