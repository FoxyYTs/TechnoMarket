from Funciones import *

print("Bienvenido al sistema de validación de expresiones regulares")
fc=Funciones
opcion=0
while(opcion!=5):
    opcion = int(input("Menú:\n0) Validar la expresión 1\n1) Validar correo\n2) Validar telefono\n3) Validar password\n4) Validar expresion 2\n5) Salir\nSELECCION: "))
    if (opcion == 1):
        email = input("Escriba su correo electronico: ")
        fc.ValidarEmail(email)
    elif (opcion == 2):
        telefono = input("Escriba su telefono: ")
        fc.ValidarTelefono(telefono)
    elif (opcion == 3):
        password = input("Escriba su password: ")  
        fc.ValidarPassword(password)
    elif (opcion == 0):
        ER = input("Escriba su expresion regular: ")
        fc.ValidarER_repaso(ER)
    elif (opcion == 4):
        ER1 = input("Escriba su expresion regular: ")
        fc.ValidarER(ER1)
    elif (opcion == 5):
        print("Gracias por utilizar el sistema de validación de expresiones regulares")