<?php

const SERVERURL = "http://FirmaDoc-Corp-Public-ALB-2125005779.us-east-1.elb.amazonaws.com/firmadoc_corp_suntic/";
const COMPANY = "FirmaDoc-corp";
const LOGOBLACK = "../recursos/logo.png";
const LOGOWHITE = "../recursos/logo_blanco.png";
const LOGOFIRMA = "../recursos/republica_colombia.png";
const EMAIL_CORPORATE = "firma@ingmart.co";
const FAVICON = "../recursos/favicon.ico";
const MONEDA = "$";
const UBICACION = "CO";
const CLIENT = "suntic";

/*	Credenciales Email  */
const Host = "suntic.co";
const Username = "notificaciones@firmadoc.co";
const Password = "-5.=*pzoRO9T2022";
const Port = "465";
date_default_timezone_set("America/Bogota");

const LINK_BIOMETRICO = "https://firmadocbiometria.login.portal-id.com/bridge_suntic_r/validar";
const LINK_BIOMETRICO_DESTINATARIO = "https://enroll.login.portal-id.com/bridge_suntic_d/validar/";
const LINK_VERIFICAR_FUNCIONARIO = "";

//biometria facial
const LINK_VERIFICAR_DESTINATARIO = "https://firmadocverificacion.login.portal-id.com";

const LINK_FORMULARIO_DESTINATARIO = "https://firmadocregistro.login.portal-id.com";
const CERRAR_SESION = "https://mg-local.login.portal-id.com/mg-local/logout";
const REDIRECCION_FIRMA = "../administrar/layout/layout.php?menu=pendientes_entrada";
const validacionCorreoFuncionario = "suntic";

// Generamos los enlaces para la OTP
const LINK_VERIFICAR_DESTINATARIO_OTP = SERVERURL."login?codigo=OTP";
const LINK_FORMULARIO_DESTINATARIO_OTP =  SERVERURL."registro_usuario?codigo=OTP";

//GENERAMOS LINK OTP PARA PLANTILLAS (PERSONAS REGISTRADAS)
const LINK_VERIFICAR_PLANTILLAS_OTP = SERVERURL."login?codigo=OTP2";


error_reporting(E_ALL);
ini_set('ignore_repeated_errors',TRUE);
// ini_set('display_errors', true);
ini_set('log_errors', TRUE);
ini_set('error_log',__DIR__.'/../php-error.log');
