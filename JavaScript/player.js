//player class
function Player (name, cards) {

	//private member variables
	var playerName = name; 
	var hand = cards;
	var sizeOfDeck = hand.length;
	
	//public method: returns the card at that pos or null if pos is invalid
	this.discardCard = function(pos) {
		if (pos < 0 || pos >= sizeOfDeck)
			return null
		var temp = hand[pos];
		sizeOfDeck--;
		for (var i = pos; i < sizeOfDeck; i++) {
			hand[i] = hand[i+1];
		}
	};
	
	//public method: adds a card to hand
	this.addCard = function(newCard) {
		hand[sizeOfDeck] = newCard;
		sizeOfDeck++;
	};
	
	//public method: returns the name
	this.getName = function() {
		return playerName;
	};
	
	//public method: prints the cards currently holding
	this.printHand = function() {
		for(var i = 0; i < sizeOfDeck; i++)
			console.log(hand[i].toString());	 
		console.log("Hand size is " + sizeOfDeck);
	};
}
