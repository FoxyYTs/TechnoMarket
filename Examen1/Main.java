package Examen1;

public class Main {
    public static void main(String[] args) {
        ListaG list = new ListaG();
        ListaG list2 = new ListaG();
        list2.head = null;

        list.insertarListaG(("(a,(b,c),(x),d)"));
        list.recListG();

        if (list2.head == null){
            System.out.println();
            System.out.println("esta lista esta vacia");
        }

        list2.head = list.head;

        if (list2.head == null){
            System.out.println("esta lista esta vacia");
        }

        list2.recListG();
    }
}
