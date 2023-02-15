<?php
@session_start(['name' => 'SITI']);
 include "../../conexion.php";

    $id=$_POST['id'];
   
    //Codigo del usuario registrado
    $sql = "SELECT * FROM carpetas
            WHERE usu_id='".$_SESSION['codigo_usuario']."'";
    $folder = $link->query($sql);
    $empty=$folder->num_rows;
  
   $gatillo=0;
    if($empty>0){
    foreach ($folder as $key) {
        echo "
                 <table> 
                 <tr>  
                    <td style='width:10px;'><div class='input-group mb-3'>
                    <div class='input-group-prepend'>
                      <div class='input-group-text'>
                     ".comprobar($key['id_carpeta'],$id)."
                      </div>
                    </div>
                  </div></td><td style='text-align:left;font-weight:bolder;'><label>".$key['carp_nombre']."</label><input name='doc_id' type='hidden' value='".$id."'></td>
                </tr>
                    </table>
                    ";
                }
   }else{
    echo "<tr><td colspan='5'>Vacio!</td></tr>";
   }

 
function comprobar($carpeta,$documento)
{
    include "../../conexion.php";
    $datos = mysqli_query(
      $link,
      "SELECT doc_id,id_carpeta
       FROM documento
       WHERE id_carpeta='".$carpeta."' AND doc_id='".$documento."'"
  );

  mysqli_close($link);  
 $exe=$datos->num_rows;
    if($exe>0){
     
     return "<input type='radio' class='only-one'  checked name='carp[]' value='".$carpeta."'>";
   
  }else{
    
     return  "<input type='radio' class='only-one'  name='carp[]' value='".$carpeta."'>";
    
  } 
 
}
?>