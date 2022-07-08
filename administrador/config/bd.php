<?php

$KEY="kevin";
$COD="AES-128-ECB";

$host="localhost";
$bd="sitio";
$usuario="root";
$contraseña="";

try {
    $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contraseña);
    if($conexion){echo"";}
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>