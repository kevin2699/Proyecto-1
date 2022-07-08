<?php include("template/cabecera.php");?>

<?php include("administrador/config/bd.php");
$sentenciaSQL= $conexion->prepare("SELECT * FROM articulos");
$sentenciaSQL->execute();
$listaArticulos=$sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);
include("carr.php");
?>

<?php  

if($_POST){

    $total=0;
    $SID=session_id();
    $Correo=$_POST['email'];
    foreach($_SESSION['CARRITO'] as $indice=>$articulos){

    $total=$total+($articulos['PRECIO']*$articulos['CANTIDAD']);

    }

    $sentenciaSQL= $conexion->prepare("INSERT INTO tblventas (ClaveTransaccion,PaypalDatos,Fecha, Correo, Total, Status) 
    VALUES (:ClaveTransaccion, '',NOW(),:Correo ,:Total,'pendiente' );");

    $sentenciaSQL->bindParam(":ClaveTransaccion",$SID);
    $sentenciaSQL->bindParam(":Correo",$Correo);
    $sentenciaSQL->bindParam(":Total",$total);
    $sentenciaSQL->execute();
    $idventa=$conexion->lastInsertId();

    foreach($_SESSION['CARRITO'] as $indice=>$articulos){

        $sentenciaSQL= $conexion->prepare ("INSERT INTO tbldetalleventa ( IDVENTA, IDPRODUCTO, PRECIOUNITARIO, CANTIDAD, DESCARGADO) 
        VALUES (:IDVENTA, :IDPRODUCTO, :PRECIOUNITARIO , :CANTIDAD, '0');");

$sentenciaSQL->bindParam(":IDVENTA",$idventa);
$sentenciaSQL->bindParam(":IDPRODUCTO",$articulos['ID']);
$sentenciaSQL->bindParam(":PRECIOUNITARIO",$articulos['PRECIO']);
$sentenciaSQL->bindParam(":CANTIDAD",$articulos['CANTIDAD']);
$sentenciaSQL->execute();



    }

}

?>
 


<div class="jumbotron text-center">
    <h1 class="display-4">¡Paso Final!</h1>
    <hr class="my-4">
    <p class="lead"> Estas a punto de pagar con paypal la cantidad de:
     <h4> $ <?php echo number_format($total,2);?> </h4>
    </p>
    




    <p>Los productos pódran ser descargados una ves que se procese el pago <br/>

    <strong> Para aclaraciones : kevin.andi4174@utc.edu.ec </strong>
    </p>
    
</div>

<section class="form-register">
    <h4>Complete el formulario</h4>
    <input class="controls" type="text" name="nombres" id="nombres" placeholder="Ingrese su Nombre">
    <input class="controls" type="text" name="apellidos" id="apellidos" placeholder="Ingrese su Apellido">
    <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su Correo">
    <input class="controls" type="text" name="asunto" id="asunto" placeholder="Ingrese el asunto">
    <input class="controls" type="text" name="mensaje" id="mensaje" placeholder="Ingrese un mensaje">
    <p> $ <?php echo number_format($total,2);?></p>
    <input class="botons" type="submit" value="Enviar">
   
  </section>




<?php include("template/pie.php"); ?>