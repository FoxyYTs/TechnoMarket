import pandas as pd
from pandas import ExcelWriter
import os
import sqlite3

class Crud:
    def crear():
        df1 = pd.DataFrame({'A':['A0', 'A1', 'A2','A3'],
        'B':['B0', 'B1', 'B2','B3'],
        'C':['C0', 'C1', 'C2','C3'],
        'D':['D0', 'D1', 'D2','D3']})

        df2 = pd.DataFrame({'A':['A0', 'A1', 'A2','A3'],
        'B':['B0', 'B1', 'B2','B3'],
        'C':['C0', 'C1', 'C2','C3'],
        'D':['D0', 'D1', 'D2','D3']})
        titulo = input('titulo: ')
        with ExcelWriter("TallerProgramacion/" + titulo + ".xlsx") as writer:
            df1.to_excel(writer,sheet_name="Clase Padre")
            df2.to_excel(writer,sheet_name="Clase Hijo")
    def leer():
        print(pd.read_excel("TallerProgramacion/Karl.xlsx"))
    
    def create_table_musica():
        conn=sqlite3.connect('TallerProgramacion/musicadb.db')
        c=conn.cursor()
        c.execute("""CREATE TABLE IF NOT EXISTS musica (
            id INT PRIMARY KEY,
            titulo VARCHAR(45)NOT NULL,
            artista_banda VARCHAR(45) NOT NULL,
            duracion VARCHAR (45) NOT NULL,
            ano_lanzamiento INT NOT NULL,
            formato VARCHAR(5) NOT NULL,
            genero VARCHAR(45) NOT NULL
        )""")
        conn.commit()
        conn.close()

    def create_table_rock():
        conn=sqlite3.connect('TallerProgramacion/musicadb.db')
        c=conn.cursor()
        c.execute("""CREATE TABLE IF NOT EXISTS rock(
            id INT PRIMARY KEY,
            subgenero VARCHAR(45) NOT NULL,
            conciertos_dados INT NOT NULL,
            pais_origen VARCHAR(45) NOT NULL,
            letra TEXT NOT NULL,
            album VARCHAR(45),
            musica INT NOT NULL,
            FOREIGN KEY (musica) REFERENCES musica (id_musica)
        )""")
        conn.commit()
        conn.close()
        
    def registrar_rock(cont_rock, subgenero, conciertos_dados, pais_origen, letra, album, musica):
        conn=sqlite3.connect('TallerProgramacion/musicadb.db')
        c=conn.cursor()
        c.execute("INSERT INTO rock VALUES(?, ?, ?, ?, ?, ?,?)",
                         (cont_rock, subgenero, conciertos_dados, pais_origen, letra, album, musica))
        conn.commit()
        conn.close()

    def registrar_musica(cont_musica, titulo, artista_banda, duracion, ano_lanzamiento, formato, genero,cont_rock, subgenero, conciertos_dados, pais_origen, letra, album):
        conn=sqlite3.connect('TallerProgramacion/musicadb.db')
        c=conn.cursor()
        c.execute("INSERT INTO musica VALUES(?, ?, ?, ?, ?, ?,?)",
                         (cont_musica, titulo, artista_banda, duracion, ano_lanzamiento, formato, genero))
        
        registrar_rock(cont_rock, subgenero, conciertos_dados, pais_origen, letra, album, cont_musica)

        conn.commit()
        conn.close()

    def mostrar_cancion(titulo):
        conn=sqlite3.connect('TallerProgramacion/musicadb.db')
        c=conn.cursor()
        c.execute('SELECT * FROM musica WHERE titulo=?',(titulo))
        print(c.fetchone())
        musica=c.fetchone()
        conn.close
        c.execute('SELECT * FROM rock WHERE musica=?',(musica.id))
        print(c.fetchone())

    def actualizar(tabla, atributo, dato, id):
        conn=sqlite3.connect('TallerProgramacion/musicadb.db')
        c=conn.cursor()
        c.execute('UPDATE tabla SET atributo=dato WHERE id=id',(tabla, atributo, dato, id))
        conn.commit()
        conn.close()

    def eliminar(id):
        conn=sqlite3.connect('TallerProgramacion/musicadb.db')
        c=conn.cursor()
        c.execute("SELECT*FROM rock WHERE id=?", (id))
        musica=c.fetchone()
        c.execute('DELETE from rock WHERE id=?' , (id))
        c.execute('DELETE from rock WHERE musica=?' , (musica.id))
        conn.commit()
        conn.close()

    def mostrar_base_datos():
        conn=sqlite3.connect('TallerProgramacion/musicadb.db')
        c=conn.cursor()
        c.execute("SELECT*FROM musica",)
        print(c.fetchall())
        c.execute("SELECT*FROM rock",)
        print(c.fetchall())
        conn.commit()
        conn.close()