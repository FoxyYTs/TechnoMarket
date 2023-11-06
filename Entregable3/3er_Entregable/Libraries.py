from conexion import conexion

class Libraries(conexion):
    def __init__(self, libraryName="", city=""):
        conexion.__init__(self)
        self.libraryName=libraryName
        self.city=city
        self.crear("Libraries","Library")
