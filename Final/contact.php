<?php
	//Michael Bowen
	//CS1520 - Mon/Wed 4:30pm Recitation Tue 5:00pm
	//
	//Contact page for the project site.

	//start session - used for verifying whether the user has verified age or not
	session_start();
	
	//declare an array with the links for the nav bar
	$navItems = ["Home" => "home.php", "Homebrewing" => "homebrew.php", "Breweries & Beer" => "beer.php", 
								"About" => "about.php", "Contact" => "contact.php"];
	
	//keep track of the initial page visit and the active page name
	$_SESSION["initPage"] = "contact.php";
	$active = "Contact";

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
		
		if(isset($_POST["name"])) {
			//form has been submitted
			//connect and submit data to the database
			$server = "localhost";
			$user = "bowen";
			$pw = "bowen1234";
			$dbname = "project";
			$db = new mysqli($server, $user, $pw, $dbname);
			if($db->connect_error) {
				die("Database connection error: " . $db->connect_error);
			}
			
			//check return value and set return variable to an int appropriately
			if($_POST["return"] == "1") {
				$_POST["return"] = 1;
			}
			else {
				$_POST["return"] = 0;
			}
			
			//get variables from post to make writing query easier
			$name = mysql_real_escape_string($_POST["name"]);
			$email = mysql_real_escape_string($_POST["email"]);
			$ret = $_POST["return"];
			$msg = mysql_real_escape_string($_POST["message"]);
			
			//insert the information into the database
			$insert = "INSERT into contact (Name, EmailAddress, ReturnContact, Text)
								 VALUES ('$name', '$email', $ret, '$msg')";			
			if($db->query($insert) !== TRUE) {
				die("Database error: " . $db->error);
			}			
			$db->close();
			
			//thank the user for their input
			?>
			<div class="container">
				<div class="blog-header">
					<h1 class="blog-title">Thank you!</h1>
					<p class="lead blog-description">I appreciate you taking the time to contact me.</p>
				</div>
				<div class="row">
					<div class="col-sm-9 blog-main">
						<div class="contact-buffer">
							<!-- keeps the site look uniform -->
						</div>
					</div>
			<?php
		}
		else {
			//form has not been submitted.
			//display the Contact form
			?>
			<div class="container">
				<div class="blog-header">
					<h1 class="blog-title">Contact</h1>
					<p class="lead blog-description">You may use the below form to contact me.</p>
				</div>
			
				<div class="row">
					<div class="col-sm-9 blog-main">
						<div class="blog-post">
							<h2 class="blog-post-title">Leave me a message</h2>
							<?php display_form(); ?>
						</div> <!-- ends blog post div -->
					</div> <!-- ends blog-main -->			
			<?php
		}
		
		//display other sections of the document
		display_sidebar();
		display_footer();	
		?>

		<!-- close body and html tags -->	
		</body>
		</html>

		<?php	
	}
	
	//display the form
	function display_form() {
		?>
		<br />
		<form id="contact-form" action="contact.php" method="POST">
			<div class="form-row">
				<label for="name">Name:</label><br />
				<input id="name" class="input" name="name" type="text" size="50"><br />
			</div>
			<div class="form-row">
				<label for="email">Email:</label><br />
				<input id="email" class="input" name="email" type="text" size="50"><br />
			</div>
			<div class="form-row">
				<label for="message">Message:</label><br />
				<textarea id="message" class="input" name="message" type="text" rows="8" cols="50"></textarea><br />
			</div>
			<div class="form-row">
				<label for="return">May I contact you via email?</label><br />
					Yes <input class="rad_btn" type="radio" name="return" value="1" checked>
					No <input class="rad_btn" type="radio" name="return" value="0">
			</div>
			<div class="form-row">
					<input class="contact-button" type="submit" name="submit" value="Submit Message">
					<input class="contact-button" type="reset" name="clear" value="Clear">
			</div>				
		</form>		
		<?php		
	}

	//displays the sidebar
	function display_sidebar() {
		?>
				<div class="col-sm-2 col-sm-offset-1 blog-sidebar">
					<div class="sidebar-module sidebar-module-inset">
						<h4>About</h4>
						<p>This page will allow you to contact me if should wish to do so. The form will submit a message that I will be able to check. Below are some other ways to reach me.</p>
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