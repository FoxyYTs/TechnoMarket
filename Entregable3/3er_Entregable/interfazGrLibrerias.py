import tkinter as tk
class interfaz:
    def __init__(self):
        self.ventana = tk.Tk()
        self.ventana.title("Libreria")
        self.ventana.resizable(False, False)

        self.ventana.mainloop()

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