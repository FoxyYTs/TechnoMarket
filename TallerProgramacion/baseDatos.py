import sqlite3

conn=sqlite3.connect('TallerProgramacion/musicadb.db')

c=conn.cursor()

c.execute("""CREATE TABLE IF NOT EXISTS musica (
        titulo VARCHAR(45),
        artista VARCHAR(45),
        duracion VARCHAR (45),
        año_lanzamiento INT,
        formato VARCHAR(5),
        genero VARCHAR(45)
)""")