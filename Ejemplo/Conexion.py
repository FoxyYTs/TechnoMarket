import sqlite3
import json

class Conexion:
    def __init__(self):
        self.DB = sqlite3.connect("3er_Entregable/Ejemplo/DB.sqlite")
        self.iterador = self.DB.cursor()
        with open("3er_Entregable/Ejemplo/Queries.json", "r") as queries:
            self.Querys = json.load(queries)
    

    def BuscarId(self, ID, Tabla):
        Seleccionar = self.Querys["VerDatos"].format(Tabla, "ID", ID)
        self.iterador.execute(Seleccionar)
        resultado = self.iterador.fetchone()[0]
        return resultado
    
    def readTable(self, Tabla):
        Seleccionar = self.Querys["SeleccionarTodo"].format(Tabla)
        self.iterador.execute(Seleccionar)
        resultado = self.iterador.fetchall()
        return resultado
    
    def createTable(self, Nombre = "", Query = ""):
        if Nombre != "" and Query != "":
            Info = self.Querys["createTable"].format(Nombre, self.Querys[Query])
            self.iterador.execute(Info)
            self.DB.commit()
        else:
            print("DB :: No puede dejar un campo vacio.")

    def insertTable(self, Tabla = "", Columns = 0, Values = ""):
        if Tabla != "" and Values != "":
            Info = self.Querys["insertTable"].format(Tabla, ', '.join(['?'] * Columns))
            self.iterador.executemany(Info, Values)
            self.DB.commit()
        else:
            print("DB :: No puede dejar un campo vacio.")
    
    def updateTable(self, NuevoDato, Tabla = "", Columna = "", ID = 0):
        if Tabla != "" and ID != 0:
            if self.BuscarId(ID, Tabla):
                Info = self.Querys["updateTable"].format(Tabla, Columna, NuevoDato, "ID", ID)
                self.iterador.execute(Info)
                self.DB.commit()
                return True
            else:
                return False
        else:
            return False
        
    def deleteTable(self, Tabla = "", ID = 0):
        if Tabla != "" and ID != 0:
            if self.BuscarId(ID, Tabla):
                Info = self.Querys["deleteTable"].format(Tabla, "ID", ID)
                self.iterador.execute(Info)
                self.DB.commit()
                return True
            else:
                return False
        else:
            return False
    
    def CerrarDB(self):
        self.DB.commit()
        self.DB.close()