<?php include("../template/cabecera.php");?>

<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

 
//CONECTANDO A LA BASE DE DATOS.................
include("../config/bd.php");


switch($accion){

    case "Agregar":

        //INSERT INTO `articulos` (`id`, `nombre`, `imagen`) VALUES (NULL, 'regalos php', 'imagen.jpg');
        
        $sentenciaSQL= $conexion->prepare("INSERT INTO articulos (nombre,precio,imagen) VALUES ( :nombre, :precio, :imagen);");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':precio',$txtPrecio);
        
        $fecha=new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

        if($tmpImagen!=""){

            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        }
        
        
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->execute();
        break;
    case "Modificar":
        $sentenciaSQL= $conexion->prepare("UPDATE articulos SET nombre=:nombre WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL= $conexion->prepare("UPDATE articulos SET precio=:precio WHERE id=:id");
        $sentenciaSQL->bindParam(':precio',$txtPrecio);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        if($txtImagen!=""){

            $fecha=new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

            $sentenciaSQL= $conexion->prepare("SELECT imagen FROM articulos WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $articulos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);       
            
            if(isset($articulos["imagen"]) && ($articulos["imagen"]!="imagen.jpg")) {
    
               if(file_exists("../../img/".$articulos["imagen"])){
    
                unlink("../../img/".$articulos["imagen"]);
               }
            }

        $sentenciaSQL= $conexion->prepare("UPDATE articulos SET imagen=:imagen WHERE id=:id");
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();   
         }

        //echo"Presionado boto modificar";
        break;
    case "Cancelar":
        
        header("location:productos.php");

        break;
    case "Seleccionar":
        $sentenciaSQL= $conexion->prepare("SELECT * FROM articulos WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $articulos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre=$articulos['nombre'];
        $txtPrecio=$articulos['precio'];
        $txtImagen=$articulos['imagen'];
        //echo"Presionado boto Seleccionar";
        break;
    case "Borrar":

        $sentenciaSQL= $conexion->prepare("SELECT imagen FROM articulos WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $articulos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);       
        
        if(isset($articulos["imagen"]) && ($articulos["imagen"]!="imagen.jpg")) {

           if(file_exists("../../img/".$articulos["imagen"])){

            unlink("../../img/".$articulos["imagen"]);
           }

        }
        
        $sentenciaSQL= $conexion->prepare("DELETE FROM articulos WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        break;

}
//MOSTRAR INFORMACION
$sentenciaSQL= $conexion->prepare("SELECT * FROM articulos");
$sentenciaSQL->execute();
$listaArticulos=$sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);

?>

<div class="col-md-5">

   <div class="card">
       <div class="card-header">
           Datos de Productos
       </div>

       <div class="card-body">
           
       <form method="POST" enctype="multipart/form-data">

<div class = "form-group">
<label for="txtID">ID</label>
<input type="text" requerid readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID" placeholder="ID">
</div>

<div class = "form-group">
<label for="txtNombre">Nombre:</label>
<input type="text" class="form-control" value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
</div>

<div class = "form-group">
<label for="txtPrecio">Precio:</label>
<input type="text" class="form-control" value="<?php echo $txtPrecio;?>" name="txtPrecio" id="txtPrecio" placeholder="Precio">
</div>



<div class = "form-group">
<label for="txtNombre">Imagen:</label>

<br/>

<?php

if($txtImagen!="") {?>

<img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?>" width="50" alt="" srcset=""> 

<?php } ?>

<input type="file"  class="form-control" name="txtImagen" id="txtImagen" placeholder="Nombre">
</div>


<div class="btn-group" role="group" aria-label="">
<button type="submit" name="accion" <?php echo($accion=="Seleccionar")?"disabled":"";?> value="Agregar" class="btn btn-success">Agregar</button>
<button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":"";?> value="Modificar" class="btn btn-warning">Modificar</button>
<button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":"";?> value="Cancelar" class="btn btn-info">Cancelar</button>
</div>

</form>

       </div>


   </div>


  
    
    
    
</div>

<div class="col-md-7">

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach($listaArticulos as $articulos) {?>
        <tr>
            <td><?php echo $articulos['id'];?></td>
            <td><?php echo $articulos['nombre'];?></td>
            <td><?php echo $articulos['precio'];?></td>
            <td>

            <img class="img-thumbnail rounded" src="../../img/<?php echo $articulos['imagen'];?>" width="50" alt="" srcset=""> 
            
            </td>

            <td>

            <form method="post">

              <input type="hidden" name="txtID" id="txtID" value="<?php echo $articulos['id'];?>"/>
              <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
              <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>

            </form>
        
        
        
        </td>

        </tr>
        <?php }?>
    </tbody>
</table>
    
</div>


<?php include("../template/pie.php");?>