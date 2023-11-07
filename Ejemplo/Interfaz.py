import tkinter as tk
import sv_ttk
from tkinter import messagebox, ttk
from Zoo import Zoo
from Animal import Animal

class Interfaz:
    def __init__(self):
        """
        Inicializa la instancia de la clase.
        """
        self.zoo = Zoo()
        self.animal = Animal()
        self.ventanaPrincipal = tk.Tk()
        self.ventanaPrincipal.title("Gestor de base de datos de Zoologico")
        self.ventanaPrincipal.resizable(False, False)

        self.nb = ttk.Notebook(self.ventanaPrincipal)
        self.nb.pack(fill = "both", expand = "yes")
        
        # GESTOR DE ZOOLOGICOS
        self.frameZoo = tk.Frame(self.ventanaPrincipal)
        self.frameZoo.config(width = 5)
        self.frameEncabezadoZoo = tk.Frame(self.frameZoo)
        self.frameEncabezadoZoo.grid(row = 0, column = 0)
        self.labelzoo = tk.Label(self.frameEncabezadoZoo, text = "ZOOLOGICO")
        self.labelzoo.config(font = ("Comic Sans MS", 15, "bold"), foreground = "#428C00")
        self.labelzoo.grid(row = 0, column = 1)
        
        self.frameInfoZoo = tk.Frame(self.frameZoo)
        self.frameInfoZoo.grid(row = 1, column = 0,)
        self.zooCampo()

        self.frameInfoZooBoton = tk.Frame(self.frameZoo)
        self.frameInfoZooBoton.grid(row = 2, column = 0)
        self.zooBotones()

        self.frameZooTabla = tk.Frame(self.frameZoo)
        self.frameZooTabla.grid(row = 3, column = 0)
        self.zooTabla()
        self.mostrarZoo()

        self.frameZooModificar = tk.Frame(self.frameZoo)
        self.frameZooModificar.grid(row = 1, column = 2)
        self.modZoo()

        # GESTOR DE ANIMALES
        self.frameAnimales = tk.Frame(self.ventanaPrincipal)
        self.frameEncabezadoAnimales = tk.Frame(self.frameAnimales)
        self.frameEncabezadoAnimales.grid(row = 0, column = 0)
        self.animales = tk.Label(self.frameEncabezadoAnimales, text = "ANIMALES")
        self.animales.config(font = ("Papyrus", 15, "bold"), foreground = "#428C00")
        self.animales.grid(row = 0, column = 0)

        self.frameInfoAnimales = tk.Frame(self.frameAnimales)
        self.frameInfoAnimales.grid(row = 1, column = 0)
        self.animalCampo()

        self.frameInfoAnimalBoton = tk.Frame(self.frameAnimales)
        self.frameInfoAnimalBoton.grid(row = 2, column = 0)
        self.animalBotones()

        self.frameAnimalTabla = tk.Frame(self.frameAnimales)
        self.frameAnimalTabla.grid(row = 3, column = 0)
        self.animalTabla()
        self.mostrarAnimal()

        self.frameAnimalModificar = tk.Frame(self.frameAnimales)
        self.frameAnimalModificar.grid(row = 4, column = 0)
        self.modAnimal()

        # CARGADO DE LA INTERFAZ
        sv_ttk.use_dark_theme()
        self.nb.add(self.frameZoo, text = "ZOOLOGICOS")
        self.nb.add(self.frameAnimales, text = "ANIMALES")
        self.focusVentana()
        self.ventanaPrincipal.mainloop()

    # CENTRAR VENTANA
    def focusVentana(self):
        """
        Actualiza las tareas de la ventana principal, calcula el ancho y alto de la ventana,
        y establece la posición de la ventana en el centro de la pantalla.

        Parámetros:
        Ninguno

        Retorna:
        Nada
        """
        self.ventanaPrincipal.update_idletasks()
        ancho = self.ventanaPrincipal.winfo_width()
        alto = self.ventanaPrincipal.winfo_height()
        x = (self.ventanaPrincipal.winfo_screenwidth() // 2) - (ancho // 2)
        y = (self.ventanaPrincipal.winfo_screenheight() // 2) - (alto // 2)
        self.ventanaPrincipal.geometry('{}x{}+{}+{}'.format(ancho, alto, x, y))


    # CAMPOS DE INFO ZOO
    def zooCampo(self):
        """
        Crea una GUI para ingresar información sobre un Zoo.

        Parámetros:
            Ninguno

        Retorna:
            Ninguno
        """
        self.labelZooName = tk.Label(self.frameInfoZoo, text = "Nombre: ")
        self.labelZooName.config(font = ("Papyrus", 10, "bold"))
        self.labelZooName.grid(row = 0, column = 0)

        self.varZooName = tk.StringVar()
        self.campoZooName = tk.Entry(self.frameInfoZoo, textvariable = self.varZooName)
        self.campoZooName.grid(row = 0, column = 1, padx = 5, pady = 5)

        self.labelZooUbi = tk.Label(self.frameInfoZoo, text = "Ubicacion: ")
        self.labelZooUbi.config(font = ("Papyrus", 10, "bold"))
        self.labelZooUbi.grid(row = 1, column = 0)

        self.varZooUbi = tk.StringVar()
        self.campoZooUbi = tk.Entry(self.frameInfoZoo, textvariable = self.varZooUbi)
        self.campoZooUbi.grid(row = 1, column = 1, padx = 5, pady = 5)

    # CAMPOS DE INFO ANIMAL
    def animalCampo(self):
        """
        Crea una GUI para ingresar información sobre un animal.

        Parámetros:
            Ninguno

        Retorna:
            Ninguno
        """
        self.labelAnimalName = tk.Label(self.frameInfoAnimales, text = "Nombre: ")
        self.labelAnimalName.config(font = ("Papyrus", 10, "bold"))
        self.labelAnimalName.grid(row = 0, column = 0)

        self.varAnimalName = tk.StringVar()
        self.campoAnimalName = tk.Entry(self.frameInfoAnimales, textvariable = self.varAnimalName)
        self.campoAnimalName.grid(row = 0, column = 1, padx = 5, pady = 5)

        self.labelAnimalSpecie = tk.Label(self.frameInfoAnimales, text = "Especie: ")
        self.labelAnimalSpecie.config(font = ("Papyrus", 10, "bold"))
        self.labelAnimalSpecie.grid(row = 1, column = 0)

        self.varAnimalSpecie = tk.StringVar()
        self.campoAnimalSpecie = tk.Entry(self.frameInfoAnimales, textvariable = self.varAnimalSpecie)
        self.campoAnimalSpecie.grid(row = 1, column = 1, padx = 5, pady = 5)

        self.labelZooID = tk.Label(self.frameInfoAnimales, text = "ID ZOO: ")
        self.labelZooID.config(font = ("Papyrus", 10, "bold"))
        self.labelZooID.grid(row = 2, column = 0)

        self.varZooID = tk.IntVar()
        self.campoZooID = tk.Entry(self.frameInfoAnimales, textvariable = self.varZooID)
        self.campoZooID.grid(row = 2, column = 1, padx = 5, pady = 5)

    # CONTROLES ZOO

    def zooBotones(self):
        """
        Crea tres botones para el zoo: "Nuevo", "Guardar" y "Cancelar".
        Los botones se crean utilizando la clase tk.Button y se agregan al 
        frameInfoZooBoton. Cada botón se le asigna un comando que se ejecuta 
        cuando se hace clic en el botón. Los botones se disponen en una fila con 
        un espaciado de 10 píxeles entre cada botón.

        Parámetros:
        Ninguno

        Retorna:
        Nada
        """
        self.zooBotonNuevo = tk.Button(self.frameInfoZooBoton, text = "Nuevo", bg = "#428C00", command = self.funcionZooNuevo)
        self.zooBotonNuevo.grid(row = 0, column = 0, padx = 10)

        self.zooBotonGuardar = tk.Button(self.frameInfoZooBoton, text = "Guardar", bg = "#428C00", command = self.funcionZooGurdar)
        self.zooBotonGuardar.grid(row = 0, column = 1, padx = 10)

        self.zooBotonCancelar = tk.Button(self.frameInfoZooBoton, text = "Cancelar", bg = "#428C00", command = self.funcionZooCancelar)
        self.zooBotonCancelar.grid(row = 0, column = 2, padx = 10)

    # CONTROLES ANIMAL
    def animalBotones(self):
        """
        Crea tres botones para el animal: "Nuevo", "Guardar" y "Cancelar".
        Los botones se crean utilizando la clase tk.Button y se agregan al 
        frameInfoAnimalBoton. Cada botón se le asigna un comando que se ejecuta 
        cuando se hace clic en el botón. Los botones se disponen en una fila con 
        un espaciado de 10 píxeles entre cada botón.

        Parámetros:
        Ninguno

        Retorna:
        Nada
        """
        self.animalBotonNuevo = tk.Button(self.frameInfoAnimalBoton, text = "Nuevo", bg = "#428C00", command = self.funcionAnimalNuevo)
        self.animalBotonNuevo.grid(row = 0, column = 0, padx = 10)

        self.animalBotonGuardar = tk.Button(self.frameInfoAnimalBoton, text = "Guardar", bg = "#428C00", command = self.funcionAnimalGuardar)
        self.animalBotonGuardar.grid(row = 0, column = 1, padx = 10)

        self.animalBotonCancelar = tk.Button(self.frameInfoAnimalBoton, text = "Cancelar", bg = "#428C00", command = self.funcionAnimalCancelar)
        self.animalBotonCancelar.grid(row = 0, column = 2, padx = 10)

    # EVENTLISTENER BOTONES ZOO
    def funcionZooNuevo(self):
        """
        Inicializa los atributos de la clase Zoo con sus valores predeterminados y configura los elementos de la GUI para agregar un nuevo zoo.

        Parámetros:
        self (Zoo): La instancia de la clase Zoo.

        Retorna:
        Ninguno
        """
        self.varZooName.set("")
        self.varZooUbi.set("")
        self.campoZooName.config(state = "normal")
        self.campoZooUbi.config(state = "normal")
        self.zooBotonGuardar.config(state = "normal")
        self.zooBotonCancelar.config(state = "normal")

    def funcionZooGurdar(self):
        """
        Función para guardar la información del zoo en la base de datos y mostrarla.

        Parámetros:
        - self: La instancia de la clase.

        Retorno:
        - Ninguno
        """
        if self.varZooName.get() and self.varZooUbi.get():
            self.zoo.nombre = self.varZooName.get()
            self.zoo.ubicacion = self.varZooUbi.get()
            self.zoo.insertarTabla()
            self.mostrarZoo()
            self.funcionZooCancelar()
        else:
            messagebox.showwarning("Alerta", "Debes rellenar todos los campos")

    def funcionZooCancelar(self):
        """
        Establece los valores de `varZooName` y `varZooUbi` como cadenas vacías, deshabilita los campos `campoZooName`
        y `campoZooUbi`, y deshabilita los botones `zooBotonGuardar` y `zooBotonCancelar`.
        """
        self.varZooName.set("")
        self.varZooUbi.set("")
        self.campoZooName.config(state = "disabled")
        self.campoZooUbi.config(state = "disabled")
        self.zooBotonGuardar.config(state = "disabled")
        self.zooBotonCancelar.config(state = "disabled")

    # EVENTLISTENER BOTONES ANIMAL
    def funcionAnimalNuevo(self):
        """
        Inicializa los atributos de la clase Animal con sus valores predeterminados y configura los elementos de la GUI para agregar un nuevo Animal.

        Parámetros:
        self (Animal): La instancia de la clase Animal.

        Retorna:
        Ninguno
        """
        self.varAnimalName.set("")
        self.varAnimalSpecie.set("")
        self.varZooID.set(0)
        self.campoAnimalName.config(state = "normal")
        self.campoAnimalSpecie.config(state = "normal")
        self.campoZooID.config(state = "normal")
        self.animalBotonGuardar.config(state = "normal")
        self.animalBotonCancelar.config(state = "normal")

    def funcionAnimalGuardar(self):
        """
        Función para guardar la información del Animal en la base de datos y mostrarla.

        Parámetros:
        - self: La instancia de la clase.

        Retorno:
        - Ninguno
        """
        try:
            if self.varAnimalName.get() and self.varAnimalSpecie.get() and self.varZooID.get():
                if self.zoo.BuscarId(self.varZooID.get(), "Zoos"):
                    self.animal.nombre = self.varAnimalName.get()
                    self.animal.especie = self.varAnimalSpecie.get()
                    self.animal.zooID = self.varZooID.get()
                    self.animal.InsertarTabla()
                    self.mostrarAnimal()
                    self.funcionAnimalCancelar()
                else:
                    messagebox.showwarning("Alerta", "El Zoológico no Existe")
            else:
                messagebox.showwarning("Alerta", "Debes rellenar todos los campos")
        except:
            messagebox.showerror("Error", "No se pudo Guardar en la Tabla")

    def funcionAnimalCancelar(self):
        """
        Establece los valores de `varAnimalName`, `varAnimalSpecie` y `varZooID` como cadenas vacías, deshabilita los campos `campoAnimalName`
        , `campoAnimalSpecie` y `campoZooID`, y deshabilita los botones `AnimalBotonGuardar` y `AnimalBotonCancelar`.
        """
        self.varAnimalName.set("")
        self.varAnimalSpecie.set("")
        self.varZooID.set("")
        self.campoAnimalName.config(state = "disabled")
        self.campoAnimalSpecie.config(state = "disabled")
        self.campoZooID.config(state = "disabled")
        self.animalBotonGuardar.config(state = "disabled")
        self.animalBotonCancelar.config(state = "disabled")
    
    # DB ZOO
    def zooTabla(self):
        """
        Inicializa un widget Treeview para mostrar una tabla de datos de un Zoo.

        Parámetros:
            self (objeto): La instancia de la clase.
        
        Retorna:
            Ninguno
        """
        self.tablaZoo = ttk.Treeview(self.frameZooTabla, show = "headings")
        self.tablaZoo.config(columns = ("ID", "Nombre", "Ubicación"))
        self.tablaZoo.heading("ID", text = "ID")
        self.tablaZoo.heading("Nombre", text = "NOMBRE")
        self.tablaZoo.heading("Ubicación", text = "UBICACION")
        self.tablaZoo.grid(row = 0, column = 0)

        self.zooScroll = tk.Scrollbar(self.frameZooTabla, command = self.tablaZoo.yview)
        self.zooScroll.grid(row = 0, column = 1, sticky = "ns")
        self.tablaZoo.config(yscrollcommand = self.zooScroll.set)

    # DB ANIMAL
    def animalTabla(self):
        """
        Inicializa un widget Treeview para mostrar una tabla de datos de un Animal.

        Parámetros:
            self (objeto): La instancia de la clase.
        
        Retorna:
            Ninguno
        """
        self.tablaAnimal = ttk.Treeview(self.frameAnimalTabla, show = "headings")
        self.tablaAnimal.config(columns = ("ID", "Nombre", "Especie", "Zoo_ID"))
        self.tablaAnimal.heading("ID", text = "ID")
        self.tablaAnimal.heading("Nombre", text = "NOMBRE")
        self.tablaAnimal.heading("Especie", text = "ESPECIE")
        self.tablaAnimal.heading("Zoo_ID", text = "ZOO_ID")
        self.tablaAnimal.grid(row = 0, column = 0)
        
        self.AnimalScroll = tk.Scrollbar(self.frameAnimalTabla, command = self.tablaAnimal.yview)
        self.AnimalScroll.grid(row = 0, column = 1, sticky = "ns")
        self.tablaAnimal.config(yscrollcommand = self.AnimalScroll.set)

    # MOSTRAR DATOS ZOO EN INTERFAZ
    def mostrarZoo(self):
        
        """
        Muestra los datos del zoo en formato tabular.

        Esta función lee los datos del zoo de la tabla y los muestra en formato tabular. Primero llama al método `leerTabla` del objeto `zoo` para leer los datos. Luego, borra las filas existentes en el widget `tablaZoo` utilizando el método `delete`. Después de eso, itera sobre cada fila en la lista `datosEnLaTabla` del objeto `zoo` y inserta los valores de la fila en el widget `tablaZoo` utilizando el método `insert`.

        Parámetros:
            self (object): La instancia de la clase.

        Retorna:
            None
        """
        try:
            self.zoo.leerTabla()
            self.tablaZoo.delete(*self.tablaZoo.get_children())
            for fila in self.zoo.datosEnLaTabla:
                self.tablaZoo.insert("", "end", values = fila)
        except:
            messagebox.showwarning("Error", "No se pudo leer la tabla")

    # MOSTRAR DATOS ANIMAL EN INTERFAZ
    def mostrarAnimal(self):
        """
        Muestra los datos del Animal en formato tabular.

        Esta función lee los datos del Animal de la tabla y los muestra en formato tabular. Primero llama al método `leerTabla` del objeto `Animal` para leer los datos. Luego, borra las filas existentes en el widget `tablaAnimal` utilizando el método `delete`. Después de eso, itera sobre cada fila en la lista `datosEnLaTabla` del objeto `Animal` y inserta los valores de la fila en el widget `tablaAnimal` utilizando el método `insert`.

        Parámetros:
            self (object): La instancia de la clase.

        Retorna:
            None
        """
        try:
            self.animal.leerTabla()
            self.tablaAnimal.delete(*self.tablaAnimal.get_children())
            for fila in self.animal.datosEnLaTabla:
                self.tablaAnimal.insert("", "end", values = fila)
        except:
            messagebox.showwarning("Error", "No se pudo leer la tabla")

    # MODIFICAR DATOS TABLA ZOO
    def modZoo(self):
        """
        Inicializa los elementos de la GUI para la función de modificación del zoo.

        Esta función crea y configura los elementos de etiqueta, campo de entrada y botones necesarios para la función de modificación del zoo.

        Parámetros:
            self (objeto): La instancia de la clase.

        Retorna:
            Ninguno
        """
        self.labelZooModificarID = tk.Label(self.frameZooModificar, text = "ID: ")
        self.labelZooModificarID.config(font = ("Comic Sans MS", 10, "bold"))
        self.labelZooModificarID.grid(row = 0, column = 0)

        self.varZooModificarID = tk.IntVar()
        self.campoZooModificarID = tk.Entry(self.frameZooModificar, textvariable = self.varZooModificarID)
        self.campoZooModificarID.grid(row = 0, column = 1, padx = 5, pady = 5, columnspan = 2)

        self.zooBotonEditar = tk.Button(self.frameZooModificar, text = "Editar", bg = "#428C00", command = self.funcionEditarZoo)
        self.zooBotonEditar.grid(row = 1, column = 1, padx = 10)

        self.zooBotonEliminar = tk.Button(self.frameZooModificar, text = "Eliminar", bg = "#428C00", command = self.funcionEliminarZoo)
        self.zooBotonEliminar.grid(row = 1, column = 2, padx = 10)
    
    # MODIFICAR DATOS TABLA ANIMAL
    def modAnimal(self):
        """
        Inicializa los elementos de la GUI para la función de modificación del Animal.

        Esta función crea y configura los elementos de etiqueta, campo de entrada y botones necesarios para la función de modificación del Animal.

        Parámetros:
            self (objeto): La instancia de la clase.

        Retorna:
            Ninguno
        """        
        self.labelAnimalModificarID = tk.Label(self.frameAnimalModificar, text = "ID: ")
        self.labelAnimalModificarID.config(font = ("Papyrus", 10, "bold"))
        self.labelAnimalModificarID.grid(row = 0, column = 0)

        self.varAnimalModificarID = tk.IntVar()
        self.campoAnimalModificarID = tk.Entry(self.frameAnimalModificar, textvariable = self.varAnimalModificarID)
        self.campoAnimalModificarID.grid(row = 0, column = 1, padx = 5, pady = 5, columnspan = 2)

        self.animalBotonEditar = tk.Button(self.frameAnimalModificar, text = "Editar", bg = "#428C00", command = self.funcionEditarAnimal)
        self.animalBotonEditar.grid(row = 1, column = 1, padx = 10)

        self.animalBotonEliminar = tk.Button(self.frameAnimalModificar, text = "Eliminar", bg = "#428C00", command = self.funcionEliminarAnimal)
        self.animalBotonEliminar.grid(row = 1, column = 2, padx = 10)

    # EVENTLISTENER BOTONES MOD ZOO
    def funcionEditarZoo(self):
        """
        Edita una entrada de zoo en la base de datos.

        Parámetros:
            self (objeto): La instancia de la clase.
        
        Retorna:
            Ninguno
        """
        try:
            if self.varZooModificarID.get():
                if self.varZooName.get():
                    confirmar = messagebox.askokcancel("Zoos", f"¿Desea Modificar los Datos de: {self.varAnimalModificarID.get()}?")
                    if confirmar:
                        if self.zoo.editarTabla(self.varZooName.get(), "NOMBRE", self.varZooModificarID.get()):
                            self.mostrarZoo()
                        else:
                            messagebox.showwarning("Error", "No se encontro el Zoologico")

                if self.varZooUbi.get():
                    confirmar = messagebox.askokcancel("Zoos", f"¿Desea Modificar los Datos de: {self.varAnimalModificarID.get()}?")
                    if confirmar:
                        if self.zoo.editarTabla(self.varZooUbi.get(), "UBICACION", self.varZooModificarID.get()):
                            self.mostrarZoo()
                        else:
                            messagebox.showwarning("Error", "No se encontro el Zoologico")
            else:
                messagebox.showerror("Error", "Falta Informacion.")
        except:
            messagebox.showerror("Error", "No se pudo editar.")

    def funcionEliminarZoo(self):
        """
        Elimina un registro de zoo de la base de datos si el usuario confirma la eliminación.
        
        Parámetros:
            self (object): La instancia de la clase.
        
        Retorna:
            None
        
        Arroja:
            None
        """
        try:
            if self.varZooModificarID.get():
                confirmar = messagebox.askokcancel("Zoos", f"¿Desea Eliminar el Registro: {self.varZooModificarID.get()}?")
                if confirmar:
                    if self.zoo.eliminarTabla(self.varZooModificarID.get()):
                        self.animal.eliminarTodo(self.varZooModificarID.get())
                        self.mostrarZoo()
                        self.mostrarAnimal()
                    else:
                        messagebox.showwarning("Error", "No se encontro el Zoologico")
            else:
                messagebox.showerror("Error", "Falta Informacion.")
        except:
            messagebox.showerror("Error", "No se pudo eliminar.")
    
    # EVENTLISTENER BOTONES MOD ANIMAL

    def funcionEditarAnimal(self):
        """
        Edita una entrada de zoo en la base de datos.

        Parámetros:
            self (objeto): La instancia de la clase.
        
        Retorna:
            Ninguno
        """
        try:
            if self.varAnimalModificarID.get():
                if self.varAnimalName.get():
                    confirmar = messagebox.askokcancel("Animals", f"¿Desea Modificar los Datos de: {self.varAnimalModificarID.get()}?")
                    if confirmar:
                        if self.animal.editarTabla(self.varAnimalName.get(), "NOMBRE", self.varAnimalModificarID.get()):
                            self.mostrarAnimal()
                        else:
                            messagebox.showwarning("Error", "No se encontro el Animal")

                if self.varAnimalSpecie.get():
                    confirmar = messagebox.askokcancel("Animals", f"¿Desea Modificar los Datos de: {self.varAnimalModificarID.get()}?")
                    if confirmar:
                        if self.animal.editarTabla(self.varAnimalSpecie.get(), "ESPECIE", self.varAnimalModificarID.get()):
                            self.mostrarAnimal()
                        else:
                            messagebox.showwarning("Error", "No se encontro el Animal")
                try:
                    if self.varZooID.get():
                        if self.zoo.BuscarId(self.varZooID.get(), "Zoos"):
                            confirmar = messagebox.askokcancel("Animals", f"¿Desea Modificar los datos de: {self.varAnimalModificarID.get()}?")
                            if confirmar:
                                if self.animal.editarTabla(self.varZooID.get(), "ZOO_ID", self.varAnimalModificarID.get()):
                                    self.mostrarAnimal()
                                else:
                                    messagebox.showwarning("Error", "No se encontro el Animal")
                        else:
                            messagebox.showwarning("Error", "No se encontro el Zoo")
                except:
                    pass
            else:
                messagebox.showerror("Error", "Falta Informacion.")
        except:
            messagebox.showerror("Error", "No se pudo editar.")

    def funcionEliminarAnimal(self):
        """
        Elimina un registro de Animal de la base de datos si el usuario confirma la eliminación.
        
        Parámetros:
            self (object): La instancia de la clase.
        
        Retorna:
            None
        
        Arroja:
            None
        """
        try:
            if self.varAnimalModificarID.get():
                confirmar = messagebox.askokcancel("Animals", f"¿Desea Eliminar el Registro: {self.varAnimalModificarID.get()}?")
                if confirmar:
                    if self.animal.eliminarTabla(self.varAnimalModificarID.get()):
                        self.mostrarAnimal()
                    else:
                        messagebox.showwarning("Error", "No se encontro el Animal")
            else:
                messagebox.showerror("Error", "Falta Informacion.")
        except:
            messagebox.showerror("Error", "No se pudo eliminar.")