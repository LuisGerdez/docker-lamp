
<?php
// require_once '../vendor/autoload.php';
@session_start(['name' => 'SITI']);

class Carpetas {

    public static function mostrarCarpetas($id) {

        include "../../conexion.php";

        $lines = '';

        $datos = mysqli_query(
            $link,
            "SELECT * FROM carpetas WHERE usu_id='" . $id . "'"
        );
        
        mysqli_close($link);

        while ($row = mysqli_fetch_assoc($datos)) {

            $lines .= "
                <div class='folder-container'>
                    <div class='imagen-container'>
                        <img class='imagen' src='../../recursos/iconos/carpeta.png'>
                    </div>
                    <div class='separador'></div>
                    <div class='info'>
                        <span class='titulo'>". $row["carp_nombre"] ."</span>
                        <div class='datos'>
                            <span id='item'>Nº de Archivos: <span id='numero'>". Carpetas::contador($row["id_carpeta"]) ."</span></span>
                            <span id='item'>Fecha de Creación: ". $row["carp_fecha"] ."</span>
                            <span id='item'>Hora de Creación: ". $row["carp_hora"] ."</span>
                        </div>
                    </div>
                    <img class='eliminar' src='../../recursos/iconos/borrar.png' title='Eliminar' alt='Eliminar'>
                    <img class='visibilidad' title='Ver' src='../../recursos/iconos/visibilidad.png'>".
                    "<input type='hidden' value=". $row['id_carpeta']. ">
                </div>
            ";
        }
        
        echo $lines;
    }
    
    public static function eliminarCarpeta($parametro){
        include "../../conexion.php";
        mysqli_query(
            $link,
            "DELETE FROM carpetas WHERE id_carpeta = $parametro AND usu_id =".$_SESSION["codigo_usuario"].""
        );
        mysqli_close($link);
    }

    public static function contador($parametro) {
        include "../../conexion.php";
        $datos = mysqli_query(
            $link,
            "SELECT COUNT(documento.id_carpeta)
            FROM documento 
            INNER JOIN carpetas 
            ON documento.id_carpeta = carpetas.id_carpeta
            WHERE documento.id_carpeta= $parametro AND doc_usuari=" . $_SESSION["codigo_usuario"] . ""
        );
        mysqli_close($link);

        foreach ($datos as $key) {
            return $key['COUNT(documento.id_carpeta)'];
        }
    }

    public static function filtrarCarpeta(string $filtro): array {
        
        include "../../conexion.php";
        $resultado = [];
        $sql = "SELECT * FROM carpetas WHERE usu_id = ".$_SESSION["codigo_usuario"]." AND carp_nombre LIKE '%".$filtro."%' ORDER BY carp_nombre ASC";
        $datos = mysqli_query($link, $sql);        
        mysqli_close($link);

        while($row = mysqli_fetch_assoc($datos)) {
            
            $carpeta = [];
            $carpeta['id'] = $row['id_carpeta'];
            $carpeta['nombre'] = $row['carp_nombre'];
            $carpeta['archivos'] = Carpetas::contador($row["id_carpeta"]);
            $carpeta['fecha'] = $row["carp_fecha"];
            $carpeta['hora'] = $row["carp_hora"];
            array_push($resultado, $carpeta);
        }

        return $resultado;
    }

    public static function documentosCarpetas(int $id_carpeta): array {

        include "../../conexion.php";
        
        $resultado = [];
        $sql = "SELECT doc_id, doc_ruta, doc_nombre, doc_fecha_f, det_cordes, doc_estado FROM documento
        INNER JOIN detalledocumento ON doc_id = det_docume
        WHERE id_carpeta = $id_carpeta AND doc_usuari = ".$_SESSION['codigo_usuario'];
        $datos = mysqli_query($link, $sql);        
        mysqli_close($link);
        
        while($row = mysqli_fetch_assoc($datos)) {
            
            $documento = [];
            $documento['id_documento'] = $row['doc_id'];
            $documento['ruta'] = $row['doc_ruta'];
            $documento['nombre'] = $row['doc_nombre'];
            $documento['fecha'] = $row["doc_fecha_f"];
            $documento['firmantes'] = $row["det_cordes"];
            $documento['estado'] = $row["doc_estado"];
            array_push($resultado, $documento);
        }

        return $resultado;
    }
}

if(isset($_POST['id'])) {
    
    Carpetas::eliminarCarpeta(intval($_POST['id']));
    echo json_encode(['status' => 200]);
}

if(isset($_POST['filtro'])) {

    echo json_encode([
        'status' => 200,
        'response' => Carpetas::filtrarCarpeta($_POST['filtro'])
    ]);
}

if(isset($_POST['id_carpeta'])) {

    echo json_encode([
        'status' => 200,
        'datos' => Carpetas::documentosCarpetas($_POST['id_carpeta'])
    ]);
}