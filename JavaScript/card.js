function Card (suit, value) {
	
	//private method: to set the suit for the card
	var setSuit = function(num) {
		if (num >= 1 && num <= 4)
			return num;
		console.log(num + " is not a proper suit");
	};
	
	//private method: to set the value of the card
	var setValue = function(num) {
		if (num >= 1 && num <= 13)
			return num;
		console.log(num + " is not a proper value");
	};
	
	//private member variables
	var suit = setSuit(suit);
	var value = setValue(value);
	
	//public method: returns the value
	this.getValue = function() {
		return value;
	};
	
	//public method: returns the suit
	this.getSuit = function() {
		return suit;
	};
	
	//public method: returns a string representing the card
	this.toString = function() {
		var message;
		if (suit === 1)
			message = "Hearts";
		else if (suit === 2)
			message = "Spades";
		else if (suit === 3)
			message = "Clubs";
		else
			message = "Diamonds";
		
		message += " of " + value;
		return message;
	};
}