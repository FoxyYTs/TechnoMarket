package EjercicioPolinomio;

public class ListaPolinomio {
    private Nodo head;

    public ListaPolinomio() {

    }

    public Nodo getHead() {
        return head;
    }

    public void setHead(Nodo head) {
        this.head = head;
    }

    public void insertInList(Nodo dato) {
        Nodo pointer = head;
        if (head == null) {
            head = dato;
        } else {

            while (pointer.next != null) {
                pointer = pointer.next;
            }
            pointer.next = dato;
        }
    }

    public void expandLG(ListaPolinomio list) {
        Nodo pointer = list.getHead();
        while (pointer != null) {
            insertInList(pointer);
        }
    }
}
