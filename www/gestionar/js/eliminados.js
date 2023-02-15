var idioma_espanol_eliminados = {
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

var tbl_eliminados;

function listar_eliminados() {
	tbl_eliminados=$("#tabla_eliminados").DataTable( {
        "scrollY":"65vh",
        "scrollCollapse":false,
        "paging":false,
        "bFilter":false,
        "bInfo" : false,
        "ajax":{
        	"method":"POST",
			"url": "./controllers/eliminadosController.php",
		},
		"order":[[0,'desc']],
		"columns":[
		{"data":"doc_id", "className":"td-hidden"},
		{"data":"doc_nombre", "className":"text-font-datatable"},
		{"data":"doc_estado", "className":"text-center-datatable",
		render:function (data,type,row) {
			if (data==='Eliminado') {
				return "<button class='button-datatable eliminado'>"+data+"</button>";
			}
		}
	},
		{"data":"doc_fecha_e", "className":"text-font-datatable text-center-datatable"},
		{"defaultContent":"<div class='dropdown'><button class='dropbtn' data-toggle='dropdown'>Elija una opci&oacute;n</button><div class='dropdown-content'><a class='restaurarDocumento' href='#!'>Restaurar</a><a class='eliminarDefinitivo' href='#!'>Eliminar</a></div></div>", "className":"text-center-datatable"}
		],
        "language":idioma_espanol_eliminados,
		select:true
    } );
}

function dropdwon() {
	$(".dropdown").on("show.bs.dropdown", function(event){
	});
}

$('#tabla_eliminados').on('click','.restaurarDocumento',function(){
	//alert("Restaurar desde la tabla")
	var data = tbl_eliminados.row($(this).parents('tr')).data();
    if(tbl_eliminados.row(this).child.isShown()){
    	var data = tbl_eliminados.row(this).data();
    }
    let iddocumento = data.doc_id;
    let nombredocumento = data.doc_nombre;
    let usuarioid = data.doc_usuari;
    //alert(nombredocumento);
    Swal.fire({
  title: 'Quiere restaurar este documento?',
  html: "El documento pasara a la bandeja <b>Pendientes</b> !!!",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Aceptar',
  cancelButtonText: 'Cancelar',
  allowOutsideClick: false
}).then((result) => {
  if (result.isConfirmed) {
  	$.ajax({
    	url: './controllers/restaurarDocumentoPendienteController.php',
    	type: 'POST',
    	data:{
    		iddocumento:iddocumento,
    		nombredocumento:nombredocumento,
    		usuarioid:usuarioid
    	}
    }).done (function(resp){
    	if (resp>0) {
    		tbl_eliminados.ajax.reload();
    		Swal.fire({
      icon: 'success',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      title: 'Restaurado!',
      html: 'El documento se movio a la bandeja <b>Pendientes</b>.',
      allowOutsideClick: false
        });
    	} else {
    		Swal.fire({
      icon: 'error',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      title: 'Error!',
      html: 'El documento <b>NO</b> se movio a la bandeja <b>Pendientes</b>.',
      allowOutsideClick: false
        });
    	}
    })
  }
})
})

$('#tabla_eliminados').on('click','.eliminarDefinitivo',function(){
  var data = tbl_eliminados.row($(this).parents('tr')).data();
    if(tbl_eliminados.row(this).child.isShown()){
      var data = tbl_eliminados.row(this).data();
    }
    let iddocumento = data.doc_id;
    let nombredocumento = data.doc_nombre;
    let usuarioid = data.doc_usuari;
    Swal.fire({
  title: 'Esta seguro?',
  html: "El documento se eliminara <b>definitivamente</b> !!!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Aceptar',
  cancelButtonText: 'Cancelar',
  allowOutsideClick: false
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
      url: './controllers/eliminarDocumentoDefinitivoController.php',
      type: 'POST',
      data:{
        iddocumento:iddocumento,
        nombredocumento:nombredocumento,
        usuarioid:usuarioid
      }
    }).done (function(resp){
      if (resp>0) {
        tbl_eliminados.ajax.reload();
        Swal.fire({
      icon: 'success',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      title: 'Eliminado!',
      html: 'El documento se elimin&oacute; <b>definitivamente</b>.',
      allowOutsideClick: false
        });
      } else {
        Swal.fire({
      icon: 'error',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      title: 'Error!',
      html: 'El documento <b>NO</b> se pudo <b>eliminar</b>.',
      allowOutsideClick: false
        });
      }
    })
  }
})
})