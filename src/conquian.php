<?php
    session_start();
    include_once 'dbconnect.php';
    
    if (!isset($_SESSION['user']))
    {
        header("Location: index.php");
    }

$user = $_SESSION['user'];
//echo $user; // user is user_id

$res = mysqli_query($connection, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res);

?>

<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="format.css" type="text/css" />
<link rel="stylesheet" href="main.css" type="text/css" />
</head>

<header>
    <a href="MainMenu.php" class="company">We Play Cards Inc.</a><BR>
</header>

<div id="header">
    <div id="right">
        <div id="content">
            <b class="padRight">Hello <?php echo $userRow['email'];?></b>
            <b class="padRight">Points:<?php echo $userRow['points'];?></b>
            <a href="MainMenu.php" class="padRight">Home</a>
            <a href="logout.php?logout" class="padRight">Sign Out</a>
        </div>
    </div>
</div>

<body style="background:green;"> <!-- Changed from gray to white -->
	<div id="gameboard" style= "height: 105vh; background:green;">
        <p id="gameState" ></p>
        <p id="moveUpdate" ></p>

		<button class="buttonx" id="subButton" onclick="submitMove()" draggable = "false">SUBMIT MOVE</button>
		<button  class="button1x" id="endButton" onclick="endTurn()" draggable = "false">END TURN</button>
        <BR><BR>
        <p class="Computer">Computer</p>
		<p id="computerHand" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
        <BR>
		<p id="comp1" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="comp2" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="comp3" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="comp4" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="comp5" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="comp6" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="comp7" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="comp8" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="comp9" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
        <BR>
        <p id="cardDrawn" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
        <BR><BR>
		<p id="player1" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="player2" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="player3" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="player4" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="player5" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="player6" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="player7" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="player8" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
		<p id="player9" class="comboArea" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
        <BR><BR>
		<p id="playerHand" ondrop="drop(event)" ondragover="allowDrop(event)"></p>
        <BR>
		<p class="Player">Player</p>
		<p class="discardPile">DISCARD PILE</p>

	</div>
		
		<!-- You can change the p to img and add any winning screen you want -->
        <!--Win and Lose messages -->

		<div id="winScreen" style="display:none">
		<p style="font-size:3em; color:white; text-align:center;"><BR><BR>You Win!<BR><BR><BR><BR></p>
		</div>
		
		<div id="loseScreen" style="display:none">
		<p style="font-size:3em; color:white; text-align:center;"><BR><BR>You Lose!<BR><BR><BR><BR></p>
		</div>

        <!-- Help and Quit Buttons -->
        <div id="help" style="display:none; color:white; left:20px; position:relative;">
            <br>
            <H1>How To Play:</H1>
            <p style="width:800px;"> Conquian is a Rummy game played with two players. It is one of the oldest known Rummy games which originated in Spain and goes back hundreds of years. The game can be played with more than two, but typically there are not enough cards to make it a long enough game if using a Spanish style deck.
            <BR><BR>
                The objective of Conquian is to be the first player with no cards left in their hand. To do this you must “meld” your cards by arranging them in runs (three or more cards in the same suit in consecutive order) or in groups (three of a kind) of three to eight cards and placing them face upwards on the table. Cards can be added to existing melds and taken away, provided a complete set or group is left in place.
            <BR><BR>
                No meld can contain more than eight cards, because the minimum meld is three and you have to meld exactly eleven cards to win. Ace is always low and so Q-K-A is not a valid meld.
            </p>
            <BR><BR>
            <button onclick="backToGame()" id="boxButton">Back to Game</button>
            <BR><BR><BR><BR><BR><BR><BR>
        </div>


        <div id ="quit">
            <button onclick="quit()" id="quitButton">Quit</button>
            <button onclick="helpMenu()" id="helpButton">Help</button>
            <div id="subMenu">
                <p>Would you like to quit?</p>
                <a href="index.php"><button onclick="yes()" id="boxButton">Yes</button></a>
                <button onclick="no()" id="boxButton">No</button>
            </div>
        </div>

</body>

<footer>

    <div id="fbox1">SOCIAL
    </div>

    <a href="https://instagram.com/officialbicyclecards/"><img class="imgIcons" src="images/instagramicon.png"></a>
    <a href="https://www.facebook.com/bicyclecards"><img class="imgIcons" src="images/facebook.png"></a>
    <a href="https://twitter.com/bicyclecards?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><img  class="imgIcons" src="images/twittericon.png"></a>

</footer>

</html>


<script src="card.js"></script>
<script src="deck.js"></script>
<script src="opponent.js"></script>

<script>

//Help & Quit Functions
function helpMenu(){
    document.getElementById("gameboard").style.display = "none";
    document.getElementById("help").style.display = "initial";
}

function backToGame(){
    document.getElementById("gameboard").style.display = "initial";
    document.getElementById("help").style.display = "none";
}

function quit(){
    document.getElementById("subMenu").style.display = "initial";
}

function no(){
    document.getElementById("quit").style.display = "initial";
    document.getElementById("subMenu").style.display = "none";
    
}

//functions

//will check if the card is valid or not
var cardIsValid = function (testCard) {
	if (testCard.getValue() <= 9 && testCard.getValue() >= 8)
		return false;
	return true;
}

//accepts an array that will be checked to see if its a valid move
var validMove = function (move) {
	
	if (move.length < 3)
		return false;
	
	//sorting the move array using insertion sort, since move array would always be small
	for (var i = 0; i < move.length; i++) {
		var temp = move[i];
		var j = i;
		while (j > 0 && temp.getValue() < move[j-1].getValue()) {
			move[j] = move[j-1];
			j--;
		}
		move[j] = temp;
	}
	
	var counter = 0;
	//check if the cards are of the same value
	var testValue = move[0].getValue();
	for (var i = 0; i < move.length; i++)
		if (move[i].getValue() === testValue)
			counter++;
	if (counter === move.length){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
			}
		}	
		xhttp.open("GET", "addPoints.php", true);
		xhttp.send();
		return true;
	}
	counter = 1;
	var testSuit = move[0].getSuit();
	//check if the cards are in ascending order and if the suit are the same
	//first card is not tested
	for (var i = 1; i < move.length; i++) {
		//if suit are the same
		if (move[i-1].getSuit() === move[i].getSuit()) {
			//if the card is a 11 then the card before it was a 7
			if (move[i-1].getValue() + 1 === move[i].getValue())
				counter++;
			else if (move[i].getValue() === 10)
				if (move[i-1].getValue() === 7)
					counter++;
		}
	}
	if (counter === move.length){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
			
			}
		}	
		xhttp.open("GET", "addPoints.php", true);
		xhttp.send();
		return true;
	}
	return false;
}

//returns a string that represents the players hand used to draw on screen
var drawHand = function(hand, player) {
	// a var representation of the players current cards
	var stringRep = "<img id = 'images/ghostcard.png' src= 'images/ghostcard.png' height = '125' width = '90' draggable='false'>";
	//prefix added for id of image
	if (player) {
		for (var i = 0; i < hand.length;i++)
			stringRep += "<img id = '" + "x" + hand[i].getImageSource() + "' src=" + hand[i].getImageSource() + " height = '125' width = '90' draggable='true' ondragstart='drag(event)'>";
	}
	else {
		for (var i = 0; i < hand.length; i++)
			stringRep += "<img id = 'yImages/back.jpeg' src= images/back.jpeg height = '125' width = '90' draggable='false'>"
	}
	return stringRep;
}


