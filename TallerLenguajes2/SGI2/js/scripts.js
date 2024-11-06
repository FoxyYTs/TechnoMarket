function generarPDF() {
    // Carga jsPDF desde el entorno global
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Agrega un título opcional
    doc.text("Informe de Inventario", 14, 20);

    // Genera el PDF a partir de la tabla
    doc.autoTable({
        html: '.table', // Selecciona la tabla con clase "table"
        startY: 30, // Configura el margen superior
        theme: 'striped', // Personaliza el estilo de la tabla
        headStyles: { fillColor: [22, 160, 133] }, // Color del encabezado
    });

    // Guarda o muestra el PDF
    doc.save('informe_inventario.pdf');
}

$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Busca una opción", // Texto de sugerencia en el campo
        allowClear: true                 // Habilita limpiar la selección
    });
});