var idioma_espanol_pendientes = {
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
		"sLast":     "�0�3ltimo",
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

var tbl_pendientes;

function listar_pendientes() {
	tbl_pendientes=$("#tabla_pendientes").DataTable( {
        "scrollY":"65vh",
        "scrollCollapse":false,
        "paging":false,
        "bFilter":false,
        "bInfo" : false,
        "ajax":{
        	"method":"POST",
			"url": "./controllers/pendientesController.php",
		},
		"order":[[0,'desc']],
		"columns":[
		{"data":"doc_id", "className":"td-hidden"},
		{"data":"doc_nombre", "className":"text-font-datatable"},
		{"data":"doc_fechac", "className":"text-font-datatable text-center-datatable"},
		{"data":"doc_estado", "className":"text-center-datatable",
		render:function (data,type,row) {
			if (data==='Pendiente') {
				return "<button class='button-datatable pendiente'>"+data+"</button>";
			} else {
				return "<button class='button-datatable devuelto'>"+data+"</button>";
			}
		}
	},
		{"data":"det_observ", "className":"text-font-datatable text-justify-datatable text-th-center-datatable"},
		{"data":"doc_estado",
		render: function (data) {
			if (data=='Pendiente') {
				return "<div class='dropdown'><button class='dropbtn' data-toggle='dropdown' disabled='disabled' style='cursor: default'>Elija una opci&oacute;n <i class='fa fa-angle-down fa-lg'></i></button><div class='dropdown-content'><a class='cargarNuevoDocumento' href='#!' style='display: none;'>Cargar de nuevo</a><a id='descargarDocumentos' class='descargarDocumentos' href='#!'>Descargar</a><a class='eliminarDocumento' href='#!' style='display: none;'>Eliminar</a></div></div>";
			} else {
				return "<div class='dropdown'><button class='dropbtn' data-toggle='dropdown' disabled='disabled' style='cursor: default'>Elija una opci&oacute;n <i class='fa fa-angle-down fa-lg'></i></button><div class='dropdown-content'><a class='cargarNuevoDocumento' href='#!'>Cargar de nuevo</a><a id='descargarDocumentos' class='descargarDocumentos' href='#!'>Descargar</a><a class='eliminarDocumento' href='#!'>Eliminar</a></div></div>";
			}
		},
	 "className":"text-center-datatable"},
		],
		"language":idioma_espanol_pendientes,
		select:true
    } );
}

function dropdwon() {
	$(".dropdown").on("show.bs.dropdown", function(event){
	});
}

$('#tabla_pendientes').on('click','.descargarDocumentos',function(){
	var data = tbl_pendientes.row($(this).parents('tr')).data();
    if(tbl_pendientes.row(this).child.isShown()){
    	var data = tbl_pendientes.row(this).data();
    }
    let userid = data.doc_usuari;
    let nombrecontrato = data.doc_nombre;
    let url = "../bodega/precarga/"+userid+"/"+nombrecontrato;
    var filename = url+nombrecontrato;
    let link = document.createElement("a");
    link.download = nombrecontrato;
    link.href = url;
    link.click();
})

$('#tabla_pendientes').on('click','.cargarNuevoDocumento',function(){
	var data = tbl_pendientes.row($(this).parents('tr')).data();
    if(tbl_pendientes.row(this).child.isShown()){
    	var data = tbl_pendientes.row(this).data();
    }
    Swal.fire({
  title: 'Esta seguro?',
  html: "Esta acci&oacute;n reemplazara el documento actual !!!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Aceptar',
  cancelButtonText: 'Cancelar',
  allowOutsideClick: false
}).then((result) => {
  if (result.isConfirmed) {
    document.getElementById('nombre_archivo').click();
    document.getElementById('idArchivo').value=data.doc_id;
    document.getElementById('nombreArchivo').value=data.doc_nombre;
    document.getElementById('rutaArchivo').value=data.doc_ruta;
    }
})
})

function cargarDocumento() {
        document.formulario.submit();
    }

$('#tabla_pendientes').on('click','.eliminarDocumento',function(){
	var data = tbl_pendientes.row($(this).parents('tr')).data();
    if(tbl_pendientes.row(this).child.isShown()){
    	var data = tbl_pendientes.row(this).data();
    }
    let iddocumento = data.doc_id;
    let nombredocumento = data.doc_nombre;
    let usuarioid = data.doc_usuari;
    Swal.fire({
  title: 'Esta seguro?',
  html: "El documento pasara a la bandeja <b>Eliminados</b>!!!",
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
    	url: './controllers/eliminarDocumentoPendienteController.php',
    	type: 'POST',
    	data:{
    		iddocumento:iddocumento,
    		nombredocumento:nombredocumento,
    		usuarioid:usuarioid
    	}
    }).done (function(resp){
    	if (resp>0) {
    		tbl_pendientes.ajax.reload();
    		Swal.fire({
      icon: 'success',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      title: 'Eliminado!',
      html: 'El documento se movio a la bandeja <b>Eliminados</b>.',
  		allowOutsideClick: false
        });
    	} else {
    		Swal.fire({
      icon: 'error',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      title: 'Error!',
      html: 'El documento <b>NO</b> se movio a la bandeja <b>Eliminados</b>.',
  		allowOutsideClick: false
        });
    	}
    })
  }
})
})

function enviar() {
  var formulario = document.getElementById("formulario");
  var dato = formulario[0];
  if (dato.value=="enviar") {
    formulario.submit();
    return true;
  } else {
    window.location.href = "reports/rep-pendientes.php";
    return false;
  }
}
