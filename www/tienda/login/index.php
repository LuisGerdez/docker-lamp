<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/login.css">

</head>
<body>



<form action="/action_page.php" method="post">
  <div class="container-form">
  <div class="imgcontainer">
    <img src="../recursos/logo.png" alt="alt" width="120" height="45" />
  </div>

  <div class="container">
    <label for="uname"><b>Correo electrónico</b></label>
    <input type="text" placeholder="Ingrese su correo electrónico" name="uname" required>

    <label for="psw"><b>Contraseña</b></label>
    <input type="password" placeholder="Ingrese su contrase&ntilde;a" name="psw" required>
        
    <button type="submit">Ingresar</button>
    <p><a href="olvido-contrasena">Olvidé mi contraseña.</a></p>
    <p><a href="registro-usuario-login">Registrar una nueva cuenta.</a></p>
  </div>

  </div>
</form>

</body>
</html>
