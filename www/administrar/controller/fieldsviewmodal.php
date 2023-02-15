<?php
@session_start(['name' => 'SITI']);
 include "../../conexion.php";

    $id=$_POST['id'];
   
    //Codigo del usuario registrado
    
    $sql = "SELECT * FROM documento
            WHERE id_carpeta='".$id."' AND doc_usuari='".$_SESSION['codigo_usuario']."' AND doc_estado='Firmado'";
    $field = $link->query($sql);
    $empty=$field->num_rows;

    if($empty>0){
    foreach ($field as $key) {
        echo '<tr>
                    <td>'.$key['doc_nombre'].'</td>
                    <td>'.$key['doc_fecha_f'].'</td>
                    <td>'.traerDatosDestinatarios($key['doc_id']).'</td>
                    <td>'.$key['doc_estado'].'</td>
                    <td><button name="descargarFirmados" id="descargarFirmados" class="fl-button" value="'. $key['doc_ruta'].'">Descargar</button><button  type="button" name="mover" class="" style="    cursor: pointer;
                    background-color: #BDC300;
                    color: white;
                    padding: 5px 17px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    border: 0;" id="mover"value="'.$key['doc_id'].'">MOVER</button> </td>      
             </tr>';
    }
   }else{
    echo "<tr><td colspan='5'>Vacio!</td></tr>";
   }
   function traerDatosDestinatarios($parametro)
   {
       include "../../conexion.php";
       $array_firmados = array();
       $array_pendientes = array();
       $datos = mysqli_query(
           $link,
           "SELECT det_nomdes,det_firma FROM detalledocumento INNER JOIN documento ON detalledocumento.det_docume = documento.doc_id INNER JOIN usuario ON usuario.usu_id=documento.doc_usuari WHERE doc_id= $parametro "
       );
       mysqli_close($link);
   
       while ($consulta = mysqli_fetch_array($datos)) {
           if ($consulta['det_firma'] == 1) {
               array_push($array_firmados, $consulta['det_nomdes']);
           } else {
               array_push($array_pendientes, $consulta['det_nomdes']);
           }
       }
       if (empty($array_firmados)) {
           return 'Pendientes: ' . implode(",", $array_pendientes);
       } else if (empty($array_pendientes)) {
           return 'Firmados: ' . implode(",", $array_firmados);
       }
   
       return 'Firmados: ' . implode(",", $array_firmados) . '; ' . 'Pendientes: ' . implode(",", $array_pendientes);
   }
   
?>