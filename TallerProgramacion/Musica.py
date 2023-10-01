from CRUD import Crud

class Musica(Crud):
    def __init__(self, id_musica, titulo, artista_banda, duracion, ano_lanzamiento, formato, genero):
        super().__init__()
        self.id_musica = id_musica
        self.titulo = titulo
        self.artista_banda = artista_banda
        self.duracion = duracion
        self.ano_lanzamiento = ano_lanzamiento
        self.formato = formato
        self.genero = genero
    
    def getId(self):
        """Retorna el ID de la musica."""
        return self.id_musica
    
    def getTitulo(self):
        """Retorna el titulo de la musica."""
        return self.titulo
    def getArtistaBanda(self):
        """Retorna el artista de la banda de la musica."""
        return self.artista_banda