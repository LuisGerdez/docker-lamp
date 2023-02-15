<?php
@session_start(['name' => 'SITI']);
include "../../conexion.php";
$carp_nombre=$_POST['carp_nombre'];
$id = $_SESSION['codigo_usuario'];
if(empty($carp_nombre)){
    echo "<script type='text/javascript'>
    alert('no puede mandar un valor vacio');
    window.location.href='../layout/layout.php?menu=carpetas'
</script>"; 
}else {
    $sql="SELECT * FROM carpetas WHERE carp_nombre='$carp_nombre' AND usu_id= '$id'";
    $nombre=$link->query($sql);
    $exe=$nombre->num_rows;
    if ($exe>0) {
        echo "<script type='text/javascript'>
            alert('No puede tener 2 carpetas con el mismo nombre!');
            window.location.href='../layout/layout.php?menu=carpetas'
        </script>";
    }else{
        $sql = "INSERT INTO carpetas 
        values(NULL,'".$carp_nombre."',CURRENT_DATE,CURRENT_TIME,NULL,
            '".$_SESSION['codigo_usuario']."')";
    
    $folder = $link->query($sql);
    echo "<script type='text/javascript'>
    alert('Se creo correctamente!');
    window.location.href='../layout/layout.php?menu=carpetas'
</script>"; 
    }
}
?>