package Ejercicio1;

import java.io.BufferedReader;
import java.io.FileReader;

public class Lista {

    private Estudiante head;

    public Lista() {

    }

    public Estudiante getHead() {
        return head;
    }

    public void setHead(Estudiante head) {
        this.head = head;
    }

    public void leerArchivo(String datos) {
        FileReader archivo;
        BufferedReader lector;
        try {
            archivo = new FileReader(datos);
            if (archivo.ready()) {
                lector = new BufferedReader(archivo);
                String linea = lector.readLine();
                while (linea != null) {
                    String[] elementos = linea.split("/"); // Suponiendo que los elementos estén separados por /
                    String nombre = elementos[0];
                    String[] notasStr = elementos[1].split("-");
                    double notas[] = new double[5];
                    for (int i = 0; i < 5; i++) {
                        notas[i] = Double.parseDouble(notasStr[i]);
                    }

                    insertar(nombre, notas);
                    linea = lector.readLine();
                }
            } else {
                System.out.println("No está listo el archivo");
            }
        } catch (

        Exception e) {
            System.out.println("Error: " + e.getMessage()); // En caso de "Error";
        }
    }

    public void insertar(String nombre, double[] notas) {
        Estudiante nuevo = new Estudiante();
        nuevo.setNombre(nombre);
        nuevo.setNotas(notas);
        nuevo.setPromedio(nuevo.calcularPromedio(notas));
        int i = 0;
        if (head == null) {
            head = nuevo;
        } else {
            Estudiante pointer = head;
            while (pointer.next != null) {
                pointer = pointer.next;
                i++;
            }
            pointer.next = nuevo;
        }
    }

    public void mostrar() {
        Estudiante pointer = head;
        while (pointer != null) {
            System.out.println("--------------------------------");
            System.out.println("|Nombre: " + pointer.getNombre());
            System.out.println("|Notas: ");
            for (int i = 0; i < 5; i++) {
                System.out.println("|" + (i + 1) + ": " + pointer.getNotas()[i]);
            }
            System.out.println("|Promedio: " + pointer.getPromedio());
            System.out.println("--------------------------------");
            pointer = pointer.next;
        }
    }

    public void eliminar() {
        Estudiante pointer = head;
        while (pointer.next != null) {
            if (pointer.next.getPromedio() < 2) {
                if (pointer.next.next != null) {
                    pointer.next = pointer.next.next;
                } else {

                }
            }
            pointer = pointer.next;
        }
        System.out.println("\nSe han eliminado los estudiantes con promedio menor a 2\n");
    }

    public Estudiante mostrarMayorPromedio() {
        Estudiante pointer = head;
        String estudianteMax = pointer.getNombre();
        double max = pointer.getPromedio();
        Estudiante mayorPromedio = null;
        while (pointer != null) {
            if (pointer.getPromedio() > max) {
                max = pointer.getPromedio();
                estudianteMax = pointer.getNombre();
                mayorPromedio = pointer;
            }
            pointer = pointer.next;
        }
        System.out.println("\n---------------------------------------------------");
        System.out.println("El estudiante con el promedio mayor es: " + estudianteMax);
        System.out.println("Su promedio es: " + max);
        System.out.println("---------------------------------------------------\n");
        return mayorPromedio;
    }

    public void ordenar() {
        Estudiante pointer = head;
        Estudiante pointer2 = head;
        Estudiante temp = null;
        String nombre;
        double promedio;
        double[] notas;
        if (head != null) {
            while (pointer.next != null) {
                pointer2 = pointer.next;
                while (pointer2 != null) {
                    if (pointer2.getPromedio() > pointer.getPromedio()) {
                        temp = pointer2;
                        nombre=pointer.getNombre();
                        notas=pointer.getNotas();
                        promedio=pointer.getPromedio();
                        // Intercambio de datos
                        // Ponemos los datos de pointer2 en pointer
                        pointer.setNombre(temp.getNombre());
                        pointer.setNotas(temp.getNotas());
                        pointer.setPromedio(temp.getPromedio());
                        // Ponemos los datos de pointer en pointer2
                        pointer2.setNombre(nombre);
                        pointer2.setNotas(notas);
                        pointer2.setPromedio(promedio);
                    }
                    pointer2 = pointer2.next;
                }
                pointer = pointer.next;
            }
        } else {
            System.out.println("La lista esta vacia");
        }
    }
}
