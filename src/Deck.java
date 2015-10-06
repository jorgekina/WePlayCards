import java.util.Random;


public class Deck {
	
	private final int SIZE_OF_DECK = 52;
	private Card cardList[];
	private int size;
	
	public Deck() {
		
		cardList = new Card[SIZE_OF_DECK];
		size = SIZE_OF_DECK - 1;
	
		
		int counter = 0;
		for (int i = 1; i < 5; i++) 
			for (int j = 1; j < 14; j++) {
				cardList[counter] = new Card(i, j);
				counter++;
			}
		
		for (int i = 0; i < 52; i++) {
			
			Random randInt = new Random();
			int swapLoc = randInt.nextInt(52);
			Card temp = cardList[i];
			cardList[i] = cardList[swapLoc];
			cardList[swapLoc] = temp;
		}
		
	}
	
	//draws a card, throws null if no more cards
	public Card drawCard() {
		if (size < 0)
			return null;
		Card temp = cardList[size];
		size--;
		return temp;
	}
	
	//returns deck size
	public int getDeckSize() {
		if (size < 0)
			return 0;
		return size + 1;
	}
	
	//prints the deck
	public void printDeck() {
		for (int i = 0; i < SIZE_OF_DECK; i++)
			System.out.println(cardList[i].toString());
	}
	
	public boolean isEmpty() {
		return (size < 0);
	}
	
}
