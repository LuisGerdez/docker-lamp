<?php

namespace Models;

class Session
{
    public function __construct()
    {
        @session_start(['name' => 'SITI']);
    }

    public static function setCurrentUser($user): void
    {
        $_SESSION['codigo_usuario'] = $user['usu_id'];
        $_SESSION['estado'] = $user['usu_estado'];
        $_SESSION['rol'] = $user['rol_usuario'];
        $_SESSION['tipo_documento'] = $user['usu_tipo_documento'];
        $_SESSION['cedula_usuario'] = $user['usu_docume'];
        $_SESSION['correo_usuario'] = $user['usu_email'];
        $_SESSION['nombre_usuario'] = $user['usu_nombre'];
        $_SESSION['apellido_usuario'] = $user['usu_apelli'];
        $_SESSION['celular'] = $user['usu_celula'];
    }

    public function getCurrentUser(): array
    {
        return $_SESSION['user'];
    }

    public static function SessionData($name, $data): void
    {
        // @session_start(['name' => 'SITI']);
        $_SESSION[$name] = $data;
    }

    public function closeSession():void
    {
        session_unset();
        session_destroy();
    }
}
