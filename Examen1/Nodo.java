package Examen1;

public class Nodo {
    private int tag;
    private char dato;
    private Nodo subList;
    private Nodo next;
    private Nodo head;

    public Nodo(char dato){
        this.dato=dato;
        this.tag=0;
        this.next=null;
        this.subList=null;
        
    }

    public int getTag() {
        return tag;
    }

    public void setTag(int tag) {
        this.tag = tag;
    }

    public char getDato() {
        return dato;
    }

    public void setDato(char dato) {
        this.dato = dato;
    }

    public Nodo getNext() {
        return next;
    }

    public void setNext(Nodo next) {
        this.next = next;
    }

    public Nodo getsubList(){
        return subList;
    }

    public void setsubList(Nodo subList){
        this.subList=subList;
    }

    public Nodo getHead(){
        return head;
    }

    public void setHead(Nodo head){
        this.head=head;
    }
}
