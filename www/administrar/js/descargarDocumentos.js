
import { peticion } from './http.js';
import { copiar } from './moverDocumentos.js';

/* Funcion que permite descargar los documentos */
export function traerDatos(post) {

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
