import tkinter as tk
from tkinter import messagebox,ttk
from Books import Books

class interfazGrLibros:
    def __init__(self):
        self.winPrincipal = tk.Tk()
        self.winPrincipal.title("Libros")
        self.winPrincipal.resizable(False, False)
        self.frameDatosPelicula = tk.Frame(self.winPrincipal)
        self.frameDatosPelicula.grid(row=0, column=0, padx=5, pady=5)
        self.frameBotonesSuperior = tk.Frame(self.winPrincipal)
        self.frameBotonesSuperior.grid(row=1, column=0, padx=5, pady=5)
        self.frameBaseDeDatos = tk.Frame(self.winPrincipal)
        self.frameBaseDeDatos.grid(row=2, column=0, padx=5, pady=5)
        self.frameBotonesLateral = tk.Frame(self.winPrincipal)
        self.frameBotonesLateral.grid(row=2,column=1, padx=5, pady=5)
        
        
        self.Books = Book()
        self.camposDeTexto()
        self.botonesSuperiores()
        self.crearTabla()
        self.vincularBaseDeDatos()
        self.botonesLateral()
        self.winPrincipal.mainloop()
        
    def crear(self):
        self.tablaBaseDeDatos = ttk.Treeview(self.frameBaseDeDatos,show="headings")
        self.tablaBaseDeDatos.config(columns=("ID", "bookTitle", "authorName", "libraryId"))
        self.tablaBaseDeDatos.heading("ID", text="ID")
        self.tablaBaseDeDatos.heading("bookTitle", text="bookTitle")
        self.tablaBaseDeDatos.heading("authorName", text="authorName")
        self.tablaBaseDeDatos.heading("libraryId", text="libraryId")
        self.tablaBaseDeDatos.grid(row=0, column=0)
        
    def camposDeTexto(self):
        self.variableNombre = tk.StringVar()
        self.textoNombre = tk.Label(self.frameDatosPelicula, text="bookTitle: ")
        self.textoNombre.grid(row=0, column=0)
        self.cuadroNombre = tk.Entry(self.frameDatosPelicula, textvariable=self.variableNombre)
        self.cuadroNombre.grid(row=0, column=1)
        
        self.variableDuracion = tk.StringVar()
        self.textoDuracion = tk.Label(self.frameDatosPelicula, text="authorName: ")
        self.textoDuracion.grid(row=1, column=0)
        self.cuadroDuracion = tk.Entry(self.frameDatosPelicula, textvariable=self.variableDuracion)
        self.cuadroDuracion.grid(row=1, column=1)
        
        self.variableGenero = tk.StringVar()
        self.textoGenero = tk.Label(self.frameDatosPelicula, text="LibraryId: ")
        self.textoGenero.grid(row=2, column=0)
        self.cuadroGenero = tk.Entry(self.frameDatosPelicula, textvariable=self.variableGenero)
        self.cuadroGenero.grid(row=2, column=1)
        
    def botonesSuperiores(self):
        self.botonNuevo = tk.Button(self.frameBotonesSuperior,text="Nuevo", bg="yellow", command=self.funcionNuevo)
        self.botonNuevo.grid(row=0, column=0, padx=5)
        
        self.botonGuardar = tk.Button(self.frameBotonesSuperior,text="Guardar", bg="yellow", command=self.funcionGuardar)
        self.botonGuardar.grid(row=0, column=1, padx=5)
        
        self.botonCancelar = tk.Button(self.frameBotonesSuperior,text="Cancelar", bg="yellow", command=self.funcionCancelar)
        self.botonCancelar.grid(row=0, column=2, padx=5)
        
    def funcionNuevo(self):
        self.variableNombre.set('')
        self.variableDuracion.set('')
        self.variableGenero.set('')       
        self.cuadroNombre.config(state='normal')
        self.cuadroDuracion.config(state='normal')
        self.cuadroGenero.config(state='normal')     
        self.botonGuardar.config(state='normal')
        self.botonCancelar.config(state='normal')
        
    def funcionCancelar(self):
        self.variableNombre.set('')
        self.variableDuracion.set('')
        self.variableGenero.set('')       
        self.cuadroNombre.config(state='disabled')
        self.cuadroDuracion.config(state='disabled')
        self.cuadroGenero.config(state='disabled')     
        self.botonGuardar.config(state='disabled')
        self.botonCancelar.config(state='disabled')        
        
    def funcionGuardar(self):
        self.Books.bookTitle = self.variableNombre.get()
        self.Books.authorName = self.variableDuracion.get()
        self.Books.LibraryId = self.variableGenero.get()
        self.Books.agregarDato()
        self.vincularBaseDeDatos()
        
    def vincularBaseDeDatos(self):
        self.Books.verTabla()
        self.tablaBaseDeDatos.delete(*self.tablaBaseDeDatos.get_children())
        for fila in self.Books.datosEnLaTabla:
            self.tablaBaseDeDatos.insert("","end",values=fila)
            
    def botonesLateral(self):
        self.variableID = tk.IntVar()
        self.textoID = tk.Label(self.frameBotonesLateral, text="ID: ")
        self.textoID.grid(row=0, column=0)
        self.cuadroID = tk.Entry(self.frameBotonesLateral, textvariable=self.variableID)
        self.cuadroID.grid(row=1, column=0)        
        
        self.botonEditar = tk.Button(self.frameBotonesLateral,text="Editar", bg="yellow", command=self.funcionEditar)
        self.botonEditar.grid(row=2, column=0, pady=5)
        
        self.botonEliminar = tk.Button(self.frameBotonesLateral,text="Eliminar", bg="yellow", command=self.funcionEliminar)
        self.botonEliminar.grid(row=3, column=0, pady=5)  
        
    def funcionEditar(self):
        if self.variableNombre.get():
            self.Books.actualizarDatos("Books","bookTitle",self.variableNombre.get(),self.variableID.get())   
            
        if self.variableDuracion.get():
            self.Books.actualizarDatos("Books","authorName",self.variableDuracion.get(),self.variableID.get())  
            
        if self.variableGenero.get():
            self.Books.actualizarDatos("Books","LibraryId",self.variableGenero.get(),self.variableID.get())  
        
        self.vincularBaseDeDatos()
        
    def funcionEliminar(self):
        self.Books.eliminarDatos("Books",self.variableID.get())
        messagebox.showinfo("Base de datos Books","Se eliminaron los datos en la tabla.")
        self.vincularBaseDeDatos()
        
aplicacion = interfazGrLibros()