
package Quiz1_AyP4;

public class Node {
    private int tag;
    private char dato;
    private Node subList;
    public Node next;
    private Node head;

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
    public Node getHead() {
        return head;
    }

    public void setHead(Node head) {
        this.head = head;
    }
    public Node getsubList() {
        return subList;
    }
    public void setsubList(Node subList) {
        this.subList = subList;
    }
}
