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

    def registrar_musica(cont_musica, titulo, artista_banda, duracion, ano_lanzamiento, formato, genero):
        conn=sqlite3.connect('TallerProgramacion/musicadb.db')
        c=conn.cursor()
        c.execute("INSERT INTO musica VALUES(?, ?, ?, ?, ?, ?,?)",
                         (cont_musica, titulo, artista_banda, duracion, ano_lanzamiento, formato, genero))
        conn.commit()
        conn.close()
    def mostrar_cancion(titulo):
        conn=sqlite3.connect('TallerProgramacion/musicadb.db')
        c=conn.cursor()
        c.execute('SELECT * FROM musica WHERE titulo=?',(titulo))
        print(c.fetchall())
        conn.close
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
        c.execute('DELETE from rock WHERE id=?' , (musica))
        conn.commit()
        conn.close()