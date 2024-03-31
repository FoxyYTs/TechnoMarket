
package Quiz1_AyP4;

public class Pila {
    private ListG top;

    public Pila() {
    }

    public ListG getTop() {
        return top;
    }

    public void setTop(ListG top) {
        this.top = top;
    }

    public boolean isEmpty() {
        return top == null;
    }

    public void push(ListG list) {
        if (top == null) {
            top = list;
        } else {
            list.setNext(top);
            top = list;
        }
    }

    public ListG pop() {
        if(isEmpty()){
            throw new NoSuchElementException("La pila está vacía.");
        }
        ListG aux = top;
        if (top.getNext() == null) {
            top=null;
        } else {
            top = top.getNext();
        }
        return aux;
    }

    public ListG peek() {
        return top;
    }

}