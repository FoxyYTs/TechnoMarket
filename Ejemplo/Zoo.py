from Conexion import Conexion

class Zoo(Conexion):
    def __init__(self, nombre="", ubicacion=""):
        Conexion.__init__(self)
        self.nombre=nombre
        self.ubicacion=ubicacion
        self.crearTabla()

    # CRUD
    def crearTabla(self):
        self.createTable("Zoos", "Zoo")

    def leerTabla(self):
        self.datosEnLaTabla = self.readTable("Zoos")

    def editarTabla(self, nuevoDato, columna, id):
        if self.updateTable(nuevoDato, "Zoos", columna, id):
            return True
        else:
            return False
        
    def eliminarTabla(self, id):
        if self.deleteTable("Zoos", id):
            return True
        else:
            return False
        
    def insertarTabla(self):
        datos = [
            (f"{self.nombre}", f"{self.ubicacion}")
        ]
        self.insertTable("Zoos", 2, datos)
    