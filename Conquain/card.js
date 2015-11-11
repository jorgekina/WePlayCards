//card class
function Card (suit, value) {
	
	//private method: to set the suit for the card
	var setSuit = function(num) {
		if (num >= 1 && num <= 4)
			return num;
		console.log(num + " is not a proper suit");
	}
	
	//private method: to set the value of the card
	var setValue = function(num) {
		if (num >= 1 && num <= 12)
			return num;
		console.log(num + " is not a proper value");
	}
	
	//private method: to set the imageSource of the card
	var setImage = function(suit, value) {
		var imageSource = "Images/";
		if (suit === 1)
			imageSource += "baston";
		else if (suit === 2)
			imageSource += "copa";
		else if (suit === 3)
			imageSource += "espada";
		else
			imageSource += "oro";
		imageSource += value.toString() + ".jpeg";
		return imageSource;
	}
	
	//private member variables
	var suit = setSuit(suit);
	var value = setValue(value);
	var image = setImage(suit, value);
	
	//public method: returns the value
	this.getValue = function() {
		return value;
	}
	
	//public method: returns the suit
	this.getSuit = function() {
		return suit;
	}
	
	//public method: returns the image source
	this.getImageSource = function() {
		return image;
	}
	
	//public method: returns a string representing the card useful for debugging
	this.toString = function() {
		var message;
		if (suit === 1)
			message = "Baston";
		else if (suit === 2)
			message = "Copa";
		else if (suit === 3)
			message = "Espada";
		else
			message = "Oro";
		message += " of " + value;
		return message;
	}
}