<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
ob_start();
@session_start(['name'=>'SITI']);





require_once "../config/APP.php";
?>
<script type='text/javascript'>
  
  // JavaScript anonymous function
  (() => {
      if (window.localStorage) {

          // If there is no item as 'reload'
          // in localstorage then create one &
          // reload the page
          if (!localStorage.getItem('refresh')) {
              localStorage['refresh'] = true;
              window.location.reload();
          } else {

              // If there exists a 'refresh' item
              // then clear the 'refresh' item in
              // local storage
              localStorage.removeItem('refresh');
          }
      }
  })(); // Calling anonymous function here only
</script>

        <title><?php echo COMPANY ?></title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo 'FAVICON' ?>">
        <LINK REL=StyleSheet HREF="./estilo_principal.css" TYPE="text/css" MEDIA=screen>
        <meta http-equiv='cache-control' content='no-cache'>
        <meta http-equiv='expires' content='0'>
        <meta http-equiv='pragma' content='no-cache'>
        <!-- DATATABLES -->
        <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="./css/estilo_tablas.css">



    <body>
        <?php include '../menu.php' ?>
        <?php include 'bandeja.php' ?>

        <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
        <script src="./js/datatable.js"></script>
    </body>


<?php ob_end_flush();?>

