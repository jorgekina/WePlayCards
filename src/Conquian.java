import java.util.ArrayList;
import java.util.Scanner;


public class Conquian {
	static Deck playingDeck;
	
	public static void main (String args[]) {
		//creating deck
		playingDeck = new Deck();
		
		ArrayList<Card> hand1 = new ArrayList<Card>();
		for (int i = 0; i < 8;) {//add cards to array list, checks if card is valid or not
			Card temp = playingDeck.drawCard();
			if (cardIsValid(temp)) {
				hand1.add(temp);
				i++;
			}
		}
		
		ArrayList<Card> hand2 = new ArrayList<Card>();
		for (int i = 0; i < 8;) {//add cards to array list, checks if card is valid or not
			Card temp = playingDeck.drawCard();
			if (cardIsValid(temp)) {
				hand2.add(temp);
				i++;
			}
		}
		//creating players
		Player first = new Player("Michael", hand1);
		//the list holds the cards that player has played
		ArrayList<ArrayList<Card>> fPlayerCombos = new ArrayList<ArrayList<Card>>();
		
		Player second = new Player("Munoz", hand2);
		//the list holds the cards that player has played
		ArrayList<ArrayList<Card>> sPlayerCombos = new ArrayList<ArrayList<Card>>();
		Pair returnedValues = null;
		int counter = 0;
		int whosTurn = 1;//this will be chosen by a random generator from 0 to 1
		Card drawn = null;
		
		Scanner discardInput = new Scanner(System.in);
		int pos;
		//players exhange one card
		printGame(first, fPlayerCombos, second, sPlayerCombos, drawn);
		System.out.println("Press 0 - " + (first.getHandSize() - 1) + " to discard the card and give it to " + second.getName());
		do {//loop until valid input
			pos = discardInput.nextInt();
		} while(pos < 0 || pos >= first.getHandSize());
		Card discardCard1 = first.discardCard(pos);
		
		printGame(second, sPlayerCombos, first, fPlayerCombos, drawn);
		System.out.println("Press 0 - " + (second.getHandSize() - 1) + " to discard the card and give it to " + first.getName());
		do {//loop until valid input
			pos = discardInput.nextInt();
		} while(pos < 0 || pos >= second.getHandSize());
		Card discardCard2 = second.discardCard(pos);
		
		//add cards to the players now
		first.addCard(discardCard2);
		second.addCard(discardCard1);
		
		
		while(!playingDeck.isEmpty() && first.getHandSize() > 0 && second.getHandSize() > 0) {	
			
			if (whosTurn == 1)
				printGame(first, fPlayerCombos, second, sPlayerCombos, drawn);
			else
				printGame(second, sPlayerCombos, first, fPlayerCombos, drawn);
		
			//0) draw a card and have a turn
			if (counter == 0) {
				//draws a card
				do {
					drawn = playingDeck.drawCard();
				} while (!cardIsValid(drawn) && drawn != null);
				
				//if drawn is null, there are no more cards on the deck
				if (drawn != null) {
					//check whos turn it is and take turn
					if (whosTurn == 1) {
						System.out.println("\n" + first.getName() + "'s turn");
						returnedValues = makeMove(first, drawn, fPlayerCombos);
						drawn = returnedValues.changedCard();
						counter = 1;
						whosTurn = 0;
					}
					else {
						System.out.println("\n" + second.getName() + "'s turn");
						returnedValues = makeMove(second, drawn, sPlayerCombos);
						drawn = returnedValues.changedCard();
						counter = 1;
						whosTurn = 1;
					}
				}
			}
			//1) have a turn without drawing a card
			else if (counter == 1) {
				if(whosTurn == 1) {
					System.out.println("\n" + first.getName() + "'s turn");
					returnedValues = makeMove(first,drawn, fPlayerCombos);
					if (returnedValues.isCardChanged()) //card was changed so other player now doesnt draw
						whosTurn = 0;
					else//card not changed so this player draws and has a turn
						counter = 0;
					drawn = returnedValues.changedCard();
				}
				else {
					System.out.println("\n" + second.getName() + "'s turn");
					returnedValues = makeMove(second, drawn, sPlayerCombos);
					if(returnedValues.isCardChanged())//card was changed so now other player doesnt card
						whosTurn = 1;
					else//card was not changed so this player draws and has a turn
						counter = 0;
					drawn = returnedValues.changedCard();
				}
			}
		}
		
		if (first.getHandSize() == 0)
			System.out.println(first.getName() + " has won!");
		else if (second.getHandSize() == 0)
			System.out.println(second.getName() + " has won!");
		else
			System.out.println("Both are losers!");
		
	}//end of main
	
	
	//tests if card drawn is valid for use in game conquian
	private static boolean cardIsValid(Card testCard) {
		if (testCard == null)
			return false;
		if (testCard.getValue() <= 10 && testCard.getValue() >= 8)
			return false;
		return true;
	}
	
	//prints the current state of the game from the users pov
	private static void printGame(Player user, ArrayList<ArrayList<Card>> usersCards, Player opponent, ArrayList<ArrayList<Card>> opponentsCards, Card currentCard) {
		for(int i = 0; i < opponent.getHandSize(); i++)
			System.out.print("? ");//questionmark is a card
		System.out.println("\n");
		
		for(int i = 0; i < opponentsCards.size(); i++) {
			for(int j = 0; j < opponentsCards.get(i).size(); j++)
				System.out.print(opponentsCards.get(i).get(j).toString() + " ");
			System.out.print("| ");
		}
		System.out.println("\n");
		
		if (currentCard != null)
			System.out.println(currentCard.toString() + "\n");
		
		for(int i = 0; i < usersCards.size(); i++) {
			for (int j = 0; j < usersCards.get(i).size(); j++)
				System.out.println(usersCards.get(i).get(j).toString() + " ");
			System.out.println("| ");
		}
		user.printHand();
	}
	
	//checks if the array of cards passed to it are valid or not
	private static boolean validMove(ArrayList<Card> move) {
		//a valid move has to be greater than 3
		if (move.size() < 3)
			return false;
		int counter = 0;
		//check if the cards are the same value
		int testValue = move.get(0).getValue();
		for (int i = 0; i < move.size(); i++)
			if (move.get(i).getValue() == testValue)
				counter++;
		//returned true since the cards all have the same value
		if (counter == move.size())
			return true;
		
		counter = 0;
		//check to see if its a ladder of the same suit > 3
		int testSuit = move.get(0).getSuit();
		for (int i = 0; i < move.size(); i++) {
			//first card can't test against anything
			if (i == 0)
				counter++;
			else {//if the suit match and the testvalue is less than the next card
				if(testSuit == move.get(i).getSuit() && testValue < move.get(i).getValue())
					if (move.get(i).getValue() == testValue + 1) {//if the cards are in accending order
						counter++;
					}
					else if (testValue == 7) {//since there is no 8 in the game, the next card has to be 11
						if (move.get(i).getValue() == 11)
							counter++;
					}
			}
			//saves the value from the card just used
			testValue = move.get(i).getValue();
		}	
		
		if (counter == move.size())
			return true;
		
		return false;
	}
	
	//returns based on if player changed the card that was drawn
	private static Pair makeMove(Player user, Card currentCard, ArrayList<ArrayList<Card>> cardContainer) {
		
		boolean cardPlayedIsUsed = false;
		Card oldCard = currentCard;
		ArrayList<Card> combo = new ArrayList<Card>();
		int userChoice;
		boolean valid;
		do {
			if (!cardPlayedIsUsed)//prints out the current card drawn if not in use or used
				System.out.println(currentCard.toString() + "\n");
			if (combo.size() > 0) {//prints out the current combo hand
				System.out.print("Current combo: ");
				for( int i = 0; i < combo.size(); i++)
				System.out.print(combo.get(i) + " ");
				System.out.println();
			}
			
			user.printHand();
			//if there are cards available then show option for them
			if (user.getHandSize() != 0)
				System.out.println("Press 0 - " + (user.getHandSize() - 1) + " to play a card");
			System.out.println("9 to use the card drawn\n10 to submit cards played\n11 to end turn");
			
			Scanner input = new Scanner(System.in);
			userChoice = input.nextInt();
			
			//user picked a card from their hand
			if (userChoice < user.getHandSize() && userChoice >= 0)  {
				if (user.getHandSize() != 0)//if cards are available, then access that pos in users hand, to avoid adding nulls
					combo.add(user.discardCard(userChoice));
			}
			else if (userChoice == 9) {//add card to cardsPlayed
				if (cardPlayedIsUsed)
					System.out.println("Cant use that card anymore");
				else {
					combo.add(currentCard);
					cardPlayedIsUsed = true;
				}
			}
			else if (userChoice == 10) {//submit it
				valid = validMove(combo);
				if (valid) {
					//add the new group into the container
					cardContainer.add(combo);
					combo = new ArrayList<Card>();
					if (cardPlayedIsUsed) {//since they used the card in the middle then they have to pay for it
						System.out.println("Discard a card");
						user.printHand();
						System.out.println("Press 0 - " + (user.getHandSize() - 1) + " to discard the card");
						
						do {//loop until valid input
							userChoice = input.nextInt();
						} while(userChoice < 0 || userChoice >= user.getHandSize());
						//currentCard = new Card(user.discardCard(userChoice));
						currentCard = user.discardCard(userChoice);//replace current card						
					}
								
				}
				else {
					System.out.println("That is not a valid play");
					//put cards back into users hand
					for (int i = 0; i < combo.size(); i++) {
						if (combo.get(i) == oldCard) {
							cardPlayedIsUsed = false;
						}
						else//putting the cards back into the users hand
							user.addCard(combo.get(i));
					}
					combo.clear();
				}
			}
			else if (userChoice == 11) {
				//if there are any cards that the user did not get back into their hand
				if (combo.size() > 0) {
					for (int i = 0; i < combo.size(); i++) {
						if (combo.get(i) == oldCard) {
							cardPlayedIsUsed = false;
						}
						else//putting the cards back into the users hand
							user.addCard(combo.get(i));
					}				
				}
			}
		} while (userChoice != 11);
		
		return new Pair(cardPlayedIsUsed, currentCard);
	}
	
}
