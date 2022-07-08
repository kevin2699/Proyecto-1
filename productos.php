<?php include("template/cabecera.php");?>



<?php include("administrador/config/bd.php");
$sentenciaSQL= $conexion->prepare("SELECT * FROM articulos");
$sentenciaSQL->execute();
$listaArticulos=$sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);
include("carr.php");
?>

<div class="container">
    <?php if($mensaje!="") { ?>
<div class="alert alert-success">
<?php echo($mensaje); ?>
<a  href="carrito.php" class="badge btn-success" role="button">Ver carrito</a>
</div>
<?php }?>

</div>




<?php foreach($listaArticulos as $articulos){?>


<div class="col-md-3">
<div class="card">
    <img class="card-img-top" src="./img/<?php echo $articulos['imagen'];?>" alt="" height="320px" >
    <div class="card-body">
        <h4 class="card-title">Descripcion : <?php echo $articulos['nombre'];?></h4>
        <h4 class="card-title">Precio : $ <?php echo $articulos['precio'];?></h4>
        
        <form action="" method="post">
        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($articulos['id'],$COD, $KEY) ;?>">
        <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($articulos['nombre'],$COD, $KEY) ;?>">
        <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($articulos['precio'],$COD, $KEY) ;?>">
        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,$COD, $KEY) ;?>">
        
        <button class="btn btn-primary" 
        name="btnAccion" 
        value="agregar" 
        type="submit"
        >
        Agregar al carrito
        </button>
        <a name="" id="" class="btn btn-primary" href="https://www.facebook.com/Recuerdos-y-pi%C3%B1ateria-camilita-latacunga-121883272940563/photos/?ref=page_internal" role="button"> Ver mas</a>

        </form>
        
    
</div>
</div>
</div>

<?php }?>


<?php include("template/pie.php"); ?>