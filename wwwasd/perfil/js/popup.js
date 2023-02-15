var btnabrirpopup1 = document.getElementById('btn-grafo'),
    overlay1=document.getElementById('overlay1'),
    popup1=document.getElementById('popup1'),
    btncerrar1=document.getElementById('btn-cerrar-popup1');

btnabrirpopup1.addEventListener('click',function(){
    overlay1.classList.add('active');
    popup1.classList.add('active');
});
btncerrar1.addEventListener('click',function(){
    overlay1.classList.remove('active');
    popup1.classList.remove('active');
});

var btnabrirpopup2 = document.getElementById('btn-certificado'),
    overlay2=document.getElementById('overlay2'),
    popup2=document.getElementById('popup2'),
    btncerrar2=document.getElementById('btn-cerrar-popup2');

btnabrirpopup2.addEventListener('click',function(){
    overlay2.classList.add('active');
    popup2.classList.add('active');
});
btncerrar2.addEventListener('click',function(){
    overlay2.classList.remove('active');
    popup2.classList.remove('active');
});