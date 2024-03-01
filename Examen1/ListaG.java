package Examen1;

import java.util.*;

public class ListaG {
    private Scanner leer = new Scanner(System.in);
    public Nodo head;
    private char last;

    public ListaG() {
        head = null;
    }

    public void insertarListaG(String str) {
        Stack stack = new Stack();
        Nodo x = new Nodo(' ');
        head = x;
        Nodo ultimo = x;
        System.out.println(str);
        
        for (int i = 1; i < str.length(); i++) {
            if (str.charAt(i) == ','){
                x = new Nodo(' ');
                ultimo.setNext(x);
                ultimo = x;
                if (stack.peek() == null){
                    ultimo.setHead(head);
                } else {
                    ultimo.setHead(stack.peek());
                }
            } else if (str.charAt(i) == '('){
                stack.push(ultimo);
                x = new Nodo(' ');
                ultimo.setTag(1);
                ultimo.setsubList(x);
                ultimo = x;
            } else if(str.charAt(i) == ')'){
                ultimo = stack.pop();
            } else if (Character.isUpperCase(str.charAt(i))){
                System.out.println("Cual es la lista equivalente a: " + str.charAt(i));
                String a = leer.nextLine();
                str = reemplazaCaracter(str, String.valueOf(str.charAt(i)), a);
                i -= 1;
                System.out.println(str);

            }else {
                last = str.charAt(i);
                ultimo.setTag(0);
                ultimo.setDato(str.charAt(i));
                ultimo.setHead(stack.peek());
            }
        }
    }

    public void recListG (){
        if(head == null){
            return;
        }
        Nodo pointer = head;
        Nodo temp = null;
        while(pointer != null){
            if (pointer.getDato() == last){
                System.out.println(last);
                break;
            }
            if (pointer.getDato() != ' '){
                System.out.print(pointer.getDato());
            }
            
            if (pointer.getsubList() != null && pointer != temp){
                pointer = pointer.getsubList();
                temp = pointer;
                System.out.print(pointer.getDato());
            } else if (pointer.getNext() == null){
                pointer = pointer.getHead();
            }
            if (pointer != null){
                pointer = pointer.getNext();
                
            }
        }
    }

    public static String reemplazaCaracter(String str, String reemplazado, String reemplazador ) {
        char charToreplace = reemplazado.charAt(0);
        String output = "";
    
        for (int i = 0; i < str.length(); i++) {         
             if( str.charAt(i) == charToreplace) {
                 output += reemplazador; 
                 str.substring(i+1, str.length());
             }else{
                 output += str.charAt(i);
            }            
        }
        return output;
    }
}
