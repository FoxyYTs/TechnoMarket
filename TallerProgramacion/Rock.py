from Musica import Musica
import openpyxl
import pandas as pd
datos=["id_musica", "titulo", "artista_banda", "duracion", "ano_lanzamiento", "formato", "genero","subgenero","conciertos_dados","pais_origen","letra","musica"]
datosExcel=["id", "titulo", "artista_banda", "duracion", "ano_lanzamiento", "formato", "genero","subgenero","conciertos_dados","pais_origen","letra","musica"]

class Rock(Musica):
    def __init__(self, id=""):
        self.Hijo = pd.read_excel("TallerProgramacion/Archivo.xlsx","ClaseHijo",index_col="musica")
        self.Padre = pd.read_excel("TallerProgramacion/Archivo.xlsx","ClasePadre",index_col="id")
        """Rock
            id (int): Identificacion de la musica
            titulo (String): Titulo de la cancion
            artista_banda (String): Nombre del artista o banda
            duracion (String): cuanto dura la cancion
            ano_lanzamiento (int): En que año salio la cancion
            formato (String): En que formato esta la cancion
            genero (String): Genero de la cancion
            subgenero (String): SubGenero de la cancion
            conciertos_dados (int): En cuantos conciertos a sonado esta cancion
            pais_origen (int): De que pais es la Banda
            letra (String): Letra de la cancion
            musica (String): id

        Args:
            id (String) =  Identificacion de la musica
        """
        super().__init__(id, self.hojaPadre.loc[id, "titulo"], self.hojaPadre.loc[id, "artista_banda"], self.hojaPadre.loc[id, "duracion"], int(self.hojaPadre.loc[id, "ano_lanzamiento"]),self.hojaPadre.loc[id, "formato"],(self.hojaPadre.loc[id, "genero"]))
        self.musica = id
        self.subgenero = self.hojaHijo.loc[id, "subgenero"]
        self.conciertos_dados = int(self.hojaHijo.loc[id, "conciertos_dados"])
        self.pais_origen = self.hojaHijo.loc[id, "pais_origen"]
        self.letra = self.hojaHijo.loc[id, "letra"]
        self.musica = self.hojaHijo.loc[id, "musica"]

    def IniciarTabla(self):
        """
            Crea la Tabla
        """
        self.registrar_musica("Musica", "ColumnasMusica")
        self.registrar_rock("Rock","ColumnasRock")

    def agregarDatos(self):
        """
            Inserta los datos a la base de datos ya creada
        """
        datosM = [
            (self.id_musica,self.titulo, self.artista_banda, self.duracion, self.ano_lanzamiento, self.formato, self.genero)
        ]
        self.registrar_musica("Musica","?,?,?,?,?,?,?",datosM)
        datosR = [
            (self.id_musica,self.subgenero,self.conciertos_dados,self.pais_origen,self.letra,self.musica)
        ]
        self.registrar_rock("Rock","?,?,?,?,?,?",datosR)
        print("Datos Agregados.")
    
    def EliminarDatos(self):
        """
            Elimina los datos dependiendo de su clave foranea
        """
        self.eliminar("Musica", self.id_musica)
        self.eliminar("Rock", self.placa)
        print("Datos eliminados.")
    
    def LeerDatos(self):
        """
            Muestra los registros de la base de datos
        """
        print("============================")
        datosM = self.mostrar_base_datos("Musica", self.id_musica)
        print(f"1. ID: {datosM[0]}\n2. Titulo: {datosM[1]}\n3. Artista: {datosM[2]}\n4. Duracion: {datosM[3]}\n5. Año Lanzamiento: {datosM[4]}\n6. Formato: {datosM[5]}\n7. Genero: {datosM[6]}")
        datosR = self.mostrar_base_datos("Rock", self.placa)
        print(f"8. Subgenero: {datosR[1]}\n9. la tocaron en conciertos: {datosR[2]}\n10. Pais de Origen: {datosR[3]}\n11. Letra: {datosR[4]}\n12. Musica: {datosR[5]}")
        print("============================")
                
    