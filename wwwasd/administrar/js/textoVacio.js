const texto = document.getElementById('vacio');
const content = document.querySelector('.tbody').children.length;
const metodoGet = window.location.search;
const valor = metodoGet.substring(metodoGet.indexOf('=') + 1);

if (valor == 'pendientes' && content < 2)
    texto.innerText = "No hay documentos pendientes";
else if (valor == 'firmados' && content < 2)
    texto.innerText = "No hay documentos firmados";
else if (valor == 'devueltos' && content < 2)
    texto.innerText = "No hay documentos devueltos";