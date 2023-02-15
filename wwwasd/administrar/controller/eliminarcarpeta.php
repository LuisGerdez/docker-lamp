<?php
@session_start(['name' => 'SITI']);
include "../../conexion.php";
$id_carpeta=$_POST['id'];  
        $sql ="SELECT COUNT(documento.id_carpeta)
                    FROM documento 
                    INNER JOIN carpetas 
                    ON documento.id_carpeta = carpetas.id_carpeta
                    WHERE documento.id_carpeta= $id_carpeta AND doc_usuari=".$_SESSION["codigo_usuario"]."";
        $consult = $link->query($sql);
        
        foreach ($consult as $key) {
            
          $exe=$key['COUNT(documento.id_carpeta)'];
        }
        if ($exe==0) {
            $sql = "DELETE FROM carpetas WHERE id_carpeta='".$id_carpeta."'";
            $delete = $link->query($sql);
            echo $sql;
            echo "<script type='text/javascript'>
                     window.location.href='../layout/layout.php?menu=carpetas'
                  </script>";
        }else {
            echo "<script type='text/javascript'>
            alert('Primero mueva todos los documentos a otra carpeta para poder eliminarla');
            </script>";
        }
            
            
        


?>