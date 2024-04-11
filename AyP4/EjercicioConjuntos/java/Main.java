package EjercicioConjuntos.java;

import java.util.HashSet;
import java.util.Scanner;
import java.util.Set;

public class Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        FuncionesConjuntos list = new FuncionesConjuntos();
        FuncionesConjuntos list2 = new FuncionesConjuntos();
        System.out.println("Bienvenido al programa de conjuntos");
        String opcion = "0";
        while (opcion != "10") {
            System.out.println("Elija una opción del menú");
            System.out.println("1. Crear Conjunto");
            System.out.println("2. Pertenecia");
            System.out.println("3. Ordenar conjunto");
            System.out.println("4. Unión de conjuntos");
            System.out.println("5. Intersección de conjuntos");
            System.out.println("6. Diferencia simétrica de conjuntos");
            System.out.println("7. Contiene");
            System.out.println("8. Diferencia");
            System.out.println("9. Mostrar Conjunto");
            System.out.println("10. Salir");
            opcion = sc.next();
            String dato = "";
            switch (opcion) {
                case "1":
                    System.out.println("Cuantos elementos desea agregar");
                    int cant = sc.nextInt();
                    sc.nextLine();
                    for (int i = 0; i < cant; i++) {
                        System.out.println("Ingrese el elemento");
                        dato = sc.next();
                        list.insertInList(Integer.parseInt(dato));
                    }
                    list.printList();
                    break;
                case "2":
                    System.out.println("Ingrese el elemento a buscar");
                    dato = sc.next();
                    list.memberList(Integer.parseInt(dato));
                    list.printList();
                    break;
                case "3":
                    list.orderList();
                    list.printList();
                    break;
                case "4":
                    list.setHead(null); // limpiamos la lista
                    list2.setHead(null);
                    System.out.println("Ingrese las listas a evaluar");
                    for (int i = 0; i < 2; i++) {
                        System.out.println("Lista " + (i + 1));
                        System.out.println("¿Cuántos elementos desea agregar?");
                        int j = sc.nextInt();
                        sc.nextLine();
                        for (int k = 0; k < j; k++) {
                            System.out.println("Ingrese el elemento");
                            dato = sc.next();
                            if (i == 0) {
                                list.insertInList(Integer.parseInt(dato));
                            } else {
                                list2.insertInList(Integer.parseInt(dato));
                            }
                        }
                    }
                    list.unionList(list, list2);
                    break;
                case "5":
                    list.setHead(null); // limpiamos la lista
                    list2.setHead(null);
                    System.out.println("Ingrese las listas a evaluar");
                    for (int i = 0; i < 2; i++) {
                        System.out.println("Lista " + (i + 1));
                        System.out.println("¿Cuántos elementos desea agregar?");
                        int j = sc.nextInt();
                        sc.nextLine();
                        for (int k = 0; k < j; k++) {
                            System.out.println("Ingrese el elemento");
                            dato = sc.next();
                            if (i == 0) {
                                list.insertInList(Integer.parseInt(dato));
                            } else {
                                list2.insertInList(Integer.parseInt(dato));
                            }
                        }
                    }
                    list.intersectList(list, list2);
                    break;
                case "6":
                    list.setHead(null); // limpiamos la lista
                    list2.setHead(null);
                    System.out.println("Ingrese las listas a evaluar");
                    for (int i = 0; i < 2; i++) {
                        System.out.println("Lista " + (i + 1));
                        System.out.println("¿Cuántos elementos desea agregar?");
                        int j = sc.nextInt();
                        sc.nextLine();
                        for (int k = 0; k < j; k++) {
                            System.out.println("Ingrese el elemento");
                            dato = sc.next();
                            if (i == 0) {
                                list.insertInList(Integer.parseInt(dato));
                            } else {
                                list2.insertInList(Integer.parseInt(dato));
                            }
                        }
                    }
                    list.symmetDifferenceList(list, list2);
                    break;
                case "7":
                    Set<Integer> set1 = new HashSet<>();
                    Set<Integer> set2 = new HashSet<>();
                    System.out.println("Ingrese las listas a evaluar");
                    for (int i = 0; i < 2; i++) {
                        System.out.println("Lista " + (i + 1));
                        System.out.println("¿Cuántos elementos desea agregar?");
                        int j = sc.nextInt();
                        sc.nextLine();
                        for (int k = 0; k < j; k++) {
                            System.out.println("Ingrese el elemento");
                            dato = sc.next();
                            if (i == 0) {
                                set1.add(Integer.parseInt(dato));
                            } else {
                                set2.add(Integer.parseInt(dato));
                            }
                        }
                    }
                    if (set1.containsAll(set2)) {
                        System.out.println("El conjunto 1 contiene al conjunto 2");
                    } else if (set2.containsAll(set1)) {
                        System.out.println("El conjunto 2 contiene al conjunto 1");
                    } else {
                        System.out.println("Los conjuntos no es contienen");
                    }
                    break;
                case "8":
                    list.setHead(null); // limpiamos la lista
                    list2.setHead(null);
                    System.out.println("Ingrese las listas a evaluar");
                    for (int i = 0; i < 2; i++) {
                        System.out.println("Lista " + (i + 1));
                        System.out.println("¿Cuántos elementos desea agregar?");
                        int j = sc.nextInt();
                        sc.nextLine();
                        for (int k = 0; k < j; k++) {
                            System.out.println("Ingrese el elemento");
                            dato = sc.next();
                            if (i == 0) {
                                list.insertInList(Integer.parseInt(dato));
                            } else {
                                list2.insertInList(Integer.parseInt(dato));
                            }
                        }
                    }
                    list.differenceList(list, list2);
                    break;
                case "9":
                    list.printList();
                    break;
                default:
                    System.out.println("Elija una opción del menú");
                    break;
            }
        }
    }
}