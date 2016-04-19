<?php
	//connect to the database for querying information
	$server = "localhost";
	$user = "bowen";
	$pw = "bowen1234";
	$dbname = "testing";
	$db = new mysqli($server, $user, $pw, $dbname);
	if($db->connect_error) {
		die("Database connection error: " . $db->connect_error);
	}

	//get brewery names and IDs from database
	$select = "SELECT ID, Name
						FROM Breweries";
	$result = $db->query($select);
	$rows = $result->num_rows;
	$array = array();
	if($rows > 0) {
		while($row = mysqli_fetch_row($result)) {
			//echo json_encode($row);
			array_push($array, $row);
		}
	}
	$db->close();

	echo json_encode($array);
?>