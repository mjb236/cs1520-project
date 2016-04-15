<?php
	//Michael Bowen
	//CS1520 - Mon/Wed 4:30pm Recitation Tue 5:00pm
	//
	//Displays a splash page asking user to verify age
	//Also sets the $_SESSION["ofAge"] variable appropriately

	//start session - used for verifying whether the user has verified age or not
	session_start();
	
	//declare an array with the links for the nav bar
	$navItems = ["Home" => "home.php", "Breweries & Beer" => "beer.php", "About" => "about.php",  
							"Contact" => "contact.php"];
	
	if(isset($_POST["ofAge"])) {
		$_SESSION["ofAge"] = TRUE;
		if(isset($_SESSION["initPage"])) {
			header("Location: " . $_SESSION["initPage"]);
		}
		else {
			//on the off chance that splash is the first page visited, sent to home upon age verify
			header("Location: home.php");
		}		
	}
	else if(isset($_POST["notOfAge"])) {
		header("Location: http://www.disney.com");
		session_destroy();
		exit();
	}

	include("files/header.php");
?>

<!-- display the navigation bar for consistency -->
<!-- do so manually here since I want the bar displayed with no visible information -->
<body>
	<div class="blog-masthead">
		<div class="container">
			<nav class="blog-nav">
				<a class="blog-nav-item" id="splash_nav" href="#">Home</a>
			</nav>
		</div>
	</div>
	
	<!-- display the form for age verification -->
	<div class="container">
		<form id="splash_form" action="splash.php" method="POST">
			<div id="splash_lbl">
				<label id="splash_label">Are you at least 21 years of age?</label>
			</div>
			<div id="splash_btn">
				<input class="splash-button" type="submit" name="ofAge" value="Yes">
				<input class="splash-button" type="submit" name="notOfAge" value="No">
			</div>
		</form>
	</div>
</body>
</html>