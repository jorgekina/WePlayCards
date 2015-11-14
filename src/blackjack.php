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
<LINK REL=StyleSheet HREF="blackjack.css" TYPE="text/css">
<LINK REL=StyleSheet HREF="main.css" TYPE="text/css">

</head>


<header>
    <a href="MainMenu.php" class="company">We Play Cards Inc.</a><BR>
</header>


<div id="header">
    <div id="right">
        <div id="content">
            <b class="padRight">Hello <?php echo $userRow['email'];?></b>
            <b class="padRight">Points:<?php echo $userRow['points'];?></b>
            <a href="MainMenu.php" class="padRight">Main Menu</a>
            <a href="logout.php?logout" class="padRight">Sign Out</a>
        </div>
    </div>
</div>

<body>



    <div id="blackjack" style="height:400px; width:100%;">
	
	<div id="game">
        <a href=# class="dealButton" button id="deal" onclick="startGame()"  ></button></a>
        <a href=# class="hitButton" button id="hit" onclick="hitMe()"  ></button></a>
        <a href=# class="standButton" button id="stand"  onclick="stop()" ></button></a>
        
        <p class = "Player">Dealer</p>
        <p id ="dealerCards">  <img src= "images/Aclubs.png" height = "150" width = "115" style="visibility:hidden;"></p>
            
        <p id="result"></p>
            
        <p class = "Player">Player</p>
        <p id="playerCards"><img src= "images/Aclubs.png" height = "150" width = "115" style="visibility:hidden;"></p>

	</div>
	
	<div id="help" style="display:none; color:white;">
        <br>
        <H1>How to play:</H1>
        <p>The game Blackjack also called 21 is played with a standard deck of 52 cards.
        <br>
        <br> The object of the game is to beat the dealer in one of the following ways:
        <li>Get 21 points on the player's first two cards (called a blackjack), without a dealer blackjack;
        <li>Reach a final score higher than the dealer without exceeding 21; or
        <li>Let the dealer draw additional cards until his or her hand exceeds 21.
        <br>
        <br>To Draw a card simply press the Hit button and to stop drawing cards press the Stand button.
        <br>Once you press the Stand button the dealer will make its play and the winner will be announced.
        <br></br>
        </p>
        <button onclick="backToGame()">Back to Game</button>
    </div>

    <div id ="quit">
        <button onclick="quit()" style="position:absolute; top:620px; left:0px; ">Quit</button>
		
		<button onclick="helpMenu()"style="position:absolute; top:620px; left: 85px;">Help</button>

        <div id="subMenu" style="display:none; position:absolute; top:600px; left:0px;">
            <p style="color:white; text-align:center;">Would you like to quit?</p>
            <a href="index.php"><button onclick="yes()">Yes</button></a>
            <button onclick="no()">No</button>
        </div>
    </div>

    </div>

</body>

<footer>

    <div id="fbox1">SOCIAL
    </div>

    <a href="https://instagram.com/officialbicyclecards/"><img class="imgIcons" src="images/instagramicon.png"></a>
    <a href="https://www.facebook.com/bicyclecards"><img class="imgIcons" src="images/facebook.png"></a>
    <a href="https://twitter.com/bicyclecards?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><img  class="imgIcons" src="images/twittericon.png"></a>
    <a  href="https://twitter.com/bicyclecards?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" /><img  class="imgIcons" src="images/youtubeicon.png"></a>


</footer>


<script>

function helpMenu(){
	document.getElementById("game").style.display = "none";
	document.getElementById("help").style.display = "initial";
}

function backToGame(){
	document.getElementById("game").style.display = "initial";
	document.getElementById("help").style.display = "none";
}

function quit(){
    document.getElementById("subMenu").style.display = "initial";
}

function no(){
    document.getElementById("quit").style.display = "initial";
    document.getElementById("subMenu").style.display = "none";

}

function yes(){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
			//document.getElementById("demo").innerHTML = xhttp.responseText;
			}
		}	
		xhttp.open("GET", "subPoints.php", true);
		xhttp.send();
}	
var deck2 = [];

