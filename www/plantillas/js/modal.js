/*
*   Software development: Ing. Bernabe Sanchez Lenis
*   líneas de código: 5 - 78
*/
function Abrir_Modal_Compraventa_Vehiculo() {
  let modal = document.getElementById("compraventa_vehiculo");
  let span = document.getElementsByClassName("close")[0];
  let body = document.getElementsByTagName("body")[0];
  modal.style.display = "block";
  body.style.position = "static";
  body.style.height = "100%";
  body.style.overflow = "hidden";
}

function Cerrar_Modal_Compraventa_Vehiculo() {
  let modal = document.getElementById("compraventa_vehiculo");
  let body = document.getElementsByTagName("body")[0];
  modal.style.display = "none";
  body.style.position = "inherit";
  body.style.height = "auto";
  body.style.overflow = "visible";
}

function Abrir_Modal_Promesa_Compraventa() {
  let modal = document.getElementById("promesa_compraventa");
  let body = document.getElementsByTagName("body")[0];
  modal.style.display = "block";
  body.style.position = "static";
  body.style.height = "100%";
  body.style.overflow = "hidden";
}

function Cerrar_Modal_Promesa_Compraventa() {
  let modal = document.getElementById("promesa_compraventa");
  let body = document.getElementsByTagName("body")[0];
  modal.style.display = "none";
  body.style.position = "inherit";
  body.style.height = "auto";
  body.style.overflow = "visible";
}

function Abrir_Modal_Prestacion_Servicios() {
  //alert('Free')
  let modal = document.getElementById("prestacion_servicios");
  let body = document.getElementsByTagName("body")[0];
  modal.style.display = "block";
  body.style.position = "static";
  body.style.height = "100%";
  body.style.overflow = "hidden";
}

function Cerrar_Modal_Prestacion_Servicios() {
  let modal = document.getElementById("prestacion_servicios");
  let body = document.getElementsByTagName("body")[0];
  modal.style.display = "none";
  body.style.position = "inherit";
  body.style.height = "auto";
  body.style.overflow = "visible";
}

function Abrir_Modal_Pagare() {
  //alert('Free')
  let modal = document.getElementById("pagare");
  let body = document.getElementsByTagName("body")[0];
  modal.style.display = "block";
  body.style.position = "static";
  body.style.height = "100%";
  body.style.overflow = "hidden";
}

function Cerrar_Modal_Pagare() {
  let modal = document.getElementById("pagare");
  let body = document.getElementsByTagName("body")[0];
  modal.style.display = "none";
  body.style.position = "inherit";
  body.style.height = "auto";
  body.style.overflow = "visible";
}