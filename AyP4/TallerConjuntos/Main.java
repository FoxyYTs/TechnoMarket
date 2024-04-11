package TallerConjuntos;

import java.util.Scanner;

public class Main {

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        Funciones fc = new Funciones();
        Funciones set1 = new Funciones();
        Funciones set2 = new Funciones();
        String nombre = "";
        double[] notas = new double[3];
        System.out.println("Programa de conjuntos");
        System.out.println("Introduzca el conjunto de estudiantes de otras materias");
        System.out.println("Cuántos estudiantes va a ingresar?");
        int n1 = sc.nextInt();
        sc.nextLine();
        for (int i = 0; i < n1; i++) {
            System.out.println("Introduzca el nombre del estudiante");
            nombre = sc.nextLine();
            System.out.println("Introduzca las notas del estudiante");
            notas = new double[3];
            for (int j = 0; j < notas.length; j++) {
                System.out.println(set1.obtMaterias(j) + ": ");
                notas[j] = sc.nextDouble();
                sc.nextLine();
            }
            set1.insertar(nombre, notas);
        }

        System.out.println("Introduzca el conjunto de estudiantes de inglés");
        System.out.println("Cuántos estudiantes va a ingresar?");
        int n2 = sc.nextInt();
        sc.nextLine();
        for (int i = 0; i < n2; i++) {
            System.out.println("Introduzca el nombre del estudiante");
            nombre = sc.nextLine();
            System.out.println("Introduzca las notas del estudiante");
            notas = new double[4];
            System.out.println(set1.obtMaterias(3) + ": ");
            notas[3] = sc.nextDouble();
            sc.nextLine();
            set2.insertar(nombre, notas);
        }
        System.out.println("Los estudiantes que están matriculados en ambos conjuntos son: ");
        fc.intersectList(set1, set2);

        System.out.println("Todos los estudiantes que están matriculados en al menos una materia son: ");
        fc.unionList(set1, set2);

        System.out.println("Desea buscar algún estudante? (s/n)");
        String resp = sc.nextLine();
        if (resp.equals("s")) {
            System.out.println("Introduzca el nombre del estudiante");
            nombre = sc.nextLine();
            fc.memberList(nombre);
        }
    }
}
