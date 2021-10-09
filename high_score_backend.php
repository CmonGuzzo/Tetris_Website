<?php


	//$_GET["searchTerm"];

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
	$sql = "SELECT * FROM users 
			JOIN country
				ON users.country_id = country.id
			JOIN age_group
				ON users.age_group_id = age_group.id
			Where 1=1";


	if (isset($_GET["country"]) && !empty($_GET["country"])){
		$sql =$sql . " AND country.id='" . $_GET['country'] . "'";
	}
	if (isset($_GET["age"]) && !empty($_GET["age"])){
		$sql =$sql . " AND age_group.id='" . $_GET["age"] . "'";
	}

	$sql = $sql . " ORDER BY users.score DESC LIMIT 10;";
	$results = $mysqli->query($sql);
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();

	$results_array = [];

	// Run the while loop to get all the results. Store the results in another variable
	while( $row = $results->fetch_assoc()) {
		array_push($results_array, $row);
	}

	// Convert the assoc array to a json string
	echo json_encode($results_array);


?>