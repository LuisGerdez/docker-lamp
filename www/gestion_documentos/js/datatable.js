$(document).ready( function () {
    $('#datatable').DataTable({
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true,
        bPaginate: true, 
        language: {
            "decimal": "",
            "emptyTable": "No hay datos",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros",
            "infoFiltered": "(Filtro de _MAX_ registros Totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "mostrar _MENU_",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar documento:",
            "zeroRecords": "No se encontraron resultados",
            "paginate": {

                "first": "Primero",
                "last": "Ultimo",
                "next": "Proximo",
                "previous": "Anterior"
            }
        },

     } );
} );
