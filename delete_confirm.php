<?php

	// Connect to the database to search for a song in the database
	$host = "303.itpwebdev.com";
	$user = "kyledinh_db_user";
	$pass = "UscItp303";
	$db = "kyledinh_tetris_db";

	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	// Generate the SQL based on the user's input
	$sql = "DELETE FROM users WHERE users.id = " . $_GET['userID'] .";";

	$results = $mysqli->query($sql);
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();
?>