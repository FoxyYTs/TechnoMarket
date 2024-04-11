package EjercicioListasGeneralizadas;
import java.util.Scanner;
public class Main {
    
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        Lista newList = new Lista();
        String list=sc.nextLine();
        if (newList.inspect(list)) {
            newList.insertListG(list);
        } else {
            System.out.println("La lista no esta correcta, faltan aperturas o cierres");
        }
        newList.insertListG(list);
        newList.printList();
    }
}
