<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> RECUERDOS </title>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>
<body style="background:url('https://www.xtrafondos.com/wallpapers/resized/pajaros-volando-en-cielo-pastel-3841.jpg?s=large') no-repeat; background-size: cover ;">
    

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <ul class="nav navbar-nav">
            
             <a class="navbar-brand text-white">
            <img src="https://aurora.libnet.info/images/events/aurora/pinata.jpg" height="25px">
            </a> 

            <li class="nav-item">
    
                <a class="nav-link" href="index.php">Inicio</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="productos.php">Productos</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="carrito.php">Carrito 
                    (<?php echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']); ?>) 
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="nosotros.php">Nosotros</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="contacto.php">Contacto</a>
            </li>
            <li class="nav-item  ">
                <a class="nav-link " href="http://localhost/recuerdos/administrador/"> Administrador </a>
            </li>

        </ul>
    </nav>

    <div class="container">
        <br/>
        <div class="row"> 