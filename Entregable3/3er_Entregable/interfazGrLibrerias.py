import tkinter as tk
from tkinter import messagebox,ttk

class interfazGrLibrerias:
    def _int_(self):
        self.winPrincipal = tk.Tk()
        self.winPrincipal.title("Librerias")
        self.frameDatosLibrary= tk.Frame(self.winPrincipal)
        self.frameDatosLibrary.grid(row=0,column=0)
        
        self.campos()
        self.winPrincipal.mainloop()

    def campos(self):
        self.varNombre=tk.StringVar()
        self.txtNombre=tk.Label(self.frameDatosLibrary,text="Nombre: ")
        self.txtNombre.grid(row=0, column=0)
        self.cuadroNombre=tk.Entry(self.frameDatosLibrary)
        self.cuadroNombre.grid(row=0, column=1)
        
        self.varCuidad=tk.StringVar()
        self.txtCuidad=tk.Label(self.frameDatosLibrary,text="Cuidad: ")
        self.txtCuidad.grid(row=1, column=0)
        self.cuadroCuidad=tk.Entry(self.frameDatosLibrary)
        self.cuadroCuidad.grid(row=1, column=1)
        
aplicacion = interfaz()