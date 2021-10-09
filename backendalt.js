let grid =[[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,1,1,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0]];

let next = [[0,0,0,0],
			[0,0,0,0],
			[0,0,0,0]]

function drawGrid(){
	for (let row=0; row<grid.length; row++){
		for (let col=0; col<grid[row].length; col++){
			document.getElementById('grid').innerHTML += "<div class ='empty row-" + row + " col-" + col + "'></div>";
		}
		document.getElementById('grid').innerHTML += "<br>";
	}
	for (let row=0; row<next.length; row++){
		for (let col=0; col<next[row].length; col++){
			document.querySelector('.next').innerHTML += "<div class ='empty y-" + row + " x-" + col + "'></div>";
		}
		document.querySelector('.next').innerHTML += "<br>";
	}
}

function startGrid(){
	for (let row = 0; row < piece.length; row++){
		let className = ".row-" + piece[row][0] + ".col-" + piece[row][1];
		document.querySelector(className).innerHTML = "<div class ='fill'></div>";
	}
}

function moveDown(){
	let canMove = true;
	for (let row = piece.length-1; row >=0; row--){
		let underSquare = ".row-" + (piece[row][0]+1) + ".col-" + piece[row][1];
		if (piece[row][0] == grid.length-1) {
			canMove = false;
			nextPiece();
		}
		else if (document.querySelector(underSquare).children[0] != null){
			if (!document.querySelector(underSquare).children[0].classList.contains("fill")){
				canMove = false
				nextPiece();
			}
		}
	}
	if (canMove && endGame==false){
		for (let row = piece.length-1; row >=0; row--){
			let oldClass = ".row-" + piece[row][0] + ".col-" + piece[row][1];
			document.querySelector(oldClass).innerHTML = "";
			let newClass = ".row-" + (piece[row][0]+1) + ".col-" + piece[row][1];
			document.querySelector(newClass).innerHTML = "<div class ='fill'></div>";
			piece[row][0] += 1;
		}
	}
}

function moveLeft(){
	let canMove= true;
	for (let row = 0; row <piece.length; row++){
		let leftSquare = ".row-" + (piece[row][0]) + ".col-" + (piece[row][1]-1);
		if (piece[row][1] == 0) {
			canMove = false;
		}
		else if (document.querySelector(leftSquare).children[0] != null){
			if (!document.querySelector(leftSquare).children[0].classList.contains("fill")){
				canMove = false
			}
		}
	}
	if (canMove){
		for (let row = 0; row < piece.length; row++){
			let oldClass = ".row-" + piece[row][0] + ".col-" + piece[row][1];
			document.querySelector(oldClass).innerHTML = "";
			let newClass = ".row-" + piece[row][0] + ".col-" + (piece[row][1]-1);
			document.querySelector(newClass).innerHTML = "<div class ='fill'></div>";
			piece[row][1] -= 1;
		}
	}
}

function moveRight(){
	let canMove= true;
	for (let row = 0; row <piece.length; row++){
		let rightSquare = ".row-" + (piece[row][0]) + ".col-" + (piece[row][1]+1);
		if (piece[row][1] == grid[0].length-1) {
			canMove = false;
		}
		else if (document.querySelector(rightSquare).children[0] != null){
			if (!document.querySelector(rightSquare).children[0].classList.contains("fill")){
				canMove = false
			}
		}
	}
	if (canMove){
		for (let row = piece.length-1; row >= 0; row--){
			let oldClass = ".row-" + piece[row][0] + ".col-" + piece[row][1];
			document.querySelector(oldClass).innerHTML = "";
			let newClass = ".row-" + piece[row][0] + ".col-" + (piece[row][1]+1);
			document.querySelector(newClass).innerHTML = "<div class ='fill'></div>";
			piece[row][1] += 1;
		}
	}
}

function timer(){
	if (endGame == false){
		setTimeout(timer, 1000);
		setTimeout(moveDown, 1000)
	}
}

function nextPiece(){
	for (let row = 0; row <piece.length; row++){
		let pieceSquare = ".row-" + (piece[row][0]) + ".col-" + piece[row][1];
		document.querySelector(pieceSquare).innerHTML = "<div class ='occupied'></div>";
	}
	gameOver();
	checkLines();
	pieceNumber = futurePieceNumber;
	if (pieceNumber == 0){
		piece = [[0,4], [0,5], [1,4], [1,5]];
	}
	else if (pieceNumber == 1){
		piece = [[0,5], [0,6], [1,4], [1,5]];
	}
	else if (pieceNumber == 2){
		piece = [[0,4], [0,5], [1,5], [1,6]];
	}
	else if (pieceNumber == 3){
		piece = [[0,4], [1,4], [1,5], [1,6]];
	}
	else if (pieceNumber == 4){
		piece = [[0,6], [1,4], [1,5], [1,6]];
	}
	else if (pieceNumber == 5){
		piece = [[0,5], [1,4], [1,5], [1,6]];
	}
	else if (pieceNumber == 6){
		piece = [[0,3], [0,4], [0,5], [0,6]];
	}
	state=0;
	future();
	if (endGame == false){
		for (let row = 0; row < piece.length; row++){
			let newSquare = ".row-" + (piece[row][0]) + ".col-" + piece[row][1];
			document.querySelector(newSquare).innerHTML = "<div class ='fill'></div>";
		}
	}
}

