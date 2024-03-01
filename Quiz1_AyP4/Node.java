
package Quiz1_AyP4;

public class Node {
    private int tag;
    private char dato;
    public Node next;

    public Node() {
        
    }
    public Node(int tag, char dato) {
        this.tag = tag;
        this.dato = dato;
        this.next = null;
    }
    public int getTag() {
        return tag;
    }
    public void setTag(int tag) {
        this.tag = tag;
    }
    public char getDato() {
        return dato;
    }
    public void setDato(char dato) {
        this.dato = dato;
    }
}
