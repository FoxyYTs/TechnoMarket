import pandas as pd
from pandas import ExcelWriter
import baseDatos

class Crud:
    def crear():
        titulo = input('titulo: ')
        ExcelWriter("TallerProgramacion/" + titulo + ".xlsx")

    crear()
    def registrar():
        c.execute("""INSERT INTO musica(id_musica, titulo, artista_banda, duracion, ano_lanzamiento, formato, genero)
                  values(cont_musica, titulo, artista_banda, duracion, ano_lanzamiento, formato, genero)""")


    def mostrar():
        for i 
    

    def actualizar():

    def eliminar():