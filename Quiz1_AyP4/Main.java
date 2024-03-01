package Quiz1_AyP4;

import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        ListG list = new ListG();
        System.out.println("Insertar una lista, cadena de datos, separados por comas: (a,b,c,(d,e,f))");
        String lista=sc.next();
        if(list.inspect(lista)){
            list.insertListG(lista);
        }else{
            System.out.println("No se puede insertar la lista, revise nuevamente la cadena");
        }
        list.printList();
        
    }
    
}
