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
		<?php
		
		//connect to the database for querying information
		$server = "localhost";
		$user = "bowen";
		$pw = "bowen1234";
		$dbname = "project";
		$db = new mysqli($server, $user, $pw, $dbname);
		if($db->connect_error) {
			die("Database connection error: " . $db->connect_error);
		}		
		
		//breweries query
		$select = "SELECT Name, Address1 as Address, City, State, Zip, Phone, Established as Est, Website
							FROM Breweries
							ORDER BY Name";
		$result = $db->query($select);
		$rows = $result->num_rows;
		if($rows > 0) {
			//database returned results as expected. Output in table format.
			$cols = mysqli_num_fields($result);
			echo "<table>\n<tr>\n";
			
			//print table headers
			for($i = 0; $i < $cols; $i++) {
				$column = mysqli_fetch_field($result);
				echo "<th>$column->name</th>\n";
			}
			echo "</tr>\n";
			
			//print table data
			while($row = mysqli_fetch_row($result)) {
				echo "<tr>\n";
				
				foreach($row as $data) {
					if(is_string($data)) {
						//if data is string, check for http - if found format as a link.
						if(strpos($data, "http") !== FALSE) {
							echo "<td><a href=\"$data\">Link to site</a></td>\n";
						}
						else {
							echo "<td>$data</td>\n";
						}
					}
					else {
						echo "<td>$data</td>\n";
					}					
				}
				echo "</tr>\n";
			}
			echo "</table>";
		}
		else {
			echo "No data found.";
		}
		
		//close the brewery section of the document and open beer section
		?>
			</div> <!-- ends the Breweries section -->
			<div class="blog-post">
				<h2 class="blog-post-title" id="beers-info">Beers</h2>
		<?php
		
		//beers query
		$select = "SELECT breweries.Name as Brewery, beer.Name, Style, IBU, Plato, ABV, Hops, Notes
							FROM beer, breweries
							WHERE beer.BreweryID = breweries.ID
							ORDER BY breweries.Name, beer.Name";
		$result = $db->query($select);
		$rows = $result->num_rows;
		if($rows > 0) {
			//database returned results as expected. Output in table format.
			$cols = mysqli_num_fields($result);
			echo "<table>\n<tr>\n";
			
			//print table headers
			for($i = 0; $i < $cols; $i++) {
				$column = mysqli_fetch_field($result);
				echo "<th>$column->name</th>\n";
			}
			echo "</tr>\n";
			
			//print table data
			while($row = mysqli_fetch_row($result)) {
				echo "<tr>\n";
				
				foreach($row as $data) {
					echo "<td>$data</td>\n";
				}
				echo "</tr>\n";
			}
			echo "</table>";
		}
		else {
			echo "No data found.";
		}
		
		//end the beer section and the blog section
		?>
				</div> <!-- ends the Beer section -->
			</div> <!-- ends the blog-main section -->
		<?php
		
		//close the database and display the other sections of the document
		$db->close();		
		display_sidebar();		
		display_footer();
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