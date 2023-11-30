from django.shortcuts import render

# Create your views here.
def pagProductos(request):
    return render(request, 'productos.html')

def infoCategorias(request, categoria):
    return render(request, 'infoCategorias.html', {
        "categoria":categoria    
    })
