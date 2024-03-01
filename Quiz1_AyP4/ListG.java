import java.util.Stack;

public class ListG {
    public void insertListG(String list) {
    head=null;
    Lista currentList = new Lista();// Se trata de la lista inicial, actual en recorrido
    Stack stack = new Stack();// Se trata de una pila para las listas generales
    for (int i = 0; i < list.length(); i++) {
        switch (list.charAt(i)) {
            case ',':
                break;
            case '(':
                Lista newList = new Lista();
                newList.insertListG(list.substring(i + 1, list.length()));// La función substring(i + 1,
                                                                          // list.length()) entrega el resto de la
                                                                          // cadena donde va el parentesis
                stack.push(newList);

                currentList.insertInList(stack.peek().getHead()); // Inserta la cabeza de la nueva lista en la lista
                                                                  // actual
                i += newList.getLength(); // Avanza el índice para omitir la sublista procesada y el paréntesis
                                              // de cierre
                currentList = newList;
                break;
            case ')':
                stack.pop();
                break;
            default:
                Node newNode = new Node();
                newNode.setTag(0);
                newNode.setDato(list.charAt(i));
                currentList.insertInList(newNode);
                break;
        }

    }
}
}
