
package Quiz1_AyP4;

import java.util.Scanner;

public class ListG {
    Scanner sc = new Scanner(System.in);
    private Node head = null;
    private int length;
    public ListG next = null;

    public ListG() {

    }

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
        Node x = new Node();
        head = x;
        Node pointer = x;
        ListG currentList = new ListG();// Se trata de la ListG inicial, actual en recorrido
        Pila stack = new Pila();// Se trata de una pila para las listas de ListG generales
        for (int i = 0; i < list.length(); i++) {
            switch (list.charAt(i)) {
                case ',':
                    x = new Node();
                    pointer.next = x;
                    pointer = x;
                    if (stack.peek() == null) {
                        pointer.setHead(head);
                    } else {
                        pointer.setHead(stack.peek());
                    }
                    break;
                case '(':
                    stack.push(pointer);
                    x = new Node();
                    pointer.setTag(1);
                    pointer.setsubList(x);
                    pointer = x;
                    break;
                case ')':
                    pointer = stack.pop();
                    break;
                default:
                    Node newNode = new Node();
                    if (Character.isUpperCase(list.charAt(i))) {
                        ListG nueva = new ListG();
                        String lista = null;
                        do {
                            System.out.println(
                                    "Insertar una lista, cadena de datos que corresponde a la lista " + list.charAt(i));
                            lista = sc.nextLine();
                            if (nueva.inspect(lista)) {
                                nueva.insertListG(lista);
                            } else {
                                System.out.println("No se puede insertar la lista, revise nuevamente la cadena");
                            }
                        } while (nueva.inspect(lista) == false);
                        newNode.setTag(1);
                        newNode.setDato(list.charAt(i));
                        currentList.insertInList(newNode);
                    } else {
                        System.out.println(list.charAt(i));
                        newNode.setTag(0);
                        newNode.setDato(list.charAt(i));
                        currentList.insertInList(newNode);
                    }
                    break;
            }

        }
    }

    public void printList() {
        Node pointer = head;
        while (pointer != null) {
            if (Character.isUpperCase(pointer.getDato())) {
                pointer = pointer.getHead();
                while (pointer != null) {
                    System.out.print(pointer.getTag() + " | " + pointer.getDato() + ", ");
                    pointer = pointer.next;
                }
            } else if (pointer.getsubList() != null) {
                pointer = pointer.getsubList();
                while (pointer != null) {
                    System.out.print(pointer.getTag() + " | " + pointer.getDato() + ", ");
                    pointer = pointer.next;
                }
            } else {
                System.out.print(pointer.getTag() + " | " + pointer.getDato() + ", ");
            }
            pointer = pointer.next;
        }
    }
}
