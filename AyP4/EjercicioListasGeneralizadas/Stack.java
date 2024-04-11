package EjercicioListasGeneralizadas;

public class Stack {
    private Lista top;

    public Stack() {

    }

    public Lista getTop() {
        return top;
    }

    public void setTop(Lista top) {
        this.top = top;
    }

    public boolean isEmpty() {
        if (top == null) {
            return true;
        } else {
            return false;
        }
    }

    public void push(Lista newList) {
        if (top == null) {
            top = newList;
        } else {
            newList.next = top;
            top = newList;
        }
    }

    public void pop() {
        if (top == null) {
        } else {
            top = top.next;
        }
    }

    public Lista peek() {
        // System.out.println(top.getHead());
        return top;
    }
}
