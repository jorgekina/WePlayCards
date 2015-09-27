
public class Card {
	
	private final int MAX_CARD_VALUE = 13;
	private final int MAX_CARD_SUIT = 4;
	
	private int suit;
	private int value;
	
	//default constructor
	public Card() {
		suit = 0;
		value = 0;
		//invalid values
	}
	
	//takes a suit and value
	public Card(int x, int y) {
		setSuit(x);
		setValue(y);
	}
	
	//sets card value to v
	private void setValue(int v) {
		if (v >= 1 && v <= MAX_CARD_VALUE)
			value = v;
		else
			throw new UnsupportedOperationException("Not a valid value");
	}
	
	//sets card suit to s
	private void setSuit(int s) {
		if (s >=1 && s <= MAX_CARD_SUIT)
			suit = s;
		else
			throw new UnsupportedOperationException("Not a valid suit");
	}
	
	//returns the card value
	public int getValue() {
		return value;
	}
	
	//returns the suit of the card in int form
	public int getSuit() {
		return suit;
	}
	
	public String toString() {
		String cardText;
		if (suit == 1)
			cardText = "Hearts";
		else if (suit == 2)
			cardText = "Spades";
		else if (suit == 3)
			cardText = "Clubs";
		else
			cardText = "Diamonds";
		
		cardText += " of " + value;
			
		return cardText;
	}
}
