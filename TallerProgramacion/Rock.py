import openpyxl
import pandas as pd
datos=["id_musica", "titulo", "artista_banda", "duracion", "ano_lanzamiento", "formato", "genero","subgenero","conciertos_dados","pais_origen","letra","musica"]
datosExcel=["id", "titulo", "artista_banda", "duracion", "ano_lanzamiento", "formato", "genero","subgenero","conciertos_dados","pais_origen","letra","musica"]

class Rock(Musica):
    def __init__(self, id=""):
        self.Hijo = pd.read_excel("TallerProgramacion/Archivo.xlsx","ClaseHijo",index_col="musica")
        self.Padre = pd.read_excel("TallerProgramacion/Archivo.xlsx","ClasePadre",index_col="id")
        