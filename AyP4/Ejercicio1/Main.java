package Ejercicio1;

import java.util.Scanner;

class Main {

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        Lista lista = new Lista();
        int eleccion;
        do {
            System.out.println("Bienvenido al programa gestión de notas de los estudiantes");
            System.out.println("Elija una opción del menú");
            System.out.println("1. Insertar");
            System.out.println("2. Mostrar");
            System.out.println("3. Eliminar estudiantes con promedio menor a 2");
            System.out.println("4. Mostrar el mayor promedio");
            System.out.println("5. Ordenar");
            System.out.println("6. Salir");
            System.out.println("Su elección es: ");
            eleccion = sc.nextInt();
            switch (eleccion) {
                case 1:
                    System.out.println("¿Cómo prefiere ingresar los datos?  1. Por teclado   2. Por archivo");
                    int eleccion2 = sc.nextInt();
                    sc.nextLine();
                    if (eleccion2 == 1) {
                        System.out.println("Introduzca el nombre del estudiante");
                        String nombre = sc.nextLine();
                        System.out.println("Introduzca las notas del estudiante");
                        double[] notas = new double[5];
                        for (int i = 0; i < 5; i++) {
                            notas[i] = sc.nextDouble();
                        }
                        lista.insertar(nombre, notas);
                    } else if (eleccion2 == 2) {
                        lista.leerArchivo(
                                "C:/Users/anita/OneDrive/Escritorio/PracticaTalleres/2024-1/AyP4/Ejercicio1/Datos.txt");
                    }
                    break;
                case 2:
                    lista.mostrar();
                    break;
                case 3:
                    lista.eliminar();
                    lista.mostrar();
                    break;
                case 4:
                    lista.mostrarMayorPromedio();
                    break;
                case 5:
                    lista.ordenar();
                    break;
                case 6:
                    System.out.println("Gracias por usar el programa. ¡Hasta pronto!");
                    System.exit(0);
                    break;

                default:
                    break;
            }
        } while (eleccion != 6);
    }
}