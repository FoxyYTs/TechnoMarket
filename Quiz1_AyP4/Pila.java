
package Quiz1_AyP4;

public class Pila {
    private Node top;

    public Pila() {
    }

    public Node getTop() {
        return top;
    }

    public void setTop(Node top) {
        this.top = top;
    }

    public boolean isEmpty() {
        return top == null;
    }

    public void push(Node dato) {
        if (top == null) {
            top = dato;
        } else {
            dato.next = top;
            top = dato;
        }
    }

    public Node pop() {
        Node aux = top;
        if (top.next == null) {
            top=null;
        } else {
            aux = top;
            top = top.next;
        }
        return aux;
    }

    public Node peek() {
        return top.getHead();
    }

}