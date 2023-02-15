
import { peticion } from './http.js';

/* Funcion que mueve los documentos a una carpeta */
export async function copiar(elemento) {

    const formulario = new FormData();
    formulario.append('request', true);
    const documento = elemento.getAttribute('value');
    const resultado = await peticion('../controller/FirmadosController.php', formulario);
    
    if(resultado.status == 200) {
        
        let html = `
            <div class="list-container">
                <h1>selecciona la carpeta</h1>
                <form method="post" id="formMove">
                    <div class="items-container">                        
        `;

        resultado.carpetas.forEach(carpeta => {
            html += `
                <div class="items">
                    <input type="radio" class="radio-button" id="${carpeta.id}" name="folder" value="${carpeta.id}">
                    <label for="${carpeta.id}">${carpeta.nombre}</label>
                </div>
            `;
        });

        html += `
                    </div>
                    <div class="contenedor-guardar">
                        <input type="submit" value="guardar">
                    </div>
                </form>
            </div>
        `;

        mostrarModal(html);
        guardar(documento);
    }
}

/* Funcion que permite mover un documento a una carpeta */
function guardar(documento) {
    
    const form = document.getElementById('formMove');

    form.addEventListener('submit', async (e) => {
        
        e.preventDefault();
        
        const lista_radio = [...document.querySelectorAll('.radio-button')];

        for (const boton of lista_radio) {

            if(boton.checked) {

                const carpeta = boton.value;
                const datos = new FormData();
                datos.append('documento', documento);
                datos.append('carpeta', carpeta);
                const resultado = await peticion('../controller/movercarpeta.php', datos);
                
                if(resultado.status == 200) {
                    alert(resultado.message);
                    location.reload();
                }

                return;
            }
        }

        alert("Seleccione una carpeta");
    });
}

/* Funcion que muestra el modal */
function mostrarModal(html) {

    const modal = document.querySelector('.fondo');
    
    modal.innerHTML += html;
    modal.classList.remove('hidden');

    /* Evento para ocultar ventana emergente */
    modal.addEventListener('click', (e) => {

        let clase = e.target.classList.contains('fondo');

        if (clase) {

            modal.innerHTML = '';
            modal.classList.add('hidden');
        }
    });
}
