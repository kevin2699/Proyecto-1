<?php

session_start();

$mensaje="";

if(isset($_POST['btnAccion'])){
    switch($_POST['btnAccion']){

        case"agregar":
          if(is_numeric( openssl_decrypt($_POST["id"],$COD, $KEY) )){
           $ID= openssl_decrypt($_POST["id"],$COD, $KEY);
           $mensaje.="Ok id correcto ".$ID."<br/>";
          }else{ $mensaje.="Error... id incorrecto ".$ID."<br/>"; }
            
           if(is_string(openssl_decrypt($_POST["nombre"],$COD, $KEY) )){
           $NOMBRE= openssl_decrypt($_POST["nombre"],$COD, $KEY);
           $mensaje.="Ok Nombre correcto ".$NOMBRE."<br/>";
           }else{ $mensaje.="Error... Algo pasa con el nombre "."<br/>"; break; }



           if(is_numeric(openssl_decrypt($_POST["precio"],$COD, $KEY) )){
            $PRECIO= openssl_decrypt($_POST["precio"],$COD, $KEY);
            $mensaje.="Ok Precio correcto ".$PRECIO."<br/>";
            }else{ $mensaje.="Error... Algo pasa con la precio "."<br/>"; break; }

            if(is_numeric(openssl_decrypt($_POST["cantidad"],$COD, $KEY) )){
                $CANTIDAD= openssl_decrypt($_POST["cantidad"],$COD, $KEY);
                $mensaje.="Ok Cantidad correcto ".$CANTIDAD."<br/>";
                }else{ $mensaje.="Error... Algo pasa con la cantidad "."<br/>"; break; }
            
            if(!isset($_SESSION['CARRITO'])){

                $articulos=array
                (
                'ID'=>$ID,
                'NOMBRE'=>$NOMBRE,
                'PRECIO'=>$PRECIO,
                'CANTIDAD'=>$CANTIDAD,   
                 );
                $_SESSION['CARRITO'][0]=$articulos;
                $mensaje= "Producto agregado al carrito";
            }
            
            else{

             $idArticulos=array_column($_SESSION['CARRITO'],"ID"); 
             
             if(in_array($ID,$idArticulos)){
                echo "<script> alert('Producto ya ha sido Seleccionado'); </script>";
                $mensaje= "";
            }else{

             $NumeroArticulos=count($_SESSION['CARRITO']);
             $articulos=array(
                'ID'=>$ID,
                'NOMBRE'=>$NOMBRE,              
                'PRECIO'=>$PRECIO,
                'CANTIDAD'=>$CANTIDAD,  

                );
                $_SESSION['CARRITO'][$NumeroArticulos]=$articulos;
                $mensaje= "Producto agregado al carrito";
             }
            }

             //$mensaje= print_r( $_SESSION,true);
            

        break;
        
        case "Eliminar":
            
        if(is_numeric( openssl_decrypt($_POST["id"],$COD, $KEY) )){
                      $ID= openssl_decrypt($_POST["id"],$COD, $KEY);
                      
              foreach($_SESSION['CARRITO'] as $indice=>$articulos){
              if($articulos['ID']==$ID){
                unset($_SESSION['CARRITO'][$indice]);
                echo"<script> alert('Elemento Borrado....'); </script>";
              }

              }


              }else{ 
               
                      $mensaje.="Error... id incorrecto ".$ID."<br/>"; }
        
              break;
    }

}

?>  