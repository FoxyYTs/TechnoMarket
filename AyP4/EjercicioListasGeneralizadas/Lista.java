package EjercicioListasGeneralizadas;

import org.w3c.dom.Node;
import org.w3c.dom.Nodo;

public class Lista {
    private Nodo head;
    public Lista next;

    public Lista() {

    }

    public Nodo getHead() {
        return head;
    }

    public void setHead(Nodo head) {
        this.head = head;
    }
    public int getLength(){
        Nodo pointer=head;
        int i=0;
        while(pointer!=null){
            i++;
            pointer=pointer.next;
        }
        return i;
    }

    public boolean inspect(String lista) {
        int j = 0, k = 0;
        for (int i = 0; i < lista.length(); i++) {
            if (lista.charAt(i) == '(') {
                j++;
            } else if (lista.charAt(i) == ')') {
                k++;
            }
        }
        if (j == k) {
            return true;
        } else {
            return false;
        }
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
        Nodo pointer = head;
        while (pointer != null) {
            System.out.print(pointer.getTag() + " | " + pointer.getDato() + ", ");
            pointer = pointer.next;
        }
    }
/*
    public void insertLista(String list) {
        head=null;
        Lista currentList = new Lista();// Se trata de la lista inicial, actual en recorrido
        Stack stack = new Stack();// Se trata de una Stack para las listas generales
        for (int i = 0; i < list.length(); i++) {
            switch (list.charAt(i)) {
                case ',':
                    break;
                case '(':
                    Lista newList = new Lista();
                    newList.insertListG(list.substring(i + 1, list.length()));// La función substring(i + 1,
                                                                              // list.length()) entrega el resto de la
                                                                              // cadena donde va el parentesis
                    stack.push(newList);

                    currentList.insertInList(stack.peek().getHead()); // Inserta la cabeza de la nueva lista en la lista
                                                                      // actual
                    i += newList.getLength(); // Avanza el índice para omitir la sublista procesada y el paréntesis
                                                  // de cierre
                    currentList = newList;
                    break;
                case ')':
                    stack.pop();
                    break;
                default:
                    Nodo newNode = new Nodo();
                    newNode.setTag(0);
                    newNode.setDato(list.charAt(i));
                    currentList.insertInList(newNode);
                    break;
            }

        }
    }

    public void printList() {
        Nodo pointer = head;
        while (pointer != null) {
            System.out.print(pointer.getTag() + " | " + pointer.getDato() + ", ");
            pointer = pointer.next;
        }
    }*/
}
