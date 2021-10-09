<?php
	if ( !isset($_POST['usernameInput']) || empty($_POST['usernameInput']) 
	|| !isset($_POST['age']) || empty($_POST['age'])
	|| !isset($_POST['countryInput']) || empty($_POST['countryInput'])) {

		$error = "Please fill out all required fields.";
	}
	else{
		$host = "303.itpwebdev.com";
		$user = "kyledinh_db_user";
		$pass = "UscItp303";
		$db = "kyledinh_tetris_db";

		$mysqli = new mysqli($host, $user, $pass, $db);
		if ( $mysqli->errno ) {
			echo $mysqli->error;
			exit();
		}

		$sql_country = "SELECT * FROM country;";
		$results_country = $mysqli->query($sql_country);
		if ( $results_country == false ) {
			echo $mysqli->error;
			exit();
		}

		$countryID = "0";
		while($row = $results_country->fetch_assoc()){
			if ($row['country'] == strtoupper($_POST['countryInput'])){
				$countryID = $row["id"];
			}
		}

		if ($countryID == "0"){
			$sql_insert = "INSERT INTO country (country) VALUES ('" . strtoupper($_POST['countryInput']) . "');";
			$results_insert = $mysqli->query($sql_insert);
			if ( !$results_insert) {
				echo $mysqli->error;
				exit();
			}

			$sql_obtainID = "SELECT * FROM country WHERE country.country = '" . strtoupper($_POST['countryInput']) . "';";

			$results_obtainID = $mysqli->query($sql_obtainID);
			if (!$results_obtainID) {
				echo $mysqli->error;
				exit();
			}
			$row_obtain = $results_obtainID->fetch_assoc();
			$countryID = $row_obtain['id'];
		}



		$sql = "INSERT INTO users (name, score, country_id, age_group_id) VALUES ('" . $_POST['usernameInput'] . "', " . $_POST['score_id'] .", " . $countryID . ", " . $_POST['age'] . ");";
		$results = $mysqli->query($sql);
		if ( !$results ) {
			echo $mysqli->error;
			exit();
		}
		$mysqli->close();
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tetris</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
</head>

<body>
	<div id="header">
		<div class="container-fluid">
			<div class="animateBox">
				<img id="piece1" class= "animate" src="images/piece1.png" alt="Piece1"/></a>
				<img id="piece2" class= "animate" src="images/piece2.png" alt="Piece2"/></a>
				<img id="piece3" class= "animate" src="images/piece3.png" alt="Piece3"/></a>
				<img id="piece4" class= "animate" src="images/piece4.png" alt="Piece4"/></a>
				<img id="piece5" class= "animate" src="images/piece5.png" alt="Piece5"/></a>
				<img id="piece6" class= "animate" src="images/piece6.png" alt="Piece6"/></a>
				<img id="piece7" class= "animate" src="images/piece7.png" alt="Piece7"/></a>
			</div>
			<div class="row menu-options">
					<a class="btn btn-primary col-12 col-lg-4" href="play_game.php" role="button">Play Game</a>
					<a class="btn btn-warning col-6 col-lg-4" href="instructions.html" role="button">How to Play</a>
					<a class="btn btn-danger col-6 col-lg-4" href="high_score.php" role="button">High Scores</a>
			</div>
			<div class="logo">
				<a href="main_menu.html" role="button"><img src="images/tetrislogo.png" alt="Logo"></a>
			</div>
		</div>
	</div>

	<div id="body">
		<h1 class="title">Score Added</h1>
		<h2 class ="confirmation-message">Thank You For Submitting Your Score</h2>
	</div>

	<div id="footer">
		<div class="container-fluid">
			<hr>
			<div class="row">
				<div class ="col-6 copyright">
					<span>@Copyright 2021</span>
				</div>
				<div class="col-6 links">
					<a href="http://303.itpwebdev.com/~kyledinh/student_page.html"><img class= "website" src="images/website.png" alt="Website"/></a>
					<a href="https://www.instagram.com/kiehlsforrealz/"><img class= "insta" src="images/instagram.png" alt="Instagram"/></a>
					<a href="https://www.facebook.com/kyle.dinh.378/"><img class= "face" src="images/facebook.png" alt="Facebook"/></a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>