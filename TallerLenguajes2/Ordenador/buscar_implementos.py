import tkinter as tk
from tkinter import messagebox, ttk

import mysql.connector
import conexion

class BuscarImplementos:
    def __init__(self, contenedor):
        self.frame = tk.Frame(contenedor, bg="gray")
        self.frame.pack(fill="both", expand=True)

        label_busca = tk.Label(self.frame, bg="#D3D3D3")
        label_busca.grid(row=0, column=0, padx=10, pady=10)

        etiqueta = tk.Label(label_busca, text="Buscar Insumo", font=("Arial", 16, "bold"), fg="blue", bg="#D3D3D3")
        etiqueta.grid(row=0, column=0, padx=10, pady=10)

        instruccion = tk.Label(label_busca, text="Ingrese el ID o el nombre del insumo a buscar:", font=("Arial", 12), bg="#D3D3D3")
        instruccion.grid(row=1, column=0, padx=10, pady=10)

        self.search_entry = tk.Entry(label_busca)
        self.search_entry.grid(row=2, column=0, padx=10, pady=10)
        self.search_entry.bind("<KeyRelease>", self.search_function)

        # Crear un menú desplegable para seleccionar el tipo de búsqueda
        opciones = ["id", "nombre"]
        self.search_type_var = tk.StringVar(label_busca)
        self.search_type_var.set("id")
        
        search_type_menu = tk.OptionMenu(self.frame, self.search_type_var, *opciones)
        search_type_menu.grid(row=1, column=0, padx=10, pady=10)

        # Treeview for results
        self.tree = ttk.Treeview(self.frame, show="headings")
        self.tree.config(columns=("id_implemento", "nombre_implemento", "stock", "ubicacion", "unidadmedida"), height=30)
        self.tree.heading("id_implemento", text="ID")
        self.tree.heading("nombre_implemento", text="Nombre")
        self.tree.heading("stock", text="Stock")
        self.tree.heading("ubicacion", text="Ubicación")
        self.tree.heading("unidadmedida", text="Unidad de Medida")
        self.tree.grid(row=2, column=0, padx=10, pady=10)
        self.tree.bind("<<TreeviewSelect>>", self.seleccionar_fila)

        self.gestion = tk.Frame(self.frame, bg="#D3D3D3")
        self.gestion.grid(row=2, column=1, padx=10, pady=10)

        self.id_implemento_label = tk.Label(self.gestion, text="ID Implemento: ", font=("Arial", 12), bg="#D3D3D3")
        self.id_implemento_label.grid(row=0, column=0, padx=10, pady=10)

        self.nombre_implemento_label = tk.Label(self.gestion, text="Nombre Implemento: ", font=("Arial", 12), bg="#D3D3D3")
        self.nombre_implemento_label.grid(row=1, column=0, padx=10, pady=10)

        self.consulta()
    
    def consulta(self):
        try:
            mydb = conexion.conectar()
            mycursor = mydb.cursor()

            sql = "SELECT * FROM implemento JOIN unidad_medida ON unidad_medida.id_medida=implemento.und_medida_fk ORDER BY id_implemento ASC"
            mycursor.execute(sql)
            self.resultado = mycursor.fetchall()

            if self.resultado:
                self.tree.delete(*self.tree.get_children())
                for fila in self.resultado:
                    self.tree.insert("","end",values=(fila[0], fila[1], fila[2], fila[7], fila[10]))

            else:
                messagebox.showerror("Error", "Credenciales inválidas.")

        except mysql.connector.Error as err:
            messagebox.showerror("Error", f"Error de conexión: {err}")
        finally:
            if mydb.is_connected():
                mycursor.close()
                mydb.close()

    def seleccionar_fila(self,event):
        item_seleccionado = self.tree.selection()[0]  # Obtener el ID de la fila seleccionada
        valores = self.tree.item(item_seleccionado, "values")  # Obtener los valores de la fila
        self.id_implemento_label.config(text="ID Implemento: " + valores[0])
        self.nombre_implemento_label.config(text="Nombre Implemento: " + valores[1])
        

    def search_function(self, event):
        search_term = self.search_entry.get()
        search_type = self.search_type_var.get()  # Obtener el tipo de búsqueda
        self.tree.delete(*self.tree.get_children())  # Clear the treeview

        if not search_term:
            self.consulta()
            return
        print(f"Search term: {search_term}, Search type: {search_type}")

        for item in self.resultado:
            if search_type == "id":
                if int(search_term) == item[0]:
                    self.tree.insert("", tk.END, values=(item[0], item[1]))
            else:
                if search_term.lower() in item[1].lower():
                    self.tree.insert("", tk.END, values=(item[0], item[1]))
