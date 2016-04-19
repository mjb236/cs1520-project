<?php
	//Michael Bowen
	//CS1520 - Mon/Wed 4:30pm Recitation Tue 5:00pm
	//
	//Beer page for the project site.
	
	//start session - used for verifying whether the user has verified age or not
	session_start();
	
	//declare an array with the links for the nav bar
	$navItems = ["Home" => "home.php", "Breweries & Beer" => "beer.php", "About" => "about.php",  
							"Contact" => "contact.php"];
	
	//keep track of the initial page visit and the active page name
	$_SESSION["initPage"] = "beer.php";
	$active = "Breweries & Beer";

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
		
		//display the Breweries section of the document
		?>
			<div class="container">
				<div class="blog-header">
					<h1 class="blog-title">Breweries and Beer</h1>
					<p class="lead blog-description">Below you will find data on breweries that I have visited and beers from those breweries.</p>
				</div>
				
				<div class="row">
					<div class="col-sm-9 blog-main">
						<div class="blog-post">
							<h2 class="blog-post-title" id="brewery-info">Breweries</h2>
								<form	id="pred-search">
									<input class="pred-search-input" type="search" placeholder="Search for a brewery.">
										<ul class="results">
										</ul>
									<input class="pred-search-submit" type="submit" value="Search">
								</form>

		<?php
			if(isset($_GET["breweryName"])) {
				echo "<div class=\"brewery\" id=\"brewery0\">";
				echo "<h3>" . $_GET["breweryName"] . "</h3>";
				echo "<h5>Brewery does not exist in database.</h5>";
				echo "</div>";
				?>

						</div> <!-- ends the Breweries section -->
					</div> <!-- ends the blog-main section -->

				<?php
					
					//display the other sections of the document
					display_sidebar();		
					display_footer();
				?>
					<script src="js/brewerySearch.js"></script>

					<!-- close body and html tags -->	
					</body>
					</html>

				<?php
			}
			else if(isset($_GET["brewery"])) {
				//connect to the database for querying information
				$server = "localhost";
				$user = "bowen";
				$pw = "bowen1234";
				$dbname = "testing";
				$db = new mysqli($server, $user, $pw, $dbname);
				if($db->connect_error) {
					die("Database connection error: " . $db->connect_error);
				}		

				//query the db for the submitted brewery
				$select = "SELECT Name, Address1 as Address, City, State, Zip, Phone, Established as Est, Website, ID
									FROM Breweries
									WHERE ID = " . $_GET["brewery"];
				$result = $db->query($select);
				$rows = $result->num_rows;
				if($rows > 0) {
					//database returned results as expected.
					//print brewery data
					$currRow = 1;
					while($row = mysqli_fetch_row($result)) {
						echo "<br />";
						echo "<div class=\"brewery\">";
						echo "<h3>$row[0]</h3>";
						echo "<h5 id=\"street-address\">$row[1]</h5>";
						echo "<h5 id=\"city-address\">$row[2], $row[3] $row[4]</h5>";
						echo "<h5>$row[5]</h5>";
						echo "<h5>Esablished $row[6]</h5>";
						echo "<h5><a href=\"$row[7]\">Website</a></h5>";
						echo "</div>";
						$currRow++;
					}
				}
				else {
					echo "No data found.";
				}

				$db->close();
				?>

						</div> <!-- ends the Breweries section -->
					</div> <!-- ends the blog-main section -->

				<?php
				
				//display the other sections of the document
				display_sidebar();		
				display_footer();
				?>
				<script src="js/brewerySearch.js"></script>
				<script src="js/displayMap.js"></script>
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZddoPigsu_fWOhyClNHEzhVNdEwZnHQg&callback=initMap" async defer></script>

				<!-- close body and html tags -->	
				</body>
				</html>

				<?php
			}
			else {
				?>

						</div> <!-- ends the Breweries section -->
					</div> <!-- ends the blog-main section -->

				<?php
				
				//display the other sections of the document
				display_sidebar();		
				display_footer();
				?>
				<script src="js/brewerySearch.js"></script>

				<!-- close body and html tags -->	
				</body>
				</html>

				<?php
			}
	}

	function display_sidebar() {
		?>
				<div class="col-sm-2 col-sm-offset-1 blog-sidebar">
					<div class="sidebar-module sidebar-module-inset">
						<h4>About</h4>
						<p>This page contains data on breweries that I have visited or wish to visit. Also, below the brewery information are selected beers produced by those breweries.</p>
					</div>
					<div class="sidebar-module">
						<h4>Jump To</h4>
						<ol class="list-unstyled">
							<li><a href="#brewery-info">Breweries</a></li>
							<li><a href="#beers-info">Beers</a></li>
							<li><a href="#">Top</a></li>
						</ol>
					</div>
					<div class="sidebar-module">
						<h4>Resources</h4>
						<ol class="list-unstyled">
							<li><a href="http://www.beeradvocate.com/">Beer Advocate</a></li>
							<li><a href="http://www.pittsburghcraftbeerweek.com/">PCBW</a></li>
							<li><a href="http://www.homebrewtalk.com/">Home Brew Talk</a></li>
							<li><a href="http://www.howtobrew.com/">How To Brew</a></li>
						</ol>
					</div>
				</div> <!-- ends the sidebar -->
			</div> <!-- ends the row division -->
		</div> <!-- ends the container division -->			
		<?php
	}
?>