<?php
	//This script is for destroying the session for testing purposes.

	session_start();
	session_destroy();
	exit();
?>