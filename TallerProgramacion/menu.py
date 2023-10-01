import os
import time
opcion = 1
while (opcion != 5):
    selecto = True
    key = input("Ingresa la llave foranea: ")
    os.system("cls")
    opcion = int(input("Que opcion deseas realizar\n1) Crear Dato en la BD\n2) Leer Dato en la BD\n3) Actualizar Dato en la BD\n4) Eliminar Dato en la BD\n5) Salir"))
    if opcion == 1:
        print ("hola")
    elif opcion == 5:
        os.system("cls")
        time.sleep(1)
        print("Cerrando Programa...")
    else:
        print("Opción inválida")