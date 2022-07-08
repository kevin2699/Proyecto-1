<?php 

session_start();
if(!isset($_SESSION['usuario'])){
header("location:../index.php");

}else{

  if($_SESSION['usuario']=="ok"){
    $nombreUsuario=$_SESSION["nombreUsuario"];
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style="background:url('https://www.xtrafondos.com/wallpapers/resized/hexagonos-colores-pastel-7952.jpg?s=large') no-repeat; background-size: cover ;">
  
    <?php $url="http://".$_SERVER['HTTP_HOST']."/recuerdos" ?>

   <nav class="navbar navbar-expand-lg navbar-light bg-info">
       <div class="nav navbar-nav">
           <a class="nav-item nav-link active" href="#">ADMINISTRADOR DEL SITIO WEB <span class="sr-only">(current)</span></a>
           <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/inicio.php">Inicio</a>
           <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/seccion/productos.php">Articulos</a>
           <a class="nav-item nav-link" href="<?php echo $url;?>">Ver sitio web</a>
           <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/seccion/cerrar.php">Cerrar</a>

       </div>
   </nav>
<div class="container">

<br/>

   <div class="row">
         
      