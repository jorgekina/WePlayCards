//pair class is created so that conquian game method can return two values instead of 1
public class Pair {
	
	private boolean cardIsChanged;
	private Card newValue;
	
	public Pair(boolean x, Card y) {
		cardIsChanged = x;
		newValue = y;
	}
	
	public boolean isCardChanged() {
		return cardIsChanged;
	}
	
	public Card changedCard() {
		return newValue;
	}
}
