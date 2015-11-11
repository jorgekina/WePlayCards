function Opponent (cardArray) {
	//variable that holds the opponents cards
	var currentHand = cardArray;
	
	
	//private function: sorts the cards in the array based on value
	var insertionSortByValue = function(arrayOfCards) {
		for (var i = 0; i < arrayOfCards.length; i++) {
			var temp = arrayOfCards[i];
			var j = i;
			while (j > 0 && temp.getValue() < arrayOfCards[j-1].getValue()) {
				arrayOfCards[j] = arrayOfCards[j-1];
				j--;
			}
			arrayOfCards[j] = temp;
		}
		return arrayOfCards;	
	}
	
	//private function: returns cards that do not form an ladder
	var discardValidLadder = function(container, cardArray) {
		var ladderHolder = new Array();
			//will find ladders and discard them since those are valuable cards that shouldnt be discarded
			for (var i = 0; i < cardArray.length; i++) {
	
				if (i == cardArray.length - 1) {//to ensure that you dont over limit of if statement
					ladderHolder.push(cardArray[i]);
					if (ladderHolder.length < 2)//Non ladder found save those cards
						for (var j = 0; j < ladderHolder.length; j++)
							container.push(ladderHolder[j]);
					ladderHolder = new Array();
				}
				else if (cardArray[i].getValue() + 1 == cardArray[i + 1].getValue()) {//if in increasing order than keep looking
					ladderHolder.push(cardArray[i]);
				}
				else if (cardArray[i].getValue() == 7)//special case since 8-9 are omitted
					if (cardArray[i + 1].getValue() == 10) {
						ladderHolder.push(cardArray[i]);
					}
					else {//not in increasing order going to look at other cards we have been holding
						ladderHolder.push(cardArray[i]);//the previous one would have worked   s
						if (ladderHolder.length < 2)//Non ladder found save those cards
							for (var j = 0; j < ladderHolder.length; j++)
								container.push(ladderHolder[j]);
						ladderHolder = new Array();
					}
				else {
					ladderHolder.push(cardArray[i]);
					if (ladderHolder.length < 2)//Non ladder found save those cards
						for (var j = 0; j < ladderHolder.length; j++)
							container.push(ladderHolder[j]);
					ladderHolder = new Array();
				}
			}
	}
	
	//public function returns the opponents deck
	this.getDeck = function() {
		return currentHand;
	}
	
	//public function adds a card to currentHand
	this.addCard = function(card) {
		currentHand.push(card);
	}
	
	//public function: discards a card that could not be part of a future valid play
	this.discardCard = function() {
		//copies the hand so the original one is untouched
		var container = currentHand.slice();
		//create 4 arrays each for the suit
		var oroArray = new Array();
		var bastonArray = new Array();
		var copaArray = new Array();
		var espadaArray = new Array();
		//now put the cards in each array
		while (container.length > 0) {
			var temp = container.pop();
			
			if (temp.getSuit() == 1)
				bastonArray.push(temp);
			else if (temp.getSuit() == 2)
				copaArray.push(temp);
			else if (temp.getSuit() == 3)
				espadaArray.push(temp);
			else if (temp.getSuit() == 4)
				oroArray.push(temp);
		}
		
		//sorting each array
		bastonArray = insertionSortByValue(bastonArray);
		copaArray = insertionSortByValue(copaArray);
		espadaArray = insertionSortByValue(espadaArray);
		oroArray = insertionSortByValue(oroArray);
		
		//check if the array is of length 3 or greater which is required for a ladder
		if (bastonArray.length >= 3)
			discardValidLadder(container, bastonArray);
		else //since its does not meet required length all cards are pushed into container
			for (var i = 0; i < bastonArray.length; i++)
				container.push(bastonArray[i]);
				
		if (copaArray.length >= 3)
			discardValidLadder(container, copaArray);	
		else //else pop them back into container
			for (var i = 0; i < copaArray.length; i++)
				container.push(copaArray[i]);
		
		if (espadaArray.length >= 3)
			discardValidLadder(container, espadaArray);
		else
			for (var i = 0; i < espadaArray.length; i++)
				container.push(espadaArray[i]);	
		
		if (oroArray.length >= 3)
			discardValidLadder(container, oroArray);
		else
			for (var i = 0; i < oroArray.length; i++)
				container.push(oroArray[i]);
				
		//now we sort those cards and see if we can discard the 3 of a kind, since we want to discard a non valuable card
		container = insertionSortByValue(container);
		var tempArray = new Array();
		var otherTempArray = new Array();
		for (var i = 0; i < container.length; i++) {
			
			if ( i == container.length - 1) {//case where its the last element
				tempArray.push(container[i]);
				if (tempArray.length < 2)//if less than 2 cards of the same value are found then then they are not a match and save them
					for (var j = 0; j < tempArray.length; j++)
						otherTempArray.push(tempArray[j]);
				tempArray = new Array();
			}
			//if the same value, add it
			else if (container[i].getValue() == container[i + 1].getValue())
				tempArray.push(container[i]);
			else {
				tempArray.push(container[i]);
				if (tempArray.length < 2)//if less than 2 cards of the same value are found then then they are not a match and save them
					for (var j = 0; j < tempArray.length; j++)
						otherTempArray.push(tempArray[j]);	
				//make a new array
				tempArray = new Array();	
			}
		}
		//put the cards back into container
		container = otherTempArray.slice();
		var cardToDiscard;
		
		//if all the cards are in a valid play then just select one at random
		if (container.length == 0)
			cardToDiscard = currentHand[Math.floor(Math.random() * currentHand.length)];
		else
			//these cards can not be made into a valid play so selecting one randomly to discard
			cardToDiscard = container[Math.floor(Math.random() * container.length)];
		//reflecting these changes to the currentHand
		tempArray = new Array();
		for (var i = 0; i < currentHand.length; i++)
			if (cardToDiscard.toString() != currentHand[i].toString())
				tempArray.push(currentHand[i]);
	
		currentHand = tempArray.slice();//removes the card that will be discarded
		
		return cardToDiscard;
	}
	
	this.getValidPlay = function(drawnCard) {
		
		
	}
}