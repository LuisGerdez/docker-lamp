<!-- Large modal -->
<?php include_once("../../Models/CSRFToken.php"); ?>

<div id="modal2" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="table-wrapper">
      <div class="col-md-12 form-control text-center x_panel">
        <h1>CREAR NUEVA CARPETA</h1>
        <!-- action="../controller/create.php" -->
        <form action="../controller/create.php" method="post" id="formFolder">
          <input type="hidden" name="tokenCSRF" id="tokenCSRF" value='<?= CSRFToken::setToken2(); ?>'>
          NOMBRE DE LA CARPETA
          <input type="text" name="carp_nombre" id="nombre">
          <div class="col-md-12" style="padding-top:5px;padding-right:5px;">
            <button id="crear" type="submit" class="btn btn-success">Crear</button>
          </div>
        </form>
      </div>
    </div>
    </div>
  </div>
</div>
