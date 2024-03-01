
package Quiz1_AyP4;

import java.util.Stack;

public class ListG {
    private Node head;
    private int length;
    public ListG next = null;

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
        Stack stack = new Stack();// Se trata de una pila para las listas de ListG generales
        for (int i = 0; i < list.length(); i++) {
            switch (list.charAt(i)) {
                case ',':
                    break;
                case '(':
                    ListG newList = new ListG();
                    newList.insertListG(list.substring(i + 1, list.length()));// La función substring(i + 1,
                                                                              // list.length()) entrega el resto de la
                                                                              // cadena donde va el parentesis
                    stack.push(newList);

                    currentList.insertInList(stack.peek().getHead()); // Inserta la cabeza de la nueva lista en la lista
                                                                      // actual
                    i += newList.getLength(); // Avanza el índice para omitir la sublista procesada y el paréntesis
                                              // de cierre
                    break;
                case ')':
                    stack.pop();
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
}
