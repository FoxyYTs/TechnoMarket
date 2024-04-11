package EjercicioListasGeneralizadas;

public class Nodo {
    private int tag;
    private char dato;
    public Nodo next;

    public Nodo() {
    }

    public Nodo(int tag, char dato) {
        this.tag = tag;
        this.dato = dato;
    }

    public void setTag(int tag) {
        this.tag = tag;
    }

    public void setDato(char dato) {
        this.dato = dato;
    }

    public int getTag() {
        return tag;
    }

    public char getDato() {
        return dato;
    }
}
