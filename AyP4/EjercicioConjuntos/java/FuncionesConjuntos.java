package EjercicioConjuntos.java;

public class FuncionesConjuntos {
    private Nodo head = null;

    public FuncionesConjuntos() {

    }

    public Nodo getHead() {
        return head;
    }

    public void setHead(Nodo head) {
        this.head = head;
    }
    public void insertInList(int dato) {
        Nodo nuevo = new Nodo(dato);
        if (head == null) {
            head = nuevo;
        } else {
            Nodo pointer = head;
            while (pointer.getNext() != null) {
                pointer = pointer.getNext();
            }
            pointer.setNext(nuevo);
        }
    }

    public void orderList() {
        Nodo pointer = head;
        int temp = 0, dato = 0;
        while (pointer != null) {
            Nodo current = pointer.getNext();
            while (current != null) {
                if (pointer.getDato() > current.getDato()) {
                    // Intercambiar los datos de los nodos
                    temp = current.getDato();
                    dato = pointer.getDato();
                    pointer.setDato(temp);
                    current.setDato(dato);
                }
                current = current.getNext();
            }
            pointer = pointer.getNext();
        }
    }

    public boolean memberList(int dato) {
        boolean flag = false;
        Nodo pointer = head;
        while (pointer != null) {
            if (pointer.getDato() == dato) {
                flag = true;
            }
            pointer = pointer.getNext();
        }
        if (flag) {
            System.out.println("El elemento " + dato + " pertenece al conjunto\n");
        } else {
            System.out.println("El elemento " + dato + " no pertenece al conjunto\n");
        }
        return flag;
    }

    public FuncionesConjuntos intersectList(FuncionesConjuntos list, FuncionesConjuntos list2) {
        FuncionesConjuntos intersect = new FuncionesConjuntos();
        Nodo pointer1 = list.getHead();
        boolean flag = false;
        while (pointer1 != null) {
            Nodo pointer2 = list2.getHead();
            while (pointer2 != null) {
                if (pointer1.getDato() == pointer2.getDato()) {
                    flag = true;
                }
                pointer2 = pointer2.getNext();
            }

            if (flag) {
                intersect.insertInList(pointer1.getDato());
            }
            pointer1 = pointer1.getNext();
        }
        intersect.orderList();
        intersect.printList();
        return intersect;
    }

    public FuncionesConjuntos unionList(FuncionesConjuntos list, FuncionesConjuntos list2) {
        FuncionesConjuntos union = new FuncionesConjuntos();
        Nodo pointer1 = list.getHead();
        while (pointer1 != null) {
            union.insertInList(pointer1.getDato());
            pointer1 = pointer1.getNext();
        }
        Nodo pointerU = union.getHead();
        Nodo pointer2 = list2.getHead();
        while (pointer2 != null) {
            boolean flag = false;
            pointerU = union.getHead();
            while (pointerU != null) {
                if (pointerU.getDato() == pointer2.getDato()) {
                    flag = true;
                    break;
                }
                pointerU = pointerU.getNext();
            }
            if (flag == false) {
                union.insertInList(pointer2.getDato());
            }
            pointer2 = pointer2.getNext();
        }
        union.orderList();
        union.printList();
        return union;
    }

    public void symmetDifferenceList(FuncionesConjuntos list, FuncionesConjuntos list2) {
        FuncionesConjuntos symetric = new FuncionesConjuntos();
        FuncionesConjuntos c1 = new FuncionesConjuntos();
        FuncionesConjuntos c2 = new FuncionesConjuntos();
        c1=c1.differenceList(list, list2);
        c2=c2.differenceList(list2, list);
        symetric = symetric.unionList(c1, c2);
    }

    /*
     * public void containList(FuncionesConjuntos list, FuncionesConjuntos list2) {
     * Nodo pointer1 = list.getHead(),pointer2 = list2.getHead();
     * while (pointer1.getNext()!= null){
     * while(pointer2.getNext()!=null){
     * if(pointer1.getDato()==pointer2.getDato()){
     * intersect.insertInList(pointer1.getDato());
     * }
     * pointer2 = pointer2.getNext();
     * }
     * pointer1=pointer1.getNext();
     * }
     * }
     */
    public FuncionesConjuntos differenceList(FuncionesConjuntos list, FuncionesConjuntos list2) {
        FuncionesConjuntos difference = new FuncionesConjuntos();
        Nodo pointer1 = list.getHead(), pointer2 = list2.getHead();
        while (pointer1 != null) {
            boolean flag = false;
            pointer2 = list2.getHead();
            while (pointer2 != null) {
                if (pointer2.getDato() == pointer1.getDato()) {
                    flag = true;
                    break;
                }
                pointer2 = pointer2.getNext();
            }
            if (!flag) {
                difference.insertInList(pointer1.getDato());
            }
            pointer1 = pointer1.getNext();
        }
        difference.orderList();
        difference.printList();
        return difference;
    }

    public void printList() {
        Nodo pointer = head;
        System.out.print("{");
        while (pointer != null) {
            System.out.print(" " + pointer.getDato());
            pointer = pointer.getNext();
        }
        System.out.print(" }");
        System.out.println();
    }

}
