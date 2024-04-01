package Examen1;

public class Main {
    public static void main(String[] args) {
        ListaG list = new ListaG();

        list.insertarListaG(("(a,A,(b,c,(d,e,f),C))"));
        list.recListG();
    }


    //(a,A,(b,c,(d,e,f),C))
    //(a,A,(b,c,D,(d,e),f))
    //A =(x,y,z)
    //C =(n,m,L)
    //L =(r,s,t)
    //D =(g,h,i)
}
