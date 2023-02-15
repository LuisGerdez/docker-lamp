
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

ninguno.addEventListener('click', () => location.reload());
