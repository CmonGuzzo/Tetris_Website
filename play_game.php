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
	<h1 class="title">Play Game</h1>
	<div class="container-fluid">
		<div class="row play">



			<div class="col-12 col-lg-7 board">
				<div id = "grid" class= "board_game"></div>
			</div>



			<div class="col-12 col-lg-5">
				<div class="row">
					<div class="col-6 col-lg-12 piece">
						<h3>Next Piece</h3>
						<div class="next"></div>
					</div>

					<div class="col-6 col-lg-12 player_score">
						<h3>Score:</h3>
						<h2 class='currentScore'>0</h2>
					</div>

					<div class="col-6 submitArea">
						<form action="add_score.php" method="GET" id="submit_form">
							<input type="hidden" name="score_id" id = "score-id" value ="0">
							<button type="submit" class="btn btn-primary submitButton">Submit Score</button>
						</form>
					</div>
					<div class="col-6 resetAndQuit">
						<a class="btn btn-primary resetButton" href="play_game.php" role="button">RESET</a>
						<a class="btn btn-primary quitButton" href="main_menu.html" role="button">QUIT</a>
					</div>


				</div>


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

	<script src="backendalt.js"></script>
</body>
</html>