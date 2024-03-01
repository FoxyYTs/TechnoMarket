package Examen1;

public class Stack {
    Nodo top;
    public Stack(){
        top=null;
    }

    public void push(Nodo x){
        if (top == null){
            top = x;
        } else {
            x.setNext(top);
            top = x;
        }
    }

    public Nodo peek(){
        return top;
    }

    public Nodo pop(){
        if (top == null){
            return null;
        }
        Nodo pointer = top;
        top = top.getNext();
        return pointer;
    }
}
