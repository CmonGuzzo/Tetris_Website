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

	$sql_country = "SELECT * FROM country;";
	$results_country = $mysqli->query($sql_country);
	if ( !$results_country ) {
		echo $mysqli->error;
		exit();
	}

	$sql_age = "SELECT * FROM age_group;";
	$results_age = $mysqli->query($sql_age);
	if ( !$results_age ) {
		echo $mysqli->error;
		exit();
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
		<h1 class="title">High Scores</h1>
		<div class = "container-fluid">
			<div class = "row">

				<div class ="col-12 col-lg-6 global">
					<h2 class="subtitle">Global</h2>
					<table>
						<thead>
							<tr>
								<th class="username">Username</th>
								<th class="age">Age</th>
								<th class="country">Country</th>
								<th class="score">Score</th>
							</tr>
						</thead>

						<tbody id ="global-results">
						</tbody>
					</table>
				</div>


				<div class ="col-12 col-lg-6 regional">
					<h2 class="subtitle">Regional</h2>
					<form action="high_score.html" method="GET">
						<select name="country" id="country-id" class="form-control">
							<option selected value="">Country</option>
							<?php while($row = $results_country->fetch_assoc() ): ?>
								<option value="<?php echo $row['id']; ?>">
									<?php echo $row['country']; ?>
								</option>
							<?php endwhile; ?>
						</select>
						<select name="age" id="age-id" class="form-control">
							<option selected value="">Age Group</option>
							<?php while($row = $results_age->fetch_assoc() ): ?>
								<option value="<?php echo $row['id']; ?>">
									<?php echo $row['type']; ?>
								</option>
							<?php endwhile; ?>
						</select>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
					<table class= "resultsTable">
						<thead>
							<tr>
								<th class="username">Username</th>
								<th class="age">Age</th>
								<th class="country">Country</th>
								<th class="score">Score</th>
							</tr>
						</thead>

						<tbody id="regional-results">
						</tbody>
					</table>

				</div>
			</div>
		</div>
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

		function ajaxGet(endpointUrl, returnFunction){
			var xhr = new XMLHttpRequest();
			xhr.open('GET', endpointUrl, true);
			xhr.onreadystatechange = function(){
				if (xhr.readyState == XMLHttpRequest.DONE) {
					if (xhr.status == 200) {
						// When ajax call is complete, call this function, pass a string with the response
						returnFunction( xhr.responseText );
					} else {
						alert('AJAX Error.');
						console.log(xhr.status);
					}
				}
			}
			xhr.send();
		};

		document.querySelector("form").onsubmit = function(event){
			event.preventDefault();

			let countryInput = document.querySelector("#country-id").value;
			let ageInput = document.querySelector("#age-id").value;
			ajaxGet("high_score_backend.php?country=" + countryInput +"&age=" + ageInput, function(results){

				let jsResults = JSON.parse(results);
				let resultsList = document.querySelector("#regional-results");

				while (resultsList.hasChildNodes()){
					resultsList.removeChild(resultsList.lastChild);
				}
				for (let i = 0; i < jsResults.length; i++){
					let tr = document.createElement("tr");
					document.querySelector("tbody").appendChild(tr);
					let nameElement = document.createElement("td");
					nameElement.innerHTML=jsResults[i].name;
					tr.appendChild(nameElement);

					let ageElement = document.createElement("td");
					ageElement.innerHTML=jsResults[i].type;
					tr.appendChild(ageElement);

					let countryElement = document.createElement("td");
					countryElement.innerHTML=jsResults[i].country;
					tr.appendChild(countryElement);

					let scoreElement = document.createElement("td");
					scoreElement.innerHTML=jsResults[i].score;
					tr.appendChild(scoreElement);

					resultsList.appendChild(tr);
				}
			});
		}

		ajaxGet("global_backend.php", function(results){
			let globalResults = JSON.parse(results);
			let globalList = document.querySelector("#global-results");

			while (globalList.hasChildNodes()){
					globalList.removeChild(globalList.lastChild);
				}

			for (let i = 0; i < globalResults.length; i++){
				let tr = document.createElement("tr");
				document.querySelector("tbody").appendChild(tr);
				let nameElement = document.createElement("td");
				nameElement.innerHTML=globalResults[i].name;
				tr.appendChild(nameElement);

				let ageElement = document.createElement("td");
				ageElement.innerHTML=globalResults[i].type;
				tr.appendChild(ageElement);

				let countryElement = document.createElement("td");
				countryElement.innerHTML=globalResults[i].country;
				tr.appendChild(countryElement);

				let scoreElement = document.createElement("td");
				scoreElement.innerHTML=globalResults[i].score;
				tr.appendChild(scoreElement);

				globalList.appendChild(tr);
			}
		});


	</script>
</body>
</html>