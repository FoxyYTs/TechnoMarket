public class Stack{
    private ListG top;

    public Stack(){
        top=null;    
    }
    public ListG getTop(){
        return top;
    }
    public void setTop(ListG top){
        this.top=top;
    }
    public boolean isEmpty(){
        return top==null;
    }
    public void push(ListG list){
        list.next=top;
        top=list;
    }
    public ListG pop(){
        top=top.next;
    }
    public ListG peek(){
        return top;
    }

}