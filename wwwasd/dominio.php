<?php
require_once "config/APP.php";
$dominio = SERVERURL;
$link_enrolamiento_destinatario = LINK_BIOMETRICO_DESTINATARIO;
$link_verificacion_destinatario = LINK_VERIFICAR_DESTINATARIO;
$link_formulario_destinatario = LINK_FORMULARIO_DESTINATARIO;

// Generamos los enlaces para la OTP
$link_verificacion_destinatario_otp = LINK_VERIFICAR_DESTINATARIO_OTP;
$link_formulario_destinatario_otp =  LINK_FORMULARIO_DESTINATARIO_OTP;

//GENERAMOS LINK OTP PARA PLANTILLAS (PERSONAS REGISTRADAS)
$link_verificacion_plantillas_otp = LINK_VERIFICAR_PLANTILLAS_OTP;
?>