$(document).ready(function () {
    $('#datatable').DataTable({
        responsive: true,
        orderCellsTop: false,
        fixedHeader: true,
        bPaginate: false,
        pageLength: 10,
        paging: true,
        ordering: false,
        searching: false,
        columnDefs:[{
            targets: "_all",
            sortable: false
        }],
        language: {
            "decimal": "",
            "emptyTable": "No hay documentos pendientes",
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

    });
    
    document.getElementById('datatable').children[1].classList.add('tbody');
    document.getElementById('datatable').children[1].innerHTML += "<script></script>";
    document.getElementById('datatable_length').remove();

    evento_ordenar();

    /* Verificacion de la vista actual en la que se encuentra */
    const metodoGet = window.location.search;
    const valor = metodoGet.substring(metodoGet.indexOf('=') + 1);

    switch(valor) {
        case 'pendientes':
            traerDatos('DescargaPendientes');
            break;
        case 'firmados':
            traerDatos('descargarFirmados');
            break;
        case 'devueltos':
            traerDatos('DescargaDevueltos');
            break;
    }
});

function evento_ordenar() {
    
    const ninguno = document.getElementById('ninguno');
    const ordenar = document.getElementById('ordenar');
    const ordenar_fecha = document.getElementById('ordenar-fecha');
    const elementos = document.querySelector('.tbody');
    const documentos = [...elementos.children];
    let ordenado = '';

    ordenar.addEventListener('click', () => {
        
        if(ordenado == '') {
            documentos.pop();
            ordenado = 'alfabetico';
        }

        const ordenarElemento = (a, b) => {
            if (a.id < b.id) return -1;
            if (a.id > b.id) return 1;
            else return 0;
        }

        documentos.sort(ordenarElemento);
        elementos. innerHTML = '';
        documentos.forEach(doc => elementos.appendChild(doc));
    });

    if(ordenar_fecha) {

        ordenar_fecha.addEventListener('click', () => {
            
            if(ordenado == '') {
                documentos.pop();
                ordenado = 'fecha';
            }
        
            const ordenarElemento = (a, b) => {
                
                let fecha_a = a.getAttribute('fecha');
                let fecha_b = b.getAttribute('fecha');
        
                if (fecha_a < fecha_b) return -1;
                if (fecha_a > fecha_b) return 1;
                else return 0;
            }
        
            documentos.sort(ordenarElemento);
            elementos. innerHTML = '';
            documentos.forEach(doc => elementos.appendChild(doc));
        });
    }

    ninguno.addEventListener('click', () => location.reload());
}

import { peticion } from './http.js';
import { copiar } from './moverDocumentos.js';

/* Funcion que permite descargar los documentos */
function traerDatos(post) {

    let descarga = document.querySelectorAll('.acciones');
    
    for (const i of descarga) {
        
        i.addEventListener('click', async (e) => {
            
            if(e.target.classList.contains('descargarDoc')) {

                let formulario = new FormData();
                let valor = i.getAttribute('value');
                formulario.append(post, valor);
                let url = '../controller/DownloadController.php';
                let resultado = await peticion(url, formulario);
                
                if (resultado.status == 200) {
        
                    let link = document.createElement("a");
                    document.body.appendChild(link);
                    link.setAttribute("type", "hidden");
                    link.href = "data:application/pdf;base64," + resultado.message;
                    link.download = valor;
                    link.click();
                    document.body.removeChild(link);
                }
            }
            else if(e.target.classList.contains('copiarDoc')) copiar(e.target);
        });
    }
}
