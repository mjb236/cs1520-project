<?php
	//Michael Bowen
	//CS1520 - Mon/Wed 4:30pm Recitation Tue 5:00pm
	//
	//Navbar file for project site
	//Contains the function that displays the navigation bar on each page.
	
	function display_navbar($navItems, $active) {
		?>
		<body>

    <div class="blog-masthead">
			<div class="container">
				<nav class="blog-nav">
					<?php
						foreach($navItems as $key => $val) {
							if(strcmp($key, $active)) {
								?><a class="blog-nav-item" href=<?php echo "\"$val\""; ?>><?php echo "$key"; ?></a> <?php
							}
							else {
								?><a class="blog-nav-item active" href=<?php echo "\"$val\""; ?>><?php echo "$key"; ?></a> <?php
							}
						}
					?>
				</nav>
			</div>
		</div>
		
		<?php
	}
?>