<?php
session_start();
if($_POST){
if(($_POST['usuario']=="admin")&&($_POST['contraseña']=="sistema")){
    $_SESSION['usuario']="ok";
    $_SESSION['nombreUsuario']="Admin";
    header('location:inicio.php');
}else{

    $mensaje="Error: El usuario o contraseña son incorretos";
}

}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style="background:url('https://www.xtrafondos.com/wallpapers/resized/retrowave-lineas-montanas-3063.jpg?s=large') no-repeat; background-size: cover ;"> 
      
  <div class="container">
      <div class="row">

      <div class="col-md-4">
          
      </div>

          <div class="col-md-4">

<br/>      <br/>     <div class="login-logo text-center">
                 <a href="./" style="color:white;"><b> LOGIN</b>_SISTEMA<a/>
              </div>
              
              <br/><br/>
          <div class="card">

              <div class="card-body">

              <?php if(isset($mensaje)) {?>
              <div class="alert alert-danger" role="alert">
                  <?php echo $mensaje;?>
              </div>
              <?php }?>

              <form method="POST">

              <div class = "form-group">
              <label >Usuario</label>
              <input type="text" class="form-control" name="usuario" placeholder="Escribe tu Usuario">
              
              </div>


              <div class="form-group">

              <label >Contraseña:</label>
              <input type="password" class="form-control" name="contraseña"  placeholder="Escribe tu contraseña">
              </div>
              
              <button type="submit" class="btn btn-primary">Entrar al administrador</button>
              </form>
              


              </div>
             
              </div>
          </div>

          </div>
          
      </div>
  </div>

  </body>
</html>