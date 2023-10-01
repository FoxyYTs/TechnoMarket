import pandas as pd
from pandas import ExcelWriter

class Crud:
    def crear():
        titulo = input('titulo: ')
        ExcelWriter("TallerProgramacion/" + titulo + ".xlsx")

    crear()