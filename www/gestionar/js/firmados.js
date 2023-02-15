var idioma_espanol_firmados = {
	select: {
		rows: "%d fila seleccionada"
	},
	"sProcessing":     "Procesando...",
	"sLengthMenu":     "Mostrar _MENU_ documentos",
	"sZeroRecords":    "",
	"sEmptyTable":     "",
	"sInfo":           "Mostrando documentos del _START_ al _END_ de un total de _TOTAL_ documentos",
	"sInfoEmpty":      "Mostrando documentos del 0 al 0 de un total de 0 documentos",
	"sInfoFiltered":   "(filtrado de un total de _MAX_ documentos)",
	"sInfoPostFix":    "",
	"sSearch":         "Buscar:",
	"sUrl":            "",
	"sInfoThousands":  ",",
	"sLoadingRecords": "",
	"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
	},
	"oAria": {
		"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		"sSortDescending": ": Activar para ordenar la columna de manera descendente"
	},
	"buttons": {
		"copy": "Copiar",
		"colvis": "Visibilidad"
	}
}

var tbl_firmados;

function listar_firmados() {
	tbl_firmados=$("#tabla_firmados").DataTable( {
        "scrollY":"65vh",
        "scrollCollapse":false,
        "paging":false,
        "bFilter":false,
        "bInfo" : false,
        "ajax":{
        	"method":"POST",
			"url": "./controllers/firmadosController.php",
		},
		"order":[[0,'desc']],
		"columns":[
		{"data":"doc_id", "className":"td-hidden"},
		{"data":"doc_nombre", "className":"text-font-datatable"},
		{"data":"doc_fecha_f", "className":"text-center-datatable"},
		{"data":"det_nomdes", "className":"text-font-datatable text-justify-datatable"},
		{"defaultContent":"<a class='descargarDocumentoFirmado' href='#!'><button class='button button-descargar'>Descargar</button></a>", "className":"text-center-datatable"}
		],
		"language":idioma_espanol_firmados,
		select:true
    } );
}

$('#tabla_firmados').on('click','.descargarDocumentoFirmado',function(){
	var data = tbl_firmados.row($(this).parents('tr')).data();
    if(tbl_firmados.row(this).child.isShown()){
    	var data = tbl_firmados.row(this).data();
    }
    let userid = data.doc_usuari;
    let nombrecontrato = data.doc_nombre;
    let ruta_archivo = data.doc_ruta;
    let srv_substr = serv.slice(0, -1);
    let url = srv_substr+ruta_archivo;
    let link = document.createElement("a");
    link.download = "firmadoc-"+nombrecontrato;
    link.href = url;
    link.click();
})
