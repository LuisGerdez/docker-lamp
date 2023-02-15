<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-light-grey w3-card">
  <div class="w3-centered">
    <a href="../dashboard"><button class="w3-button w3-amber w3-round w3-small"><b>Iniciar ahora</b></button></a>
  </div>
  <button class="w3-bar-item w3-button tablink <?php echo $pagina == 'pendientes' ? 'w3-dark-grey' : ''; ?>"><i style="font-size: 16px;" class="fa fa-paperclip"></i> <a href="?p=pendientes" rel="noopener noreferrer"> Pendientes</a></button>
  <button class="w3-bar-item w3-button tablink <?php echo $pagina == 'firmados' ? 'w3-dark-grey' : ''; ?>"><i style="font-size: 16px;" class="fa fa-check"></i> <a href="?p=firmados" rel="noopener noreferrer"> Firmados</a></button>
  <button class="w3-bar-item w3-button tablink <?php echo $pagina == 'eliminados' ? 'w3-dark-grey' : ''; ?>"><i style="font-size: 16px;" class="fa fa-trash"></i> <a href="?p=eliminados" rel="noopener noreferrer"> Eliminados</a></button>
  <button class="w3-bar-item w3-button tablink"><i style="font-size: 16px;" class="fa fa-clipboard"></i> <a href="<?php echo SERVERURL ?>validardocumento" target="_blank" rel="noopener noreferrer"> Validar documento</a></button>
</div>