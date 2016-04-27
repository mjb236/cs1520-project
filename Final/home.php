<?php
	//Michael Bowen
	//CS1520 - Mon/Wed 4:30pm Recitation Tue 5:00pm
	//
	//Home page for the project site.

	//start session - used for verifying whether the user has verified age or not
	session_start();
	
	//declare an array with the links for the nav bar
	$navItems = ["Home" => "home.php", "Homebrewing" => "homebrew.php", "Breweries" => "beer.php", 
								"About" => "about.php", "Contact" => "contact.php"];
	
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
					<div id="blog_section">
					</div>
					<form id="blog_form">
						<div class="form-row">
								<input class="contact-button" id="newBtn" type="submit" name="newer" value="Newer Post" disabled>
								<input class="contact-button" id="oldBtn" type="submit" name="older" value="Older Post">
						</div>				
					</form>	
				</div> <!-- ends blog-main section -->
		<?php
		
		//display the other sections of the document
		display_sidebar();
		display_footer();
		?>

		<script src="js/displayPosts.js"></script>
		<!-- close body and html tags -->	
		</body>
		</html>

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