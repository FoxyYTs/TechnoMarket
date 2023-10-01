import pandas as pd
from pandas import ExcelWriter
import os

class Crud:
    def crear():
        df1 = pd.DataFrame({'A':['A0', 'A1', 'A2','A3'],
        'B':['B0', 'B1', 'B2','B3'],
        'C':['C0', 'C1', 'C2','C3'],
        'D':['D0', 'D1', 'D2','D3']})

        df2 = pd.DataFrame({'A':['A0', 'A1', 'A2','A3'],
        'B':['B0', 'B1', 'B2','B3'],
        'C':['C0', 'C1', 'C2','C3'],
        'D':['D0', 'D1', 'D2','D3']})
        titulo = input('titulo: ')
        with ExcelWriter("TallerProgramacion/" + titulo + ".xlsx") as writer:
            df1.to_excel(writer,sheet_name="Clase Padre")
            df2.to_excel(writer,sheet_name="Clase Hijo")
    def leer():
        print(pd.read_excel("TallerProgramacion/Karl.xlsx"))
        
    leer()