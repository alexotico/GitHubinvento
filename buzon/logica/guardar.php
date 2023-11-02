<?php
 require 'conexion.php';
 
 $comentario = $_POST['comentario'];
 $sugerencias = $_POST['sugerencias'];
 $quejas = $_POST['quejas'];
 $id = $_POST['id'];

$insertar = "INSERT INTO clientes VALUES ('$id','$comentario','$sugerencias','$quejas') ";

/*$borrar = "DELETE FROM clientes WHERE VALUES = ('$comentario','$sugerencias','$quejas','$id') ";*/

$query = mysqli_query($conectar, $insertar,$borrar);

if($query){

   echo "<script> alert('enviado con exito');
    location.href = '../buzon.html';
   </script>";

}else{
    echo "<script> alert('incorrecto');
    location.href = '../buzon.html';
    </script>";
}


?>