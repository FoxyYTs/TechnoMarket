package Examen1;

public class ListaG {
    public Nodo head;

    public ListaG() {
        head = null;
    }

    public void insertarListaG(String str) {
        Stack stack = new Stack();
        Nodo x = new Nodo(' ');
        head = x;
        Nodo ultimo = x;
        int n = str.length();
        for (int i = 1; i < n; i++) {
            switch (str.charAt(i)) {
                case ',':
                    x = new Nodo(' ');
                    ultimo.setNext(x);
                    ultimo = x;
                    if (stack.peek() == null){
                        ultimo.setHead(head);
                    } else {
                        ultimo.setHead(stack.peek());
                    }
                    break;
                case '(':
                    stack.push(ultimo);
                    x = new Nodo(' ');
                    ultimo.setTag(1);
                    ultimo.setsubList(x);
                    ultimo = x;
                    break;
                case ')':
                    ultimo = stack.pop();
                    break;
                default:
                    System.out.println(str.charAt(i));
                    ultimo.setTag(0);
                    ultimo.setDato(str.charAt(i));
                    ultimo.setHead(stack.peek());
                    break;
            }
        }
    }

    public void recListG (){
        if(head == null){
            return;
        }
        Nodo pointer = head;
        while(pointer != null){
            System.out.print(pointer.getDato());
            if (pointer.getsubList() != null){
                pointer = pointer.getsubList();
                System.out.print(pointer.getDato());
            } else if (pointer.getNext() == null){
                pointer = pointer.getHead();
            }
            if (pointer != null){
                pointer = pointer.getNext();
                
            }
        }
    }
}
