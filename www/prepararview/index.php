<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
@session_start(['name'=>'SITI']);
require_once "../config/APP.php";

require_once '../session.php';
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

              // If there exists a 'reload' item
              // then clear the 'reload' item in
              // local storage
              localStorage.removeItem('refresh');
          }
      }
  })(); // Calling anonymous function here only
</script>

        <title><?php echo COMPANY ?></title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo FAVICON ?>">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
        <LINK REL=StyleSheet HREF="../estilo_principal.css" TYPE="text/css" MEDIA=screen>
        <meta http-equiv='cache-control' content='no-cache'>
        <meta http-equiv='expires' content='0'>
        <meta http-equiv='pragma' content='no-cache'>

    <body style="padding: 0; margin: 0; background-color: #555555">
        <?php include './header.php' ?>
        <?php include './cuerpo.php' ?>
    </body>