function future(){
	for (let row = 0; row <futurePiece.length; row++){
		let index = futurePiece[row][0]*4 + futurePiece[row][0] + futurePiece[row][1];
		document.querySelector(".next").children[index].innerHTML = "";
	}
	futurePieceNumber = Math.floor(Math.random() * 7);
	if (futurePieceNumber == 0){
		futurePiece = [[1,1], [1,2], [2,1], [2,2]];
	}
	else if (futurePieceNumber == 1){
		futurePiece = [[1,2], [1,3], [2,1], [2,2]];
	}
	else if (futurePieceNumber == 2){
		futurePiece = [[1,1], [1,2], [2,2], [2,3]];
	}
	else if (futurePieceNumber == 3){
		futurePiece = [[1,1], [2,1], [2,2], [2,3]];
	}
	else if (futurePieceNumber == 4){
		futurePiece = [[1,3], [2,1], [2,2], [2,3]];
	}
	else if (futurePieceNumber == 5){
		futurePiece = [[1,2], [2,1], [2,2], [2,3]];
	}
	else if (futurePieceNumber == 6){
		futurePiece = [[1,0], [1,1], [1,2], [1,3]];
	}
	futurePieceState = 0;
	if (endGame == false){
		for (let row = 0; row <futurePiece.length; row++){
			let index = futurePiece[row][0]*4 + futurePiece[row][0] + futurePiece[row][1];
			document.querySelector(".next").children[index].innerHTML = "<div class ='fill'></div>";
		}
	}
}

function checkLines(){
	let counter = 0;
	for (let row=0; row<grid.length; row++){
		fullLine = true;
		for (let col=0; col<grid[row].length; col++){
			let singleSquare = ".row-" + row + ".col-" + col;
			if (document.querySelector(singleSquare).children[0] == null){
				fullLine = false;
			}
		}
		if (fullLine){
			for (let above = row; above > 1; above--){
				for (let col=0; col<grid[above].length; col++){
					let singleSquare = ".row-" + above + ".col-" + col;
					let topSquare = ".row-" + (above-1) + ".col-" + col;
					document.querySelector(singleSquare).innerHTML = document.querySelector(topSquare).innerHTML;
				}

			}
			counter++;
		}
	}
	for (let x=counter; x >=0;x--){
		score += (x*10);
	}
	document.querySelector(".currentScore").innerHTML = score;
	document.querySelector("#score-id").value = score;
}


function rotate(){
	let oldPiece = [[0,0],[0,0],[0,0],[0,0]];
	for (let row = 0; row < piece.length; row++){
		oldPiece[row][0] += piece[row][0];
		oldPiece[row][1] += piece[row][1];
	}
	if (pieceNumber == 1){
		if (state == 0){
			oldPiece[0][1] -= 1;
			oldPiece[1][0] += 1;
			oldPiece[1][1] -= 2;
			oldPiece[2][1] += 1;
			oldPiece[3][0] += 1;

		}
		else{
			oldPiece[0][1] += 1;
			oldPiece[1][0] -= 1;
			oldPiece[1][1] += 2;
			oldPiece[2][1] -= 1;
			oldPiece[3][0] -= 1;

		}
	}
	else if (pieceNumber == 2){
		if (state == 0){
			oldPiece[0][1] += 2;
			oldPiece[1][0] += 1;
			oldPiece[2][1] += 1;
			oldPiece[3][0] += 1;
			oldPiece[3][1] -= 1;
		}
		else{
			oldPiece[0][1] -= 2;
			oldPiece[1][0] -= 1;
			oldPiece[2][1] -= 1;
			oldPiece[3][0] -= 1;
			oldPiece[3][1] += 1;
		}
	}
	else if (pieceNumber == 3){
		if (state ==0){
			oldPiece[0][1] += 1;
			oldPiece[1][1] += 1;
			oldPiece[2][0] += 1;
			oldPiece[2][1] -= 1;
			oldPiece[3][0] += 1;
			oldPiece[3][1] -= 1;
		}
		else if (state == 1){
			oldPiece[0][0] += 1;
			oldPiece[0][1] -= 1;
			oldPiece[2][0] -= 1;
			oldPiece[2][1] += 2;
			oldPiece[3][1] += 1;
		}
		else if (state == 2){
			oldPiece[0][0] -= 1;
			oldPiece[0][1] += 1;
			oldPiece[1][0] -= 1;
			oldPiece[1][1] += 1;
			oldPiece[2][1] -= 1;
			oldPiece[3][1] -= 1;
		}
		else if (state == 3){
			oldPiece[0][1] -= 1;
			oldPiece[1][0] += 1;
			oldPiece[1][1] -= 2;
			oldPiece[3][0] -= 1;
			oldPiece[3][1] += 1;
		}
	}
	else if (pieceNumber == 4){
		if (state ==0){
			oldPiece[0][1] -=2;
			oldPiece[1][0] -=1;
			oldPiece[1][1] +=1;
			oldPiece[3][0] +=1;
			oldPiece[3][1] -=1;
		}
		else if (state == 1){
			oldPiece[0][0] +=1;
			oldPiece[1][0] +=1;
			oldPiece[2][1] +=1;
			oldPiece[3][1] -=1;
		}
		else if (state == 2){
			oldPiece[0][0] -=1;
			oldPiece[0][1] +=1;
			oldPiece[2][0] +=1;
			oldPiece[2][1] -=1;
			oldPiece[3][1] +=2;
		}
		else if (state == 3){
			oldPiece[0][1] +=1;
			oldPiece[1][1] -=1;
			oldPiece[2][0] -=1;
			oldPiece[3][0] -=1;
		}
	}
	else if (pieceNumber == 5){
		if (state ==0){
			oldPiece[3][0] +=1;
			oldPiece[3][1] -=1;
		}
		else if (state == 1){
			oldPiece[0][0] +=1;
			oldPiece[0][1] -=1;
			oldPiece[1][1] +=1;
			oldPiece[2][1] +=1;
		}
		else if (state == 2){
			oldPiece[0][0] -=1;
			oldPiece[0][1] +=1;
		}
		else if (state == 3){
			oldPiece[1][1] -=1;
			oldPiece[2][1] -=1;
			oldPiece[3][0] -=1;
			oldPiece[3][1] +=1;
		}
	}
	else if (pieceNumber == 6){
		if (state == 0){
			oldPiece[1][0] += 1;
			oldPiece[1][1] -= 1;
			oldPiece[2][0] += 2;
			oldPiece[2][1] -= 2;
			oldPiece[3][0] += 3;
			oldPiece[3][1] -= 3;
		}
		else{
			oldPiece[1][0] -= 1;
			oldPiece[1][1] += 1;
			oldPiece[2][0] -= 2;
			oldPiece[2][1] += 2;
			oldPiece[3][0] -= 3;
			oldPiece[3][1] += 3;
		}
	} 
	let outOfBounds =false;
	let canRotate = true;
	for (let row = 0; row < oldPiece.length; row++){
		if (oldPiece[row][0] >= grid.length-1 || oldPiece[row][1] < 0 || oldPiece[row][1] >= grid[0].length){
			outOfBounds = true;
			canRotate = false;
		}
	}
	if (!outOfBounds){
		for (let row = 0; row < oldPiece.length; row++){
			let newSquare =".row-" + oldPiece[row][0] + ".col-" + oldPiece[row][1];
			if (document.querySelector(newSquare).children[0] != null){
				if (!document.querySelector(newSquare).children[0].classList.contains("fill")){
					canRotate = false;
				}
			}
		}
	}
	if (canRotate){
		for (let row = 0; row < piece.length; row++){
			let singleSquare =".row-" + piece[row][0] + ".col-" + piece[row][1];
			document.querySelector(singleSquare).innerHTML = "";
		}
		for (let row = 0; row < piece.length; row++){
			let square =".row-" + oldPiece[row][0] + ".col-" + oldPiece[row][1];
			document.querySelector(square).innerHTML = "<div class ='fill'></div>";
		}
		if (state <3 && (pieceNumber==3 || pieceNumber==4 || pieceNumber ==5)){
			state += 1;
		}
		else if (state ==3 && (pieceNumber==3 || pieceNumber==4 || pieceNumber ==5)){
			state = 0;
		}
		else if (state ==0){
			state = 1;
		}
		else{
			state = 0;
		}
		piece=oldPiece;
	}
}

function gameOver(){
	for (let col=0; col < grid[0].length;col++){
		let singleSquare =".row-0" + ".col-" + col;
		if (document.querySelector(singleSquare).children[0] != null){
			if (document.querySelector(singleSquare).children[0].classList.contains("occupied")){
				endGame = true;
			}
		}
	}
}

document.onkeydown = function(e){
	if (endGame ==false){
		if (e.keyCode == 37){
			moveLeft();
		}
		else if (e.keyCode == 39){
			moveRight();
		}
		else if (e.keyCode == 40){
			moveDown();
		}
		else if (e.keyCode == 82){
			rotate();
		}
	}
}


drawGrid();
let piece = [[0,5], [1,4], [1,5], [1,6]];
let pieceNumber = 5;
let state = 0;
let futurePiece = [[0,0], [0,0], [0,0], [0,0]];
let futurePieceNumber = 0;
let futurePieceState = 0;
let endGame = false;
startGrid();
future();
let score = 0;
timer();
