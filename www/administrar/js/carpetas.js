
import { peticion } from './http.js';
import { traerDatos } from './descargarDocumentos.js';

const activo = document.querySelector(".active");
const pendientes = document.getElementById("pendientes");
const firmados = document.getElementById("firmados");
const devueltos = document.getElementById("devueltos");
const carpetas = document.getElementById("carpetas");
const crear = document.getElementById('crear-carpeta');
const pendientes_entrada = document.getElementById("pendientes_entrada");
const buscador = document.getElementById('search');
const contenedor = document.querySelector('.wrapper');

/* Mensaje que pone un texto en caso de que no existan carpetas */
if([...contenedor.children].length == 0) {
    
    const p = document.createElement('p');
    const texto = document.createTextNode("No hay carpetas disponibles");
    p.appendChild(texto);
    contenedor.appendChild(p);
    contenedor.style.height = '85%';
    contenedor.style.display = 'block';
    contenedor.style.position = 'relative';
    p.style.position = 'absolute';
    p.style.top = '50%';
    p.style.left = '50%';
    p.style.transform = 'translate(-50%, -50%)';
    p.style.fontStyle = 'italic';
}

/* ################### Aqui ################### */

// optimizar la funcionalidad porque se repite

const ninguno = document.getElementById('ninguno');
const ordenar2 = document.getElementById('ordenar');
const ordenar_fecha = document.getElementById('ordenar-fecha');
let ordenado = '';

ordenar2.addEventListener('click', () => {

    const elementos = document.querySelector('.wrapper');
    let folders = [...elementos.children];
    
    if(ordenado == '' || ordenado == 'fecha') {
        ordenado = 'alfabetico';
        const ordenarElemento = (a, b) => {
            if (a.children[2].children[0].innerHTML < b.children[2].children[0].innerHTML) return -1;
            if (a.children[2].children[0].innerHTML > b.children[2].children[0].innerHTML) return 1;
            else return 0;
        }
    
        folders.sort(ordenarElemento);
        elementos.innerHTML = '';
        folders.forEach(doc => elementos.appendChild(doc));
    }
});

ordenar_fecha.addEventListener('click', () => {

    const elementos = document.querySelector('.wrapper');
    let folders = [...elementos.children];

    if(ordenado == '' || ordenado == 'alfabetico') {
        ordenado = 'fecha';
        const ordenarElemento = (a, b) => {
            if (a.children[2].children[1].children[1].innerHTML.slice(19) < b.children[2].children[1].children[1].innerHTML.slice(19)) return -1;
            if (a.children[2].children[1].children[1].innerHTML.slice(19) > b.children[2].children[1].children[1].innerHTML.slice(19)) return 1;
            else return 0;
        }
    
        folders.sort(ordenarElemento);
        elementos.innerHTML = '';
        folders.forEach(doc => elementos.appendChild(doc));
    }
});

ninguno.addEventListener('click', () => location.reload());

/* ################### Aqui ################### */

/* Estilos de la pestaña carpetas */
activo.classList.remove("active");
carpetas.classList.add("active");
pendientes.classList.add("button-border");
firmados.classList.add("button-border");
devueltos.classList.add("button-border");
pendientes_entrada.classList.add("button-border");

/* Evento del buscador */
buscador.addEventListener('keyup', async () => {

    const filtro = buscador.value.trim();

    if(filtro != '') {

        const formulario = new FormData();
        formulario.append('filtro', filtro);
        const resultado = await peticion('../controller/CarpetasController.php', formulario);
        mostrarCarpetas(resultado);
        main();
    }
    else location.reload();
});

/* Funcion que pinta las carpetas filtradas */
function mostrarCarpetas(datos) {
    
    if(datos.status == 200) {
        
        const resultado = datos.response;
        contenedor.innerHTML = '';
        resultado.forEach(carpeta => {
            contenedor.innerHTML += `
                <div class='folder-container'>
                    <div class='imagen-container'>
                        <img class='imagen' src='../../recursos/iconos/carpeta.png'>
                    </div>
                    <div class='separador'></div>
                    <div class='info'>
                        <span class='titulo'>${carpeta.nombre}</span>
                        <div class='datos'>
                            <span id='item'>Nº de Archivos: <span id='numero'>${carpeta.archivos}</span></span>
                            <span id='item'>Fecha de Creación: ${carpeta.fecha}</span>
                            <span id='item'>Hora de Creación: ${carpeta.hora}</span>
                        </div>
                    </div>
                    <img class='eliminar' src='../../recursos/iconos/borrar.png' title='Eliminar' alt='Eliminar'>
                    <img class='visibilidad' src='../../recursos/iconos/visibilidad.png'>
                    <input type='hidden' value="${carpeta.id}">
                </div>
            `;
        });
    }
}

/* Modal */
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

/* Evento de boton crear carpeta */
/* Ventana emergente de crear carpeta */
crear.addEventListener('click', () => {

    const html = `
        <div class="create-container">
            <h1>crear carpeta</h1>
            <form action="../controller/create.php" method="post" id="formFolder">
                <div>
                    <label for="campo">nombre de la carpeta:</label>
                    <input type="text" name="carp_nombre" id="campo_texto">
                </div>
                <input type="submit" value="crear">
            </form>
        </div>
    `;

    mostrarModal(html);

    const form = document.getElementById('formFolder');
    const campo = document.getElementById('campo_texto');
    campo.focus();

    /* Validacion de maximo 30 caracteres al crear carpeta */
    form.addEventListener('submit', (e) => {

        e.preventDefault();

        const valor = campo.value.trim();

        if (valor.length > 30) alert("El nombre supera los 30 caracteres");
        else e.target.submit();
    });
});