//lets the user pass the turn
function endTurn() {	
	//checks if the user still needs to discard a card
	if (userDiscaredCard) {
		document.getElementById("moveUpdate").innerHTML = "";
		document.getElementById("moveUpdate").style.color = "black";
		//check cards that dont belong on the players board and return them back to their hand
		if (whosTurn) {
			if (tempComboHolder.length > 0) {
				for (var i = 0; i < tempComboHolder.length; i++)
					playerHand.push(tempComboHolder[i]);
				for (var i = 1; i <= 9; i++)
					if (document.getElementById("player" + i).hasChildNodes())
						if (document.getElementById("player" + i).childNodes[0].draggable)
							document.getElementById("playerHand").appendChild(document.getElementById("player" + i).childNodes[0]);
				tempComboHolder = new Array();
			}
		}
 		//if not needed to draw, change user and let them look at card
		if (action) {
			if (whosTurn) {
				whosTurn = 0
				document.getElementById("gameState").innerHTML = "Computer's Turn";
			}
			else {
				whosTurn = 1;
				document.getElementById("gameState").innerHTML = "Player's Turn";
			}

			action = 0;
		}//user draws a card 
		else {
			do {
				drawnCard = playDeck.drawCard();
				if (drawnCard == null)
					break;				
			} while (!cardIsValid(drawnCard) );
			if (drawnCard == null){ //if the card is null that means no more cards are availble the game ends
					console.log("The game is over nobody wins");
					document.getElementById("gameboard").style.display = "none";
					document.getElementById("loseScreen").style.display = "initial";
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						//document.getElementById("demo").innerHTML = xhttp.responseText;
						}
					}	
					xhttp.open("GET", "subPoints.php", true);
					xhttp.send();
					return;//exit the game
			}	
			document.getElementById("cardDrawn").innerHTML =  "<img id = 'deck" + drawnCard.getImageSource() + "'src=" + drawnCard.getImageSource() + " height = '125' width = '90' draggable='true' ondragstart='drag(event)'>";
			action = 1;
		} 
	}
 	else {
 		document.getElementById("moveUpdate").innerHTML = "Dicard card first";
		document.getElementById("moveUpdate").style.color = "red";
	 }
	if (!whosTurn)//callls computers turn
		computerTurn();
}

//called when the user presses submit
function submitMove() {
	if (validMove(tempComboHolder)) {
		
		//checks if the player has won by looking at their board
		var counter = 0;
		for (var i = 1; i <= 9; i++)
		if ((document.getElementById("player" + i).hasChildNodes()))
			counter++;
		console.log("counter is " + counter);
		if (counter == 9){
			console.log("The player has won!");
			document.getElementById("gameboard").style.display = "none";
			document.getElementById("winScreen").style.display = "initial";
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
			//document.getElementById("demo").innerHTML = xhttp.responseText;
			}
		}	
		xhttp.open("GET", "addPoints.php", true);
		xhttp.send();
			return;
		}

		document.getElementById("moveUpdate").innerHTML = "Valid Move!";
		document.getElementById("moveUpdate").style.color = "black";
		//move the images to the left most empty space
		var container = "player";
		var userPrefix = "x";
		var deckPrefix = "deck";

		
		for (var i = 0; i < tempComboHolder.length; i++) {
			//search for an empty slot
			var currentLoc = 1;
			var foundCard = false;
			while (document.getElementById(container + currentLoc).hasChildNodes()) {	
				//if the card is found then set found card to true and break out of loop				
				if (document.getElementById(container + currentLoc).childNodes[0].src.indexOf(tempComboHolder[i].getImageSource()) != -1) {
					foundCard = true;
					break;
				}	
				currentLoc++;
			}
			
			//finds the card and sets it to not draggable since its part of a combo now
			if (tempComboHolder[i].getImageSource() === drawnCard.getImageSource()) {
				if (!foundCard)//if the card was not found then move it 
					document.getElementById(container + currentLoc).appendChild(document.getElementById(deckPrefix + tempComboHolder[i].getImageSource()));
				document.getElementById(deckPrefix + tempComboHolder[i].getImageSource()).draggable = false;
				userDiscaredCard = false;//set to false since the user needs to discard a card now
				
			}
			else {
				if (!foundCard)//if the card was not found then move it
					document.getElementById(container + currentLoc).appendChild(document.getElementById(userPrefix + tempComboHolder[i].getImageSource()));	
				document.getElementById(userPrefix + tempComboHolder[i].getImageSource()).draggable = false;
			}
		}

		tempComboHolder = new Array();
		//since the user use the deck card they will need to discard one now	
		if (!userDiscaredCard) {
			document.getElementById("moveUpdate").innerHTML = "Discard a card!";
			canDropAnyCardInDeck = true;
		}
	}
	else {
		document.getElementById("moveUpdate").innerHTML = "Invalid Move!";
		document.getElementById("moveUpdate").style.color = "red";
	}

}


//removes the card from the tempcomboHolder and returns a new array for the players hand array
function removeFromHand(cardArray, cardSource) {
	var location = null;
	//finds the location of the card that will be removed
	for (var i =0; i < cardArray.length; i++) {
		if (cardSource.indexOf(cardArray[i].getImageSource()) != -1) {
			tempComboHolder.push(cardArray[i]);//puts the card into the comboArray
			location = i;
			break;
		}
	}
	//if the card was found and removed
	if (location != null) {
		var newArray = new Array();
		//add the elements, skip the old one
		for (var i = 0; i < cardArray.length; i++)
			if (i != location)
				newArray.push(cardArray[i]);
		return newArray.slice();
	}
	else {//the card was the card in the middle so pushing and returning the old array
		tempComboHolder.push(drawnCard);
		return cardArray;
	}
}

//returns the card that is in the temp comboHolder
function addToHand(cardSource) {
	var location;
	//finds the location of the card
	for (var i = 0; i < tempComboHolder.length; i++)
		if (cardSource.indexOf(tempComboHolder[i].getImageSource()) != -1) {
			location = i;
			break;
		}
	
	var newArray = new Array();
	//pushes all the elements into the new array except for the one that will be removed
	for (var i = 0; i < tempComboHolder.length; i++)
		if (i != location)
			newArray.push(tempComboHolder[i]);
	var temp = tempComboHolder[location];
	tempComboHolder = newArray.slice();
	return temp;
}

//triggers when an object is dragged
function drag(ev) {
	//sets the data that will be transfered
    ev.dataTransfer.setData("text", ev.target.id);
}

//lets the browser stop the default dragging, which is none
function allowDrop(ev) {
    ev.preventDefault();
}


//triggers when the object is dropped
function drop(ev) {
    //prevents the default dropping method
    ev.preventDefault();
    //checks if the card dropped is going back to the deck
    if (ev.target.id.indexOf("deck") != -1) {
    	var data = ev.dataTransfer.getData("text");
    	//if the card belongs to the deck then add it back or if the user needs to discard the card
    	if (data.indexOf("deck") != -1 || canDropAnyCardInDeck) {
    		//gets the container that holds the deck card
    		var temp = document.getElementById("cardDrawn");
    		//removes the old card
    		temp.removeChild(temp.childNodes[0]);
    		//appends the new card that just got dragged
    		temp.appendChild(document.getElementById(data));
    		//if the card is a discarded one then
    		if (canDropAnyCardInDeck) {
    			var tempArray = new Array();
    			//remove the card from your own hand
    			
    			for (var i = 0; i < playerHand.length; i++) {
    				//the other cards except the one played are pushed into the new array
    				if (!(document.getElementById(data).src.indexOf(playerHand[i].getImageSource()) != -1)) 
    					tempArray.push(playerHand[i]);
    				else
    					drawnCard = playerHand[i];//set the new card
    			}
    			playerHand = tempArray.slice()//sets the new array that now has 1 less card
    			//changes the id of the card now since its a deck card
    			document.getElementById("x" + drawnCard.getImageSource()).id = "deck" + drawnCard.getImageSource();
    			//can drop any card is set to false now since a card is discarded, and user discarded is satisfied
				//and card changed is set to true;
    			canDropAnyCardInDeck = false;
    			userDiscaredCard = true;
				action = 1;//user changed card next player gets a turn to use it
     			
    		}
    		else {
    			//removes the card from the tempComboHolder
    			var tempArray = new Array();
    			for (var i = 0; i < tempComboHolder.length; i++)
					if (tempComboHolder[i] != drawnCard)
						tempArray.push(tempComboHolder[i]);
				tempComboHolder = tempArray.slice();
    		}
    	}	
    } 
	else if (whosTurn) {
		//checks if the place where the card will be dropped is users hand
		if (ev.target.id.indexOf("playerHand") != -1) {
			var data = ev.dataTransfer.getData("text");
			//if the card is from the deck or the other persons hand then you cannot add it to the your hand
			if (data.indexOf("deck") === -1 && data.indexOf("y") === -1) {
   				ev.target.appendChild(document.getElementById(data));
   				//for checking if the card came from your hand
   				var inHandAlready = false;
				for (var i = 0; i < playerHand.length; i++)
					if (document.getElementById(data).src.indexOf(playerHand[i].getImageSource()) != - 1)
						inHandAlready = true;
				//dont add to the hand array since the card exist there already
				if (!inHandAlready)
			   		playerHand.push(addToHand(document.getElementById(data).src));
   			}
		}//checks if the place where the card will be dropped is the users combo area
		else if (ev.target.id.indexOf("player") != -1) {
			var data = ev.dataTransfer.getData("text");
			//if the card does not contain the prefix for the other player add it to your board
			if (data.indexOf("y") === -1) {
   				ev.target.appendChild(document.getElementById(data));
   				//used in the beginning when users need to exchange cards
				if (needToExchange) {
					for (var i = 1; i <= 9; i++)
						 //found card so now we move it to the other persons hand
						 if (document.getElementById("player" + i).hasChildNodes()) {
						 	
						 	var strings = document.getElementById("player" + i).childNodes[0].id;
							string = strings.substring(1,strings.length);
							document.getElementById("player" + i).removeChild(document.getElementById("player" + i).childNodes[0]);
						 	for (var x = 0; x < playerHand.length; x++) {
						 		
						 		if (playerHand[x].getImageSource().indexOf(string) != -1) {
						 			var cardToDiscard = playerHand[x];
									//now remove that card from the players hand
									var tempArray = new Array()
									for (var y = 0; y < playerHand.length; y++)
										if (cardToDiscard.getImageSource() != playerHand[y].getImageSource())
											tempArray.push(playerHand[y]);
									playerHand = tempArray.slice();
									
									var compDiscard = compPlayer.discardCard();
									//add the card to the other guys deck
									compPlayer.addCard(cardToDiscard);	
									playerHand.push(compDiscard);
									document.getElementById("playerHand").innerHTML = drawHand(playerHand, 1);
									document.getElementById("computerHand").innerHTML = drawHand(compPlayer.getDeck(), 0);
									break;
						 		}
						 	}
						 }
					//set it to false so you cant enter here anymore
					needToExchange = false;
					start();
				}
				else {
   					playerHand = removeFromHand(playerHand, document.getElementById(data).src);
   					//if the card is from the deck change the image of the deck
   					if (data.indexOf("deck") >= 0)
   						document.getElementById("cardDrawn").innerHTML =  "<img id = 'deckImages/back.jpeg' src= images/back.jpeg height = '125' width = '90' draggable='false'>";
   				}
   			}
		}	
	}
}

//sets up the game
function init() {
	
	//fills the starting hand for the players
	var compHand = new Array();
	for (var i = 0; i < 8;) {
		var temp = playDeck.drawCard();
		if (cardIsValid(temp)) {
			compHand.push(temp);
			i++;
		}
	}
	
	for (var i = 0; i < 8;) {
		var temp2 = playDeck.drawCard();
		if (cardIsValid(temp2)) {
			playerHand.push(temp2);
			i++;
		}
	}
	
	compPlayer = new Opponent(compHand);
	//draw the hand of both players here
	document.getElementById("computerHand").innerHTML = drawHand(compPlayer.getDeck(), 0);
	
	document.getElementById("playerHand").innerHTML = drawHand(playerHand, 1);	

	//setting up for exchanging one card
	document.getElementById("gameState").innerHTML = "Discard a card";
	document.getElementById("moveUpdate").innerHTML = "Drop it in empty slot";
	document.getElementById("cardDrawn").innerHTML =  "<img id = 'deckImages/back.jpeg' src= images/back.jpeg height = '125' width = '90' draggable='false'>";
	document.getElementById("endButton").style.visibility = "hidden";
	document.getElementById("subButton").style.visibility = "hidden";
}

//after discarding starts up the game
function start() {
	whosTurn = Math.floor(Math.random() *2);
	
	if (whosTurn)
		document.getElementById("gameState").innerHTML = "Player's Turn";
	else
		document.getElementById("gameState").innerHTML = "Computer's Turn";
	document.getElementById("moveUpdate").innerHTML = "";
	//draws the first card
	do {
		drawnCard = playDeck.drawCard();	
	} while (!cardIsValid(drawnCard));	
	document.getElementById("cardDrawn").innerHTML =  "<img id = 'deck" + drawnCard.getImageSource() + "'src=" + drawnCard.getImageSource() + " height = '125' width = '90' draggable='true' ondragstart='drag(event)'>";
	document.getElementById("endButton").style.visibility = "visible";
	document.getElementById("subButton").style.visibility = "visible";
	
	if (!whosTurn)
		computerTurn();	
}

//is called when the computer needs to take a turn
function computerTurn() {
	//the computer will try to make a valid play
	var result = compPlayer.getValidPlay(drawnCard);
	var drawnCardUsed = false;
	if (result != null) {
		//update the cards on the board
		var counter = 0;
		for (var i = 1; i <= 9; i++) {
			if (!(document.getElementById("comp" + i).hasChildNodes())) {//looks for empty spaces
				if (counter == result.length)//so it doesnt go over the result array limit
					break;
				if (result[counter].getImageSource() == drawnCard.getImageSource()) {//if its that was in the middle was used
					document.getElementById("comp" + i).appendChild(document.getElementById("deck" + result[counter].getImageSource()));
					document.getElementById("cardDrawn").innerHTML =  "<img id = 'deckImages/back.jpeg' src= images/back.jpeg height = '125' width = '90' draggable='false'>";//put an empty image there
					drawnCardUsed = true;	
				}
				else {
					//create the image on the blank space
					document.getElementById("comp" + i).innerHTML = "<img id = '" + "y"+ result[counter].getImageSource()+ "' src=" + result[counter].getImageSource() + " height = '125' width = '90' draggable='false' ondragstart='drag(event)'>";
					console.log("Card used " + result[counter].getImageSource());
				}
				counter++;
			}
		}
		document.getElementById("computerHand").innerHTML = drawHand(compPlayer.getDeck(), 0);
			
		counter = 0;
		//checks if the board is full which means the computer has won
		for (var i = 1; i <= 9; i++)
			if (document.getElementById("comp" + i).hasChildNodes())
				counter++;
		if (counter == 9) {
			console.log("computer has won");
			document.getElementById("gameboard").style.display = "none";
			document.getElementById("loseScreen").style.display = "initial";
			return;
		}
		
		if (drawnCardUsed) {//if the card from the deck was used, it discards a card and moves it to the deck
			var discardedCard = compPlayer.discardCard();
			console.log(discardedCard.getImageSource() + " card discarded");
			document.getElementById("cardDrawn").removeChild(document.getElementById("cardDrawn").childNodes[0])
			document.getElementById("cardDrawn").innerHTML = "<img id = '" + "deck"+ discardedCard.getImageSource()+ "' src=" + discardedCard.getImageSource() + " height = '125' width = '90' draggable='false' ondragstart='drag(event)'>";
			action = 1;
			document.getElementById("computerHand").innerHTML = drawHand(compPlayer.getDeck(), 0);
		}
	}
	
	endTurn();
	
}
//creating variables for game
var playDeck = new Deck;
var playerHand = new Array();
var tempComboHolder = new Array();//will hold the cards while the player is making a turn
var compPlayer;//the computer player
var drawnCard;

var whosTurn = 1;

var userDiscaredCard = true;//set to false if the user needs to drop the card into the deck
var canDropAnyCardInDeck = false;//used to let the user drop a card from their hand into the deck
var action = 1;//to specify what will happen in the next turn
var needToExchange = true;
init();

//verison 0.85
</script>