function populate(){
	//Adding Spades
	var spadesA = {value:1,suit:"spades",name:"A",link:"Aspades"};
	deck2.push(spadesA);
	var spades2 = {value:2,suit:"spades",name:"2",link:"2spades"};
	deck2.push(spades2);
	var spades3 = {value:3,suit:"spades",name:"3",link:"3spades"};
	deck2.push(spades3);
	var spades4 = {value:4,suit:"spades",name:"4",link:"4spades"};
	deck2.push(spades4);
	var spades5 = {value:5,suit:"spades",name:"5",link:"5spades"};
	deck2.push(spades5);
	var spades6 = {value:6,suit:"spades",name:"6",link:"6spades"};
	deck2.push(spades6);
	var spades7 = {value:7,suit:"spades",name:"7",link:"7spades"};
	deck2.push(spades7);
	var spades8 = {value:8,suit:"spades",name:"8",link:"8spades"};
	deck2.push(spades8);
	var spades9 = {value:9,suit:"spades",name:"9",link:"9spades"};
	deck2.push(spades9);
	var spades10 = {value:10,suit:"spades",name:"10",link:"10spades"};
	deck2.push(spades10);
	var spadesJ = {value:11,suit:"spades",name:"J",link:"Jspades"};
	deck2.push(spadesJ);
	var spadesQ = {value:12,suit:"spades",name:"Q",link:"Qspades"};
	deck2.push(spadesQ);
	var spadesK = {value:13,suit:"spades",name:"K",link:"Kspades"};
	deck2.push(spadesK);

	//Adding Clubs
	var clubsA = {value:1,suit:"clubs",name:"A",link:"Aclubs"};
	deck2.push(clubsA);
	var clubs2 = {value:2,suit:"clubs",name:"2",link:"2clubs"};
	deck2.push(clubs2);
	var clubs3 = {value:3,suit:"clubs",name:"3",link:"3clubs"};
	deck2.push(clubs3);
	var clubs4 = {value:4,suit:"clubs",name:"4",link:"4clubs"};
	deck2.push(clubs4);
	var clubs5 = {value:5,suit:"clubs",name:"5",link:"5clubs"};
	deck2.push(clubs5);
	var clubs6 = {value:6,suit:"clubs",name:"6",link:"6clubs"};
	deck2.push(clubs6);
	var clubs7 = {value:7,suit:"clubs",name:"7",link:"7clubs"};
	deck2.push(clubs7);
	var clubs8 = {value:8,suit:"clubs",name:"8",link:"8clubs"};
	deck2.push(clubs8);
	var clubs9 = {value:9,suit:"clubs",name:"9",link:"9clubs"};
	deck2.push(clubs9);
	var clubs10 = {value:10,suit:"clubs",name:"10",link:"10clubs"};
	deck2.push(clubs10);
	var clubsJ = {value:11,suit:"clubs",name:"J",link:"Jclubs"};
	deck2.push(clubsJ);
	var clubsQ = {value:12,suit:"clubs",name:"Q",link:"Qclubs"};
	deck2.push(clubsQ)
	var clubsK = {value:13,suit:"clubs",name:"K",link:"Kclubs"};
	deck2.push(clubsK);

	//Adding Diamonds
	var diamondA = {value:1,suit:"diamond",name:"A",link:"Adiamonds"};
	deck2.push(diamondA);
	var diamond2 = {value:2,suit:"diamond",name:"2",link:"2diamonds"};
	deck2.push(diamond2);
	var diamond3 = {value:3,suit:"diamond",name:"3",link:"3diamonds"};
	deck2.push(diamond3);
	var diamond4 = {value:4,suit:"diamond",name:"4",link:"4diamonds"};
	deck2.push(diamond4);
	var diamond5 = {value:5,suit:"diamond",name:"5",link:"5diamonds"};
	deck2.push(diamond5);
	var diamond6 = {value:6,suit:"diamond",name:"6",link:"6diamonds"};
	deck2.push(diamond6);
	var diamond7 = {value:7,suit:"diamond",name:"7",link:"7diamonds"};
	deck2.push(diamond7);
	var diamond8 = {value:8,suit:"diamond",name:"8",link:"8diamonds"};
	deck2.push(diamond8);
	var diamond9 = {value:9,suit:"diamond",name:"9",link:"9diamonds"};
	deck2.push(diamond9);
	var diamond10 = {value:10,suit:"diamond",name:"10",link:"10diamonds"};
	deck2.push(diamond10);
	var diamondJ = {value:11,suit:"diamond",name:"J",link:"Jdiamonds"};
	deck2.push(diamondJ);
	var diamondQ = {value:12,suit:"diamond",name:"Q",link:"Qdiamonds"};
	deck2.push(diamondQ);
	var diamondK = {value:13,suit:"diamond",name:"K",link:"Kdiamonds"};
	deck2.push(diamondK);

	//Adding Hearts
	var heartsA = {value:1,suit:"hearts",name:"A",link:"Ahearts"};
	deck2.push(heartsA);
	var hearts2 = {value:2,suit:"hearts",name:"2",link:"2hearts"};
	deck2.push(hearts2);
	var hearts3 = {value:3,suit:"hearts",name:"3",link:"3hearts"};
	deck2.push(hearts3);
	var hearts4 = {value:4,suit:"hearts",name:"4",link:"4hearts"};
	deck2.push(hearts4);
	var hearts5 = {value:5,suit:"hearts",name:"5",link:"5hearts"};
	deck2.push(hearts5);
	var hearts6 = {value:6,suit:"hearts",name:"6",link:"6hearts"};
	deck2.push(hearts6);
	var hearts7 = {value:7,suit:"hearts",name:"7",link:"7hearts"};
	deck2.push(hearts7);
	var hearts8 = {value:8,suit:"hearts",name:"8",link:"8hearts"};
	deck2.push(hearts8);
	var hearts9 = {value:9,suit:"hearts",name:"9",link:"9hearts"};
	deck2.push(hearts9);
	var hearts10 = {value:10,suit:"hearts",name:"10",link:"10hearts"};
	deck2.push(hearts10);
	var heartsJ = {value:11,suit:"hearts",name:"J",link:"Jhearts"};
	deck2.push(heartsJ);
	var heartsQ = {value:12,suit:"hearts",name:"Q",link:"Qhearts"};
	deck2.push(heartsQ);
	var heartsK = {value:13,suit:"hearts",name:"K",link:"Khearts"};
	deck2.push(heartsK);

}


