<?php
	$host = "303.itpwebdev.com";
	$user = "kyledinh_db_user";
	$pass = "UscItp303";
	$db = "kyledinh_tetris_db";

	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	$sql_age = "SELECT * FROM age_group;";
	$results_age = $mysqli->query($sql_age);
	if ( $results_age == false ) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();
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
		<h1 class="title">Add Score</h1>
		<form action="score_confirmation.php" method="POST" id = "score-form">

			<div class="display_score">
				<span>SCORE: <?php echo $_GET['score_id']?></span>
			</div>

			<div class="form-group">
			    <label for="username">Username:</label>
			    <input type="text" class="form-control" id="username" placeholder="Enter Username" name ="usernameInput">
			    <small id="error-max-message" class ="error">Max 6 characters</small>
			</div>

			<div class="form-group">
			<label for="age">Age Group:</label>
				<select name="age" id="age" class="form-control">
					<option selected value="">Age Group</option>
					<?php while($row = $results_age->fetch_assoc() ): ?>
						<option value="<?php echo $row['id']; ?>">
							<?php echo $row['type']; ?>
						</option>
					<?php endwhile; ?>
				</select>
			</div>

			<div class="form-group">
			    <label for="country">Country:</label>
			    <input type="text" class="form-control" id="country" placeholder="Enter 3-Letter Abbreviated Country" name ="countryInput">
			    <small id="error-country-message" class ="error">Needs to be 3 characters</small>
			</div>

			<input type="hidden" name="score_id" id = "score-id" value =<?php echo $_GET['score_id']?>>

			<div class="form-group buttons">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-light">Reset</button>
				<br>
				<div id ="message-username" class= "error"></div>
				<br>
				<div id ="message-age" class= "error"></div>
				<br>
				<div id ="message-country" class= "error"></div>
			</div>
		</form>
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

	<script>
		document.querySelector("#username").oninput = function(event) {
			let userInput = document.querySelector("#username").value;
			if(userInput.trim().length > 6) {
				document.querySelector("#error-max-message").classList.add("is-invalid");
			}
			else{
				document.querySelector("#error-max-message").classList.remove("is-invalid");
			}
		}
		document.querySelector("#country").oninput = function(event) {
			let userInput = document.querySelector("#country").value;
			if(userInput.trim().length > 3) {
				document.querySelector("#error-country-message").classList.add("is-invalid");
			}
			else{
				document.querySelector("#error-country-message").classList.remove("is-invalid");
			}
		}

		document.querySelector("#score-form").onsubmit = function (){
			if (document.querySelector("#username").value.trim().length ==0 ||
				document.querySelector("#username").value.trim().length > 6 ||
				document.querySelector("#country").value.trim().length == 0 ||
				document.querySelector("#country").value.trim().length > 3 ||
				document.querySelector("#age").value == ""){
				event.preventDefault();
			}

			if (document.querySelector("#username").value.trim().length ==0){
				document.querySelector("#message-username").innerText = "Username Required";
				document.querySelector("#message-username").classList.add("is-invalid");
			}
			else {
				document.querySelector("#message-username").classList.remove("is-invalid");
			}
			if (document.querySelector("#country").value.trim().length ==0){
				document.querySelector("#message-country").innerText = "Country Required";
				document.querySelector("#message-country").classList.add("is-invalid");
			}
			else {
				document.querySelector("#message-country").classList.remove("is-invalid");
			}
			if (document.querySelector("#age").value == ""){
				document.querySelector("#message-age").innerText = "Age Group Required";
				document.querySelector("#message-age").classList.add("is-invalid");
			}
			else {
				document.querySelector("#message-age").classList.remove("is-invalid");
			}
		}
	</script>
</body>
</html>