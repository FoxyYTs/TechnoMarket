package TallerConjuntos;

public class Estudiante {

    private String nombre="";
    private double[] notasMaterias = new double[4];
    private Estudiante next=null;

    public Estudiante() {
    }

    public Estudiante(String nombre, double[] notasMaterias) {
        this.nombre = nombre;
        this.notasMaterias = notasMaterias;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public double[] getNotasMaterias() {
        return notasMaterias;
    }

    public void setNotasMaterias(double[] notasMaterias) {
        this.notasMaterias = notasMaterias;
    }
    public Estudiante getNext() {
        return next;
    }
    public void setNext(Estudiante next) {
        this.next = next;
    }
    
}
