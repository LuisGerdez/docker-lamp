function insertarFila(){
    
    let cont = document.getElementById('contador').value;
    cont = parseInt(cont);
    cont++;

    let div1 = document.createElement('div');
    div1.className = 'formulario-container';
    div1.id = 'formulario'+cont;
    
    let div_bloque1 = document.createElement('div');
    div_bloque1.className = 'formulario-bloque1';
    
    let label_bloque1_1 = document.createElement('label');
    label_bloque1_1.innerHTML='Nombre';
    
    let div_bloque1_1 = document.createElement('div');
    div_bloque1_1.className = '';
    
    let input_bloque1_1 = document.createElement('input');
    input_bloque1_1.type = 'text';
    input_bloque1_1.name = 'nombre'+cont;
    div_bloque1_1.appendChild(input_bloque1_1);
    
    let br = document.createElement('br');
    
    let label_bloque1_2 = document.createElement('label');
    label_bloque1_2.innerHTML='Correo Electronico';
    
    let div_bloque1_2 = document.createElement('div');
    div_bloque1_2.className = '';
    
    let input_bloque1_2 = document.createElement('input');
    input_bloque1_2.type = 'text';
    input_bloque1_2.name = 'correo'+cont;
    div_bloque1_2.appendChild(input_bloque1_2);
    
    div_bloque1.appendChild(label_bloque1_1);
    div_bloque1.appendChild(div_bloque1_1);
    div_bloque1.appendChild(br);
    div_bloque1.appendChild(label_bloque1_2);
    div_bloque1.appendChild(div_bloque1_2);
    
    let div_bloque2 = document.createElement('div');
    div_bloque2.className = 'formulario-bloque2';
    
    let div_bloque2_1 = document.createElement('div');
    
    let select_bloque2 = document.createElement('select');
    select_bloque2.className = 'select';
    select_bloque2.name = 'firma'+cont;
    
    let option_bloque2_1 = document.createElement('option');
    option_bloque2_1.value = 'con_firma';
    option_bloque2_1.innerHTML='Firma electrónica';
    select_bloque2.appendChild(option_bloque2_1);
    
    
    div_bloque2_1.appendChild(select_bloque2);
    
    div_bloque2.appendChild(div_bloque2_1);
    
    let div_bloque3 = document.createElement('div');
    div_bloque3.className = 'formulario-bloque3';
    
    let div_bloque3_1 = document.createElement('div');
    
    let label_bloque3_1 = document.createElement('label');
    label_bloque3_1.innerHTML = '';
    div_bloque3_1.appendChild(label_bloque3_1);
    
    div_bloque3.appendChild(div_bloque3_1);
    
    let a = document.createElement('a');
    a.innerHTML = 'X';
    a.className = 'delete_right';
    
    a.addEventListener('click', function () {
        eliminarFila(cont);
    });
    
    div1.appendChild(div_bloque1);
    div1.appendChild(div_bloque2);
    div1.appendChild(div_bloque3);
    div1.appendChild(a);
    
    document.getElementById('destinatarios').appendChild(div1);
    document.getElementById('contador').value = cont;
}

function eliminarFila(codigo){
    
    let cont = document.getElementById('contador').value;
    cont = parseInt(cont);
    cont--;
    
    let id = 'formulario'+codigo;
    let tr = document.getElementById(id);
    let padre = tr.parentNode;
    padre.removeChild(tr);
    
    document.getElementById('contador').value = cont;
}