var playCards = [];
var dealCards = [];


function hitMe (){

	var check = document.getElementById("result").innerHTML;
	if ((check.toString() != "You win!") && (check.toString() != "You lose.")){
	
		var addEle = deck2[Math.floor((Math.random() * (deck2.length-1)) + 1)]; // random card draw?
		var index = deck2.indexOf(addEle); // check index to delete from deck
		deck2.splice(index,1 ); // delete card from deck
		playCards.push(addEle); //add card to dealer
		document.getElementById("playerCards").innerHTML += "<img src='images/" + playCards[playCards.length - 1].link + ".png' height = '150' width = '115' >";	// display card
		var value = burst(playCards);
		if (value > 21){
			document.getElementById("result").innerHTML = "You lose.";
			var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
			//document.getElementById("demo").innerHTML = xhttp.responseText;
			}
		}	
		xhttp.open("GET", "subPoints.php", true);
		xhttp.send();

		}
	}

}
function stop(){
		if (document.getElementById("result").innerHTML !="You lose."){
		if (document.getElementById("result").innerHTML !="You win!"){
			dealerPlay();}
	}
}

function startGame(){
	populate();
	document.getElementById("result").innerHTML="";
	playCards = [];
	dealCards = [];
	document.getElementById("stand").disabled = false;
	document.getElementById("hit").disabled = false;
	document.getElementById("dealerCards").innerHTML = "";
	document.getElementById("playerCards").innerHTML = "";
	if (playCards.length == 0){
		var addEle = deck2[Math.floor((Math.random() * (deck2.length-1)) + 1)] // random card draw?
		var index = deck2.indexOf(addEle); // check index to delete from deck
		deck2.splice(index,1); // delete card from deck
		dealCards.push(addEle); //add card to dealer
		addEle = deck2[Math.floor((Math.random() * (deck2.length-1)) + 1)]
		index = deck2.indexOf(addEle);
		deck2.splice(index,1);
		dealCards.push(addEle);
//		document.getElementById("result").innerHTML = burst(dealCards);
		document.getElementById("dealerCards").innerHTML += "<img src='images/back.png' height='150' width = '115'>";
		document.getElementById("dealerCards").innerHTML += "<img src='images/" + dealCards[1].link + ".png' height = '150' width = '115' >";	// display card	
		// for (var i = 0 ; i < dealCards.length; i++){
			//document.getElementById("dealerCards").innerHTML += "<img src='images/" + dealCards[i].link + ".png' height = '100' width = '85' >";	// display card

		//} 
		addEle = deck2[Math.floor((Math.random() * (deck2.length-1)) + 1)] // random card draw?
		index = deck2.indexOf(addEle); // check index to delete from deck
		deck2.splice(index,1); // delete card from deck
		playCards.push(addEle); // add card to player
		addEle = deck2[Math.floor((Math.random() * (deck2.length-1)) + 1)]
		index = deck2.indexOf(addEle);
		deck2.splice(index,1);
		playCards.push(addEle);
        document.getElementById("result").innerHTML = "Count: " + burst(playCards);

				
		for (var i = 0 ; i < playCards.length; i++){
			document.getElementById("playerCards").innerHTML += "<img src='images/" + playCards[i].link + ".png' height = '150' width = '115' >";	// display card

		}
	}
}

