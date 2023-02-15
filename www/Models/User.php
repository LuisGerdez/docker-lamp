<?php

namespace Models;

require __DIR__ . '/../Models/DB.php';

use Models\DB;

class User extends DB
{
    private int $id_usuario;
    private string $estado;
    private string $nombre;
    private string $apellido;
    private string $tipo_doc;
    private int $documento;
    private string $email;
    private string $contrasena;
    private int $rol;
    private int $celular;

    public function __construct()
    {
    }
    public function getUserInfo(string $email): array|bool
    {
        try {
            $query = $this->connect()->prepare('SELECT * FROM usuario WHERE usu_email = :email');
            $query->execute(['email' => $email]);
            $result = $query->fetch(\PDO::FETCH_ASSOC);

            if ($query->rowCount()) {
                return $result;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            error_log($e, 0, '../php-error.log');
        }
    }

    public function userExist(string $email): bool
    {
        try {
            $query = $this->connect()->prepare('SELECT usu_email FROM usuario WHERE usu_email = :email');
            $query->execute(['email' => $email]);

            if ($query->rowCount()) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            error_log($e, 0, '../php-error.log');
        }
    }


    public function createUser(string $nombre, string $apellido, string $tipo_doc, int $documento, string $email): bool
    {
        try {
            $password = $nombre[0].$documento.$apellido[0];
            $query = $this->connect()->prepare('INSERT INTO usuario (usu_estado, usu_passwo, rol_usuario, usu_nombre, usu_apelli, usu_tipo_documento, usu_docume, usu_email, id_api) VALUES (?,?,?,?,?,?,?,?,?)');
            $query->execute(['A', password_hash($password,CRYPT_BLOWFISH), 4, $nombre, $apellido, $tipo_doc, $documento, $email, 1]);

            if ($query->rowCount()) {
                $new_user_id = $this->getLastId();
                
                //Creación de directorios para el usuario.
                $directorioimgfirmatmp = "../../bodega/precarga/" .  $new_user_id . "/imgfirmatmp";
                $directorioimgfirmafija = "../../bodega/precarga/" .  $new_user_id . "/imgfirmafija";
                $directoriofirmadigital = "../bodega/precarga/" .  $new_user_id . "/firmadigital";
                $directoriofirmado = "../../bodega/firmado/" .  $new_user_id;
                $directorioeliminado = "../../bodega/eliminado/" .  $new_user_id;
                
                if((is_dir($directorioimgfirmatmp) && is_dir($directorioimgfirmafija) && is_dir($directoriofirmadigital) && is_dir($directoriofirmado) && is_dir($directorioeliminado)) != true){
                    mkdir($directorioimgfirmatmp, 0755, true);
                    mkdir($directorioimgfirmafija, 0755, true);
                    mkdir($directoriofirmadigital, 0755, true);
                    mkdir($directoriofirmado, 0755, true);
                    mkdir($directorioeliminado, 0755, true);
                }
                
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            error_log($e, 0, '../php-error.log');
        }
    }
}
