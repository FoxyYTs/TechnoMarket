from conexion import conexion

class Books(conexion):
    def __init__(self, bookTitle="", authorName="", libraryId=""):
        conexion.__init__(self)
        self.bookTitle=bookTitle
        self.authorName=authorName
        self.libraryId=libraryId
        self.crear("Books","Book")
        
    def insertar(self):
        datos = [
            (f"{self.bookTitle}",f"{self.authorName}",f"{self.libraryId}")
        ]
        self.insertar("Book",3,datos)
        
    def verTabla(self):
        self.datosEnLaTabla = self.seleccionarTabla("Books")