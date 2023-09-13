import javax.swing.JPanel;
import javax.swing.BorderFactory;
import java.swing.JFrame;
import java.awt.*;
public class Tablero{
    public static void main(String[] args){
        JPanel[][] Cuadrtos=new JPanel[20][10];
        for(int i=0;i<20;i++){
            for(int j=0;j<10;j++){
                Cuadritos[i][j]= new JPanel();
                Cuadritos[i][j].setBorder(BorderFactory.createLineBorder(Color.RED));
                Cuadritos[i][j].setBackground(Color.GRAY);
                Cuadritos[i][j].setPreferedSize(new Dimension(30,30));
            }
        }
        JFrame Mostrar=new JFrame("Tetris");
        Mostrar.setLayout(new GridLayout(20,10));
        Mostrar.pack();
        Mostrar.setVisible(true);
    }
}