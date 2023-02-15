
import * as funciones from './carpetas.js';

const anterior = document.getElementById('anterior');
const siguiente = document.getElementById('siguiente');
const contenedor = document.querySelector('.wrapper');
let hijos = [...contenedor.children];
const cantidad_paginas = Math.ceil(hijos.length / 6);
let paginas = {};

if(hijos.length > 6) {

    const primer_paginador = document.getElementById('pagina-1');
    const pag = parseInt(anterior.getAttribute('page'));
    primer_paginador.innerText = pag + 1;
    
    for (let index = 0; index < cantidad_paginas; index++) {
        paginas[index] = hijos.splice(0, 6);
    }

    mostrar_elementos(paginas[0]);

    anterior.addEventListener('click', (e) => {
    
        const pagina_anterior = e.target.getAttribute('page');

        if(parseInt(pagina_anterior) > 0) {
            
            siguiente.setAttribute('page', parseInt(siguiente.getAttribute('page')) - 1);
            mostrar_elementos(paginas[pagina_anterior - 1]);
            const ant = parseInt(pagina_anterior) - 1;
            e.target.setAttribute('page', ant);

            const pag = parseInt(anterior.getAttribute('page'));
            primer_paginador.innerText = pag + 1;
        }
    });

    siguiente.addEventListener('click', (e) => {
        
        const pagina_siguiente = e.target.getAttribute('page');
        
        if(parseInt(pagina_siguiente) < cantidad_paginas) {
            
            anterior.setAttribute('page', parseInt(anterior.getAttribute('page')) + 1);
            mostrar_elementos(paginas[pagina_siguiente]);
            const sig = parseInt(pagina_siguiente) + 1;
            e.target.setAttribute('page', sig);

            const pag = parseInt(anterior.getAttribute('page'));
            primer_paginador.innerText = pag + 1;
        }
    });

    function mostrar_elementos(elementos) {
    
        contenedor.innerHTML = '';
        elementos.forEach(e => contenedor.appendChild(e));
    }
    
    funciones;
}
else {
    document.getElementById('pag-container').style.display = 'none';
}