import java.util.ArrayList;


public class Driver {
	static Deck testDeck;
	
	public static void main (String args[]) {
		 
		testDeck = new Deck();
		
		ArrayList<Card> test = new ArrayList<Card>();
		for (int i = 0; i < 8;) {//add cards to array list, checks if card is valid or not
			Card temp = testDeck.drawCard();
			if (cardIsValid(temp)) {
				test.add(temp);
				i++;
			}
		}
		Player first = new Player("Michael", test);
		
		first.printHand();
		first.discardCard(0);
		//first.printHand();
		
	}
	
	
	//tests if card drawn is valid for use in game conquian
	public static boolean cardIsValid(Card testCard) {
		if (testCard.getValue() <= 10 && testCard.getValue() >= 8)
			return false;
		return true;
	}
	
}
