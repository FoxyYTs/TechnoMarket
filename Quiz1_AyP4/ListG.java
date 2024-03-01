
package Quiz1_AyP4;

import java.util.Stack;

public class ListG {
    private Node head = null;
    private int length;
    private ListG next = null;

    public Node getHead() {
        return head;
    }

    public void setHead(Node head) {
        this.head = head;
    }

    public int getLength() {
        Node pointer = head;
        while (pointer != null) {
            length++;
            pointer = pointer.next;
        }
        return length;
    }

    public void setLength(int length) {
        this.length = length;
    }

    public ListG getNext() {
        return next;
    }

    public void setNext(ListG next) {
        this.next = next;
    }

    public boolean inspect(String list) {
        int j = 0, k = 0;
        for (int i = 0; i < list.length(); i++) {
            if (list.charAt(i) == '(') {
                j++;
            } else if (list.charAt(i) == ')') {
                k++;
            }
        }
        if (j == k) {
            return true;
        } else {
            return false;
        }
    }

    public void insertInList(Node dato) {
        Node pointer = head;
        if (head == null) {
            head = dato;
        } else {
            while (pointer.next != null) {
                pointer = pointer.next;
            }
            pointer.next = dato;
        }
    }

    public void insertListG(String list) {
        head = null;
        ListG currentList = new ListG();// Se trata de la ListG inicial, actual en recorrido

        Stack<ListG> stack = new Stack<>();// Se trata de una pila para las listas de ListG generales
        for (int i = 0; i < list.length(); i++) {
            switch (list.charAt(i)) {
                case ',':
                    break;
                case '(':
                boolean isEmty=stack.peek()!=null;                   ListG newList = new ListG();
                    newList.insertListG(list.substring(i + 1)); // Construye la nueva lista recursivamente
                    stack.push(newList); // Apila la nueva lista
                    if (!newList.isEmpty()) {
                        currentList.insertInList(newList.getHead()); // Inserta la cabeza de la nueva lista en la lista
                                                                     // actual
                    }
                    i += newList.getLength() + 1; // Avanza el índice para omitir la sublista procesada y el paréntesis
                    break;
                case ')':
                    if (!stack.isEmpty()) {
                        ListG subList = stack.pop(); // Desapila la lista superior
                        if (!subList.isEmpty()) {
                            currentList.insertInList(subList.getHead()); // Inserta la cabeza de la lista superior en la
                                                                         // lista actual
                        }
                    }
                    break;
                default:
                    Node newNode = new Node();
                    newNode.setTag(0);
                    newNode.setDato(list.charAt(i));
                    currentList.insertInList(newNode);
                    break;
            }

        }
    }

    public void printList() {
        Node pointer = head;
        while (pointer != null) {
            System.out.print(pointer.getTag() + " | " + pointer.getDato() + ", ");
            pointer = pointer.next;
        }
    }
}
