package Ejercicio1;

public class Estudiante {

    private String nombre;
    private double[] notas = new double[5];//AyP4, Calculo, Analisis, Ingles
    public Estudiante next;

    public Estudiante() {
    }

    public Estudiante(String nombre, double[] notas, double promedio) {
        this.nombre = nombre;
        this.notas = notas;
        this.promedio = promedio;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public double[] getNotas() {
        return notas;
    }

    public void setNotas(double[] notas) {
        this.notas = notas;
    }

    public double getPromedio() {
        return promedio;
    }

    public void setPromedio(double promedio) {
        this.promedio = promedio;
    }

    public double calcularPromedio(double[] notas) {
        double suma = 0;
        for (int i = 0; i < notas.length; i++) {
            suma += notas[i];
        }
        return suma / notas.length;
    }
}
