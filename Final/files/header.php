<?php
	//Michael Bowen
	//CS1520 - Mon/Wed 4:30pm Recitation Tue 5:00pm
	//
	//Header file for project site
	//Sets up the html document for each of the site pages
	
	//start session - used for verifying whether the user has verified age or not
	session_start();
	
	//declare an array with the links for the nav bar
	$navItems = ["Home" => "home.php", "Breweries & Beer" => "beer.php", "About" => "about.php",  
							"Contact" => "contact.php"];
?>

<!DOCTYPE html>
<html lang="en">
	<!-- Most of the data in the head element comes from the Bootstrap 3 set up -->
	<!-- I've changed the title and icon, and added a level of CSS -->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Blog about beer, brewing, and myself.">
    <meta name="author" content="Michael Bowen">
    <link rel="icon" href="img/beer1.ico">

    <title>Bowen's Beer Guide</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog.css" rel="stylesheet">
		
		<!-- Custom styles for Mike Bowen's adjustments to the pages -->
		<link href="css/custom.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- <script src="js/ie-emulation-modes-warning.js"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>	