/* Eventos de las carpetas */
function main() {

    let listaCarpetas = document.querySelectorAll('.folder-container');
    
    for (const carpeta of listaCarpetas) {
    
        let imagen = carpeta.children[0].children[0];
        let eliminar = carpeta.children[3];
        let id = carpeta.children[5].value;
                    
        /* Evento hover al entrar el raton */
        carpeta.addEventListener('mouseenter', () => {
            imagen.src = '../../recursos/iconos/carpeta-hover.png';
        });
    
        /* Evento hover al salir el raton */
        carpeta.addEventListener('mouseleave', () => {
            imagen.src = '../../recursos/iconos/carpeta.png';
        });

        /* Evento al clicar una carpeta */
        carpeta.addEventListener('click', async (e) => {
            
            const formulario = new FormData();
            const id_carpeta = e.currentTarget.children[5].value;
            formulario.append('id_carpeta', id_carpeta);
            
            if(e.target.classList.contains('visibilidad')) {

                const resultado = await peticion('../controller/CarpetasController.php', formulario);
                
                if(resultado.status == 200) {
    
                    let html = `
                        <div class="table-container" style="width: 1000px;">
                            <table style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th style="padding:10px 0px; width: 500px; background-color: #9C9C9C; color: #FFF;">Documento</th>
                                        <th style="padding:10px 0px; width: 400px; background-color: #006BD6; color: #FFF;">Fecha de firma</th>
                                        <th style="padding:10px 0px; width: 500px; background-color: #9C9C9C; color: #FFF;">Firmantes</th>
                                        <th style="padding:10px 0px; width: 200px; background-color: #006BD6; color: #FFF;">Estado</th>
                                        <th style="padding:10px 0px; width: 250px; background-color: #9C9C9C; color: #FFF;">Descargar</th>
                                    </tr>
                                </thead>
                                <tbody>
                    `;
    
                    resultado.datos.forEach(dato => {
                        
                        html += `
                            <tr>
                                <td>${dato.nombre}</td>
                                <td>${dato.fecha}</td>
                                <td>${dato.firmantes}</td>
                                <td>${dato.estado}</td>
                                <td>
                                    <div class="acciones" style="display: flex; justify-content: center; gap: 2px;" value="${dato.ruta}">
                                        <button class="descargarDoc" style="border: none; background-color: #006BD6; color: #FFF; padding: 5px 10px; margin-top: 2px; outline: none; cursor: pointer; border-radius: 3px;">Descargar</button>
                                        <button class="moverDoc" style="border: none; background-color: #9C9C9C; color: #FFF; padding: 5px 10px; margin-top: 2px; outline: none; cursor: pointer; border-radius: 3px;" value="${dato.id_documento}">Mover</button>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
    
                    html += `
                                </tbody>
                            </table>
                        </div>
                    `;
    
                    mostrarModal(html);

                    /* Evento para los botones descargar  */
                    traerDatos('descargarFirmados');

                    /* Evento de boton mover carpeta */
                    const boton_mover = [...document.querySelectorAll('.moverDoc')];

                    boton_mover.forEach(boton => {
                        boton.addEventListener('click', async (e) => modal(e));
                    });
                }
            }
        });
    
        /* Evento de eliminar carpeta */
        eliminar.addEventListener('click', async () => {
            
            const documentos = carpeta.children[2].children[1].children[0].children[0].textContent;

            if(documentos > 0) alert('Revisa el contenido de esta carpeta antes de eliminar');
            else {

                const decision = confirm('¿Esta seguro que desea eliminar esta carpeta?');
        
                if(decision) {
        
                    const formulario = new FormData();
                    formulario.append('id', id);
                    const response = await peticion('../controller/CarpetasController.php', formulario);
                    if(response.status == 200) location.reload();
                }
            }
        });
    }
}

async function modal(e) {
    
    const formulario = new FormData();
    formulario.append('request', true);
    const documento = e.target.getAttribute('value');
    const resultado = await peticion('../controller/FirmadosController.php', formulario);
    
    if(resultado.status == 200) {

        let html = `
            <div style="width:450px; border-radius: 10px; padding: 20px 20px; gap: 10px; position:absolute; top:50%; left:50%; transform: translate(-50%, -50%); background-color: #CCC;">
                <h1 style="text-align: center;">Selecciona la carpeta</h1>
                <form method="post" id="formMove">
                    <div class="items-container" style="height:100px; overflow-y:auto; padding: 0px 20px;">                        
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
                    <div style="display:flex; justify-content: center;">
                        <input style="background-color: #198754; color: #FFF; border: none; cursor: pointer; border-radius: 5px; padding: 5px 10px; margin-top: 10px;" type="submit" value="Guardar">
                    </div>
                </form>
            </div>
        `;

        const modal = document.querySelector('.fondo');
        modal.innerHTML += html;
        guardar(documento);
    }
}

async function guardar(documento) {
    
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

main();

export *  from './carpetas.js'