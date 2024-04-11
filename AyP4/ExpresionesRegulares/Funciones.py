import re

class Funciones:
    def ValidarER_repaso(er):

        EspresionRegular = "^Anags[#?,.](0[1-9]|1[0-9]|2[0-9]|3[0-1])(0[1-9]|1[0-2])$"
        validation=re.findall(EspresionRegular, er)
        print(validation)

        if (validation):
            print("El correo es correcto!")
        else:
            print("No cumple con la expresión")
    def ValidarER(er):

        EspresionRegular = "^[A-Z]{1}[a-z]{2,9}[#?,.](0[1-9]|1[0-9]|2[0-9]|3[0-1])(0[1-9]|1[0-2])$"
        validation=re.findall(EspresionRegular, er)
        print(validation)

        if (validation):
            print("El correo es correcto!")
        else:
            print("No cumple con la expresión")
    def ValidarEmail(email):

        EspresionRegular = "([algoritmos|ayp|ALGORITMOS|AYP])[1-4]{1}poli[@][A-Za-z0-9]{1,8}[.]com|edu.co$"#"^[a-z]\w*@elpoli.edu.co$"
        validation=re.findall(EspresionRegular, email)
        print(validation)

        if (validation):
            print("El correo es correcto!")
        else:
            print("No cumple con la expresión")
    def ValidarTelefono(telefono):

        EspresionRegular ="^[+0-9]{1,3}[?20|32|1|40|92][(][3,4,6,1]{1}[0-9]{2}[)][0-9]{7}$" #"^[0-9]{7,10}$"
        validation=re.findall(EspresionRegular, telefono)
        print(validation)

        if (validation):
            print("El telefono es correcto!")
        else:
            print("No cumple con la expresión")

    def ValidarPassword(password):

        EspresionRegular = "[a-zA-Z0-9@._]{8,15}$"
        validation=re.findall(EspresionRegular, password)
        print(validation)

        if (validation):
            print("La contraseña es correcta!")
        else:
            print("No cumple con la expresión")

