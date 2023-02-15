<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../../Models/DB.php';
include_once '../../Models/User.php';
include_once '../../Models/Session.php';

$DB = new DB();
$usuario = new User();
$session = new Session();
$token = '77FbYJX8z6Wvzj';
$datos_post = [];


if (isset($_POST['email'])) {
    $datos_post = $_POST;
} else {
    $datos_post = json_decode(file_get_contents('php://input'), true);
}
// var_dump($datos_post);

if ($datos_post['token'] != $token) {
    echo "<script>alert('Token incorrecto');</script>";
    echo "<script>history.back();</script>";
    die();
}

if ($datos_post['action'] == "verify") {
    verificarUsuario($usuario, $datos_post);
}

if ($datos_post['action'] == "login") {
    logearPersona($datos_post, $usuario, $session);
}

if ($datos_post['action'] == "register") {
    registrarPersona($datos_post, $usuario, $DB);
    echo "<script>history.back();</script>";
}

function registrarPersona($datos_post, $usuario, $DB)
{
    if ($usuario->userExist($datos_post['email'])) {
        echo json_encode(array('state' => 2, 'message' => 'The user is already registered'));
    } else {

        if ($usuario->createUser($datos_post['password'], $datos_post['name'], $datos_post['lastname'], $datos_post['doc_type'], $datos_post['doc_id'], $datos_post['email'], $datos_post['cellphone'])) {
            createFolder($DB->getLastId());
            echo json_encode(array('state' => 1, 'message' => 'The user was registered successfully'));
        } else {
            echo json_encode(array('state' => 4, 'message' => 'The user could not be registered'));
        }
    }
}

function logearPersona($datos_post, $usuario, $session)
{
    if ($usuario->loginUser($datos_post['email'], $datos_post['password'])) {
        if (!empty($usuario)) {
            $session->setCurrentUser($usuario);
            header('Location: http://enroll.portal-id.com/firmagate/dashboard/index.php');
        }
    } else {
        echo json_encode(array('state' => 3, 'message' => 'The user does not exist'));
    }
}

function verificarUsuario($usuario, $datos_post)
{
    if ($usuario->userExist($datos_post['email'])) {
        echo json_encode(array('state' => 2, 'message' => 'The user is already registered'));
    } else {
        echo json_encode(array('state' => 5, 'message' => 'The user is not registered'));
    }
}

function createFolder($lastId)
{
    $dir_ruta = "../bodega/precarga/";
    mkdir($dir_ruta.$lastId."/imgfirmatmp", 0777, true);
    mkdir($dir_ruta.$lastId."/imgfirmafija", 0777, true);
    mkdir($dir_ruta.$lastId."/firmadigital", 0777, true);
    mkdir("../bodega/firmado/" . $lastId, 0777, true);
    mkdir("../bodega/eliminado/" . $lastId, 0777, true);
}




// if($_SERVER['REQUEST_METHOD']=='POST'){
//     $datos_post = json_decode(file_get_contents('php://input'),true);
    
//     if (count($datos_post)<=2) {
//         if($usuario -> loginUser($datos_post['email'], $datos_post['contrasena'])){
//             if(!empty($usuario)){
//                 $session -> setCurrentUser($usuario);
//                 // print_r($usuario);
//                 header('Location: http://enroll.portal-id.com/firmagate/dashboard/index.php');
//             }
//         }else{
//             echo json_encode(array('state'=>3,'message'=>'The user does not exist'));
//         }
//     }else{
//         // print_r($usuario->userExist($datos_post['email']));
//         if($usuario->userExist($datos_post['email'])){
//             if($usuario -> createUser($datos_post['contrasena'], $datos_post['nombre'], $datos_post['apellido'], $datos_post['tipo_doc'], $datos_post['documento'], $datos_post['email'], $datos_post['celular'])){
//                 echo json_encode(array('state'=>1,'message'=>'The user was registered successfully'));
//             }else{
//                 echo json_encode(array('state'=>4,'message'=>'The user could not be registered'));
//             }
//         }else{
//             echo json_encode(array('state'=>2,'message'=>'The user is already registered'));
//         }
//     }
    
// }else{
//     echo json_encode(array('message'=>'Please send by POST method'));
// }

// print_r($datos_post);


// var_dump($_POST);

//Recibir peticiones del usuario


//Crear


//Obtener un usuario


//Obtener todos los usuarios



//Loguear el usuario
