<!-- Button trigger modal -->

<div id="modalmover" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Selecciona la carpeta</h1>
        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <form action="../controller/movercarpeta.php" method="post">
        <input type="hidden" name="tokenCSRF" id="tokenCSRF">
      <div id="contmover"class="modal-body">
        
      
      </div>
      <div class="modal-footer">
        <script>
             
                  let Checked = null;
                  //The class name can vary
                  for (let CheckBox of document.getElementsByClassName('only-one')){
                     CheckBox.onclick = function(){
                     if(Checked!=null){
                        Checked.checked = false;
                        Checked = CheckBox;
                     }
                     
                     
                     Checked = CheckBox;
                  }
                  }
                  
                 
        </script>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>
