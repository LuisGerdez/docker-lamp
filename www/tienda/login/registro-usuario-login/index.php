<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/login.css">
<link rel="stylesheet" type="text/css" href="../css/registro.css">

</head>
<body>



<form action="/action_page.php" method="post">
  <div class="container-form">
  <div class="imgcontainer">
    <img src="../../recursos/logo.png" alt="alt" width="120" height="45" />
  </div>

  <div class="container">
    <label for="uname"><b>Nombre</b></label>
    <input type="text" placeholder="Ingrese su nombre" name="uname" required>

    <label for="psw"><b>Apellidos</b></label>
    <input type="text" placeholder="Ingrese sus apellidos" name="psw" required>

    <label for="uname"><b>Tipo de identificaci&oacute;n</b></label>
     <div class="custom-select">
  <select>
    <option value="0">Seleccione un tipo:</option>
    <option value="1">C&eacute;dula</option>
    <option value="2">N.i.t.</option>
    <option value="3">Pasaporte</option>
  </select>
</div>

    <label for="psw"><b>N&uacute;mero de identificaci&oacute;n</b></label>
    <input type="text" placeholder="Ingrese su n&uacute;mero de identificaci&oacute;n" name="psw" required>

    <label for="psw"><b>N&uacute;mero fijo o m&oacute;vil</b></label>
    <input type="text" placeholder="Ingrese su n&uacute;mero fijo o m&oacute;vil" name="psw" required>

    <label for="psw"><b>Domicilio</b></label>
    <input type="text" placeholder="Ingrese su direcci&oacute;n de domicilio" name="psw" required>

    <label for="psw"><b>Ciudad</b></label>
    <input type="text" placeholder="Ingrese su ciudad de domicilio" name="psw" required>
    
    <label for="uname"><b>Correo electrónico</b></label>
    <input type="text" placeholder="Ingrese su correo electrónico" name="uname" required>
        
    <button type="submit">Registrar</button>
    <p><a href="../">Ya tengo una cuenta.</a></p>
  </div>

  </div>
</form>
<script>
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>
</body>
</html>
