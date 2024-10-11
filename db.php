<?php
	// Database connection
	$conn = new mysqli('localhost', 'root', '', 'eboss_db');
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	date_default_timezone_set("Asia/Hong_Kong");
?>		