function burst (arr){
//document.getElementById("result").innerHTML = arr.length;

	var value = 0;
	for (var i = 0 ; i <arr.length ; i++){
		
		if (arr[i].value > 10){
		value +=10;
		}
		else if (arr.length == 2 && arr[i].value == 1){
		value += 11;
		}
		else {
		value += arr[i].value;
		}
	
	}
	document.getElementById("result").innerHTML = "Count: " + value;
	return (value);
}


function dealerPlay(){
	var dealValue = burst(dealCards);
	var playValue = burst(playCards);
	document.getElementById("dealerCards").innerHTML = "";
	for (var i = 0 ; i < 2; i++){
			document.getElementById("dealerCards").innerHTML += "<img src='images/" + dealCards[i].link + ".png' height = '150' width = '115' >";	// display card

		} 
	while ((dealValue < 21) && (dealValue < playValue)){
		//dealValue = burst(dealCards);
		var addEle = deck2[Math.floor((Math.random() * (deck2.length-1)) + 1)] // random card draw?
		var index = deck2.indexOf(addEle); // check index to delete from deck
		deck2.splice(index,1 ); // delete card from deck
		dealCards.push(addEle); //add card to dealer
		document.getElementById("dealerCards").innerHTML += "<img src='images/" + dealCards[dealCards.length - 1].link + ".png' height = '150' width = '115' >";	// display card
		dealValue = burst(dealCards);
	}
	
	if ((dealValue <=21) && (dealValue >= playValue)){
		document.getElementById("result").innerHTML = "You lose.";
		
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
			//document.getElementById("demo").innerHTML = xhttp.responseText;
			}
		}	
		xhttp.open("GET", "subPoints.php", true);
		xhttp.send();

		
	}
	else{
		document.getElementById("result").innerHTML = "You win!";
		
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
			//document.getElementById("demo").innerHTML = xhttp.responseText;
			}
		}	
			xhttp.open("GET", "addPoints.php", true);
			xhttp.send();
			
		}
	
	

}

</script>







