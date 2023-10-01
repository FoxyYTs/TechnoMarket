import pandas as pd
from pandas import ExcelWriter

def crear():
    titulo = input('titulo: ')
    ExcelWriter("TallerProgramacion/" + titulo + ".xlsx")

crear()