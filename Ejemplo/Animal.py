from Conexion import Conexion

class Animal(Conexion):
    def __init__(self, nombre = "", especie = "", zooID = 0):
        Conexion.__init__(self)
        self.nombre = nombre
        self.especie = especie
        self.zooID = zooID
        self.crearTabla()

    # CRUD
    def crearTabla(self):
        self.createTable("Animals", "Animal")

    def leerTabla(self):
        self.datosEnLaTabla = self.readTable("Animals")

    def editarTabla(self, nuevoDato, columna, id):
        if self.updateTable(nuevoDato, "Animals", columna, id):
            return True
        else:
            return False
        
    def eliminarTabla(self, id):
        if self.deleteTable("Animals", id):
            return True
        else:
            return False
        
    def InsertarTabla(self):
        datos = [
            (f"{self.nombre}", f"{self.especie}", f"{self.zooID}")
        ]
        self.insertTable("Animals", 3, datos)

    # ELIMINA TODOS LOS ANIMALES DE UN ZOO ELIMINADO

    def eliminarTodo(self, zooID = 0):
        Info = "DELETE FROM {} WHERE {} = {}".format("Animals", "ZOO_ID", zooID)
        self.iterador.execute(Info)              
        self.DB.commit()