import sqlite3
import json

class conexion:
    def _init_(self):
        self.baseDatos=sqlite3.connect("./DB.sqlite")
        self.pointer=self.baseDatos.cursor()
        with open("./queries.json")as queries:
            self.query=json.load(queries)

    def crear(self,nombre,columnas):
        queryCrear=self.query["CrearTabla"].format(nombre,self.query[columnas])
        self.pointer.execute(queryCrear)
        self.baseDatos.commit()

    