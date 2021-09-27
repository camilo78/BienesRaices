$(function () {
    $('.js-basic-example').DataTable({
        responsive: true
    });

    //Exportable table
    $('.js-exportable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            { extend: 'copy', text:  'Copiar' },
            'csv',
            'excel',
            'pdf',
            { extend: 'print', text:  'Imprimir' },
        ]
    });
});