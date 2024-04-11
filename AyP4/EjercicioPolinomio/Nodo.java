package EjercicioPolinomio;
//Para un tipo de polinomio 6xy+4xy+3xy+2y
public class Nodo {
    private int tag;
    private int coefficient;
    private int x;
    private int y;
    private Nodo next;
    public Nodo() {
        
    }
    public Nodo(int tag, int coefficient, int x, int y, Nodo next) {
        this.tag = tag;
        this.coefficient = coefficient;
        this.x = x;
        this.y = y;
        this.next = next;
    }
    public int getTag() {
        return tag;
    }
    public void setTag(int tag) {
        this.tag = tag;
    }
    public int getcoefficient() {
        return coefficient;
    }
    public void setcoefficient(int coefficient) {
        this.coefficient = coefficient;
    }
    public int getX() {
        return x;
    }
    public void setX(int x) {
        this.x = x;
    }
    public int getY() {
        return y;
    }
    public void setY(int y) {
        this.y = y;
    }
    public Nodo getNext() {
        return next;
    }
    public void setNext(Nodo next) {
        this.next = next;
    }
}
