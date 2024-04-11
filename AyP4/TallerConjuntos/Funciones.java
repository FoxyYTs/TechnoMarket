package TallerConjuntos;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;

public class Funciones {
    Estudiante head = null;

    public Funciones() {

    }

    public Estudiante getHead() {
        return head;
    }

    public void setHead(Estudiante head) {
        this.head = head;
    }

    public void insertar(String nombre, double[] notas) {
        Estudiante nuevo = new Estudiante(nombre, notas);
        if (head == null) {
            head = nuevo;
        } else {
            Estudiante pointer = head;
            while (pointer.getNext() != null) {
                pointer = pointer.getNext();
            }
            pointer.setNext(nuevo);
        }
    }

    public void leerArchivo(String datos) {
        try (FileReader archivo = new FileReader(datos);
                BufferedReader lector = new BufferedReader(archivo)) {
            String linea;
            while ((linea = lector.readLine()) != null) {
                String[] elementos = linea.split("/"); // Suponiendo que los elementos estén separados por /
                String nombre = elementos[0];
                String[] notasStr = elementos[1].split("-");
                double[] notas = new double[4];
                for (int i = 0; i < notas.length; i++) {
                    notas[i] = Double.parseDouble(notasStr[i]);
                }
                insertar(nombre, notas);
            }
        } catch (IOException e) {
            System.out.println("Error de lectura del archivo: " + e.getMessage());
        } catch (NumberFormatException e) {
            System.out.println("Error de formato de número: " + e.getMessage());
        } catch (ArrayIndexOutOfBoundsException e) {
            System.out.println("Error de formato de línea: " + e.getMessage());
        }
    }

    public String obtMaterias(int i) {
        String[] materias = {"AyP4", "Calculo Diferencial", "Analisis", "Ingles"};
        return materias[i];
    }

    public void mostrar() {
        Estudiante pointer = head;
        while (pointer != null) {
            System.out.println("--------------------------------");
            System.out.println("|Nombre: " + pointer.getNombre());
            System.out.println("|Notas: ");
            for (int i = 0; i < pointer.getNotasMaterias().length; i++) {
                System.out.println("|" + obtMaterias(i) + ": " + pointer.getNotasMaterias()[i]);
            }
            System.out.println("--------------------------------");
            pointer = pointer.getNext();
        }
    }

    public boolean memberList(String nombre) {
        boolean flag = false, ambos = false;
        String conjunto = "";

        Estudiante pointer = head;
        while (pointer != null) {
            if (pointer.getNombre().equals(nombre)) {
                if (pointer.getNotasMaterias()[0] != 0 || pointer.getNotasMaterias()[1] != 0
                        || pointer.getNotasMaterias()[2] != 0) {
                    conjunto = "Otras materias";
                    if (pointer.getNotasMaterias()[3] != 0) {
                        ambos = true;
                    }
                } else if (pointer.getNotasMaterias()[3] != 0) {
                    conjunto = "Ingles";
                } else {
                    conjunto = "Ninguno";
                }
            }
            pointer = pointer.getNext();
        }
        if (!ambos) {
            System.out.println("Estudiante: " + nombre + " pertenece al conjunto <<" + conjunto + ">>\n");
        } else {
            System.out.println("Estudiante: " + nombre + " está en ambos conjuntos \n");
        }
        return flag;
    }

    public Funciones intersectList(Funciones list, Funciones list2) {
        Funciones intersect = new Funciones();
        Estudiante pointer1 = list.getHead();
        boolean flag = false;
        while (pointer1 != null) {
            Estudiante pointer2 = list2.getHead();
            while (pointer2 != null) {
                if (pointer1.getNombre().equals(pointer2.getNombre())) {
                    flag = true;
                }
                pointer2 = pointer2.getNext();
            }
            if (flag) {
                intersect.insertar(pointer1.getNombre(), pointer1.getNotasMaterias());
            }
            pointer1 = pointer1.getNext();
        }
        intersect.mostrar();
        return intersect;
    }

    public Funciones unionList(Funciones list, Funciones list2) {
        Funciones union = new Funciones();
        Estudiante pointer1 = list.getHead();
        boolean flag = false;
        while (pointer1 != null) {
            union.insertar(pointer1.getNombre(), pointer1.getNotasMaterias());
            pointer1 = pointer1.getNext();
        }
        Estudiante pointerU = union.getHead();
        Estudiante pointer2 = list2.getHead();
        while (pointer2 != null) {
            flag = false;
            pointerU = union.getHead();
            while (pointerU != null) {
                if (pointerU.getNombre().equals(pointer2.getNombre())) {
                    flag = true;
                    break;
                }
                pointerU = pointerU.getNext();
            }
            if (flag == false) {
                union.insertar(pointer2.getNombre(), pointer2.getNotasMaterias());
            }
            pointer2 = pointer2.getNext();
        }
        union.mostrar();
        return union;
    }

}
