<form action="../documentos/index.php" id="formulario" name="formulario" method="post" enctype="multipart/form-data" onsubmit="return enviar();">
<div id="Pendientes" class="w3-container gestion">
  <br>
    <table class="default">
  <tr>
    <td><h3>Pendientes</h3></td>
    <td style=" text-align: right; width: 100%; padding: 5px 10px;"><a href="reports/rep-pendientes.php"><button class="btn-export"><i class="fas fa-file-excel" style="font-size: 18px;"></i>&nbsp;&nbsp;Exportar datos</button></a></td>
  </tr>
</table>
    <table id="tabla_pendientes" class="nowrap" style="width:100%; border-bottom: 0px">
        <thead>
            <tr>
                <th style="display:none;">#</th>
                <th style="font-size: 18px; font-family: 'Poppins-Bold';">Documento</th>
                <th style="font-size: 18px; font-family: 'Poppins-Bold';">Fecha de creaci&oacute;n</th>
                <th style="font-size: 18px; font-family: 'Poppins-Bold';">Estado</th>
                <th style="font-size: 18px; font-family: 'Poppins-Bold';">Observaciones</th>
                <th style="font-size: 18px; font-family: 'Poppins-Bold';">Opciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<input class='type-file' type='file' id='nombre_archivo' name='nombre_archivo' onchange='cargarDocumento()' style='display: none; width: 1px; height: 1px' accept='application/pdf'/>
<input type="hidden" name="idArchivo" id="idArchivo">
<input type="hidden" name="nombreArchivo" id="nombreArchivo">
<input type="hidden" name="rutaArchivo" id="rutaArchivo">
</form>
