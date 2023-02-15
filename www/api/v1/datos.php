<?php
session_start(['name' => 'SITI']);
require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../../Models/User.php';
require_once __DIR__.'/../../Models/Session.php';
// require '../../Models/DB.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Models\User;
// use Models\DB;
Firebase\JWT\JWT::$leeway = 1000000;


function validateToken(): stdClass|bool
{
    try {
        $time = time();
        $publicKey = file_get_contents(__DIR__ . '/../../recursos/keys/public.pem');
        $token = getallheaders()['token'] ?? $_REQUEST['token'];

        if (empty($token)) {
            return false;
        }
        $decodedToken = JWT::decode($token, new Key($publicKey, 'RS256'));

        if (isset($decodedToken->iat) && $decodedToken->iat >= $time) {
            return $decodedToken;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();    
    }
}

function addVarToSession(): void
{
    $data = json_decode(file_get_contents("php://input"), 1) ?? json_decode($_REQUEST['json_params'], true);
    Models\Session::SessionData('DataFill', $data);
}

function validateUser($Usertoken): string|bool
{
    $user = new User();
    if ($user->userExist($Usertoken->email)) {
        $result = $user->getUserInfo($Usertoken->email);
        Models\Session::setCurrentUser($result);
        addVarToSession();
        return true;
    } else {
        if($user->createUser($Usertoken->name, $Usertoken->lastname, $Usertoken->type_id, $Usertoken->id, $Usertoken->email)){
            $result = $user->getUserInfo($Usertoken->email);
            Models\Session::setCurrentUser($result);
            addVarToSession();
            
            return true;
        }else{
            return 'Error al crear el usuario';
        }
    }
}

function main(): void
{
    $token = validateToken();

    if ($token) {
        if(validateUser($token)){
            header('location: ../../plantillas');
        }else {
            echo 'Error al autenticar al usuario';
        }
    } else {
        echo 'Token no valido';
    }
}

main();

