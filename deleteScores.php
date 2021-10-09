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
		<h1 class="title">Search Tool</h1>
		<form action="" method="GET" id ="delete_form">

			<div class="form-group">
				 <input type="text" class="form-control" id="userSearch" placeholder="Enter Username" name ="nameInput">
			</div>

			<div class="form-group">
				<select name="country" id="country-id" class="form-control">
					<option selected value="">Country</option>
					<?php while($row = $results_country->fetch_assoc() ): ?>
						<option value="<?php echo $row['id']; ?>">
							<?php echo $row['country']; ?>
						</option>
					<?php endwhile; ?>
				</select>
			</div>


			<div class="form-group">
				<select name="age" id="age-id" class="form-control">
					<option selected value="">Age Group</option>
					<?php while($row = $results_age->fetch_assoc() ): ?>
						<option value="<?php echo $row['id']; ?>">
							<?php echo $row['type']; ?>
						</option>
					<?php endwhile; ?>
				</select>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary submitDelete">Submit</button>
			</div>


		</form>

		<h1 class="title">Delete Tool</h1>
		<form action="deleteScores.php" method="GET" id ="delete_confirm">

			<div class="form-group">
				 <input type="text" class="form-control" id="userID" placeholder="Enter ID" name ="ID">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary submitDelete">Delete</button>
			</div>

		</form>

		<table>
			<thead>
				<tr>
					<th class="username">Username</th>
					<th class="age">Age</th>
					<th class="country">Country</th>
					<th class="score">Score</th>
					<th class="idUser">ID</th>
				</tr>
			</thead>

			<tbody id="results">
			</tbody>
		</table>
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




		document.querySelector("#delete_form").onsubmit = function(event){
			event.preventDefault();

			let countryInput = document.querySelector("#country-id").value;
			let ageInput = document.querySelector("#age-id").value;
			let nameInput = document.querySelector("#userSearch").value;
			console.log(nameInput);
			ajaxGet("delete_backend.php?name=" + nameInput + "&country=" + countryInput +"&age=" + ageInput, function(results){

				let jsResults = JSON.parse(results);
				console.log(jsResults);
				let resultsList = document.querySelector("#results");

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

					let idSection = document.createElement("td");
					idSection.innerHTML=jsResults[i].id;
					tr.appendChild(idSection);


					resultsList.appendChild(tr);
				}
			});
		}

		document.querySelector("#delete_confirm").onsubmit = function(event){

			let IDInput = document.querySelector("#userID").value;
			ajaxGet("delete_confirm.php?userID=" + IDInput, function(results){
			});
		}
	</script>
</body>
</html>