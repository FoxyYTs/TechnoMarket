import pandas as pd

Hoja1=pd.read_html("https://es.wikipedia.org/wiki/Estatura")[1]
Hoja2=pd.read_html("https://www.cuandoenelmundo.com/herramientas/codigos-para-llamadas-internacionales")[0]
Hoja3=pd.read_html("https://minecraft-ids.grahamedgecombe.com")[0]

with pd.ExcelWriter("archivoXLSX.xlsx") as writer:
    Hoja1.to_excel(writer,sheet_name="Altura")
    Hoja2.to_excel(writer,sheet_name="Codigo llamada")
    Hoja3.to_excel(writer,sheet_name="Minecraft")
