import sqlite3

conn=sqlite3.connect('musicadb')
c=conn.cursor()

c.execute("""CREATE TABLE IF NOT EXISTS musica (
        titulo VARCHAR
        artista
        duracion
        fecha_lanzamiento
        formato
        rating
)""")