import os
import time

from Musica import Musica

from CRUD import Crud as fc

opcion = 1
while (opcion != 5):
    selecto = True
    key = input("Ingresa la llave foranea: ")
    try:
        cancion = Musica(id_musica)
    except:
        print("ERROR FATAL")
    os.system("cls")
    opcion = int(input("Que opcion deseas realizar\n1) Crear Dato en la BD\n2) Mostrar Dato en la BD\n3) Actualizar Dato en la BD\n4) Eliminar Dato en la BD\n5) Salir"))
    if opcion == 1:
        cont_musica
        titulo=input("Ingrese el titulo de la cancion")
        artista_banda=input("Ingrese el nombre del artista o banda")
        duracion=input("Ingrese la duracion de la cancion, formato 00:00") 
        ano_lanzamiento=int(input("Ingrese el año en que se lanzó la canción"))
        formato=input("Ingrese el formato de la cancion mp3, mp4, etc")
        genero=input("Ingrese el genero de la cancion")
    elif opcion == 2:
        titulo=input("Ingrese el titulo de la cancion")
        fc.mostrar_cancion(titulo)
    elif opcion == 3:
        tabla=input("Ingrese el nombre de la tabla donde hará la modificación")
        id=int(input("Ingrese la id general del dato a modificar"))
        atributo=input("Ingrese el nombre del atributo que desea modificar")
        dato=input("Ingrese el nuevo dato") 
        fc.actualizar(tabla, atributo, dato, id)
    elif opcion == 4:
        id=int(input("Ingrese la id general del dato a eliminar"))
        fc.eliminar(id)
    elif opcion == 5:
        os.system("cls")
        time.sleep(1)
        print("Cerrando Programa...")
    else:
        print("Opción inválida")