<?php 
require_once("layout/head.php");
include("config/conexion.php");
$mensaje="";
$nombre="";
$usuario="";
    $clave="";
//AQUI ESTAMOS EVALUENDO EL BOTON REGISTRAR PARA INSERTAR LOS DATOS

if(isset($_POST["registrar"]))
{
  //===================INICIALIZANDO LAS VARIABLES PARA INSERTARLAS========
    $nombre=$_POST["nombre"];
    $usuario=$_POST["usuario"];
    $clave=$_POST["clave"];
    $user_password_hash = password_hash($clave, PASSWORD_DEFAULT);
         //======================= VALIDAN CAMPOS VACIOS===================================
if(!empty($nombre) && $usuario!="" && $clave!="")
    {         //================= QUERY STRING (QST) PARA INSERTAR LOS DATOS====================
            $sql="INSERT INTO usuarios(nombrecompleto,username,pass) VALUE
            ('{$usuario}','{$nombre}','{$user_password_hash}')";
         // LA FUNCION mysqli_query RECIBE LA CONEXION QUE ESTA INCLUIDA EN LA LINEA 3 Y LA (QST)
            $insertar=mysqli_query($mysqli,$sql);
            if($insertar){
                $mensaje="Registro Insertado";     
            }
    }
    else
    {
        echo "aun hay campos sin completar";
    } 
}

//==================AQUI ESTA ELIMINANDO EL USUARIO  
if($_GET)
{
    if($_GET['eliminar'])
    {
        $eliminarUsuario = "DELETE FROM usuarios WHERE user_id = ".$_GET['eliminar'].";";
        $resultadosId = mysqli_query($mysqli, $eliminarUsuario); 
        $mensaje= "Registro Eliminado";
    } 
  
}

//===================AQUI ESTA CARGANDO LA INFORMACION DE LOS USUARIOS 
  $sql2="SELECT username,nombreCompleto,user_id FROM usuarios";
  $consulta=mysqli_query($mysqli,$sql2);
?>







<button id="volver" type="submit" name="volver a cbanklin"><a href="http://localhost/GitHubinvento/GitHubP1.php">Volver a Cbanklin</a></button>



<main class="container">
<h3>Formulario de Registro Login</h3>
<div class="row">
<div class="col-md-5">
    <form method="post" action="registrar.php">
        <label for="txt_nombre">Nombre</label>
        <input type="text" class="form-control" name="nombre" id="txt_nombre"><br/>
        <label for="idUsuario">Usuario</label>
        <input type="text" class="form-control" name="usuario" id="idUsuario"><br/>
        <label for="passWord">Password</label>
        <input type="passWord" class="form-control" name="clave" id="passWord"><br/>
        <button type="submit" class="btn btn-primary mb-3" name="registrar">Registrar Usuario</button>
       
       <hr/> 
         <?php
           // echo $mensaje;
         ?>   
  
</form>
</div>
<div class="col-md-7">
<table class="table table-striped">
    <thead>
        <tr>
            <td>Nombre</td>
            <td>Usuario</td>
            <td colspan="2">Acciones</td>
        </tr>
    </thead>
    <tbody>
        
         <!--AQUI ESTAMOS RECORRIENDO UN ARREGLO (mysqli_fetch_array) Y  MOSTRANDO LA INFORMACION CARGADA -->
             <?php
             while ($row=mysqli_fetch_array($consulta))
             {
                echo "<tr>  <td>".$row['username']."</td>
                            <td>".$row['nombreCompleto']."</td>
                            <td><a href='editar.php?editar={$row['user_id']}' class='btn btn-warning' >editar</a></td>
                            <td><a href='registrar.php?eliminar={$row['user_id']}' onClick=\"return confirm('Esta seguro que desea eliminar este registro?')\"  class='btn btn-danger'>Eliminar</a></td>
                      </tr>";
            
             }
             //ESTA FUNCION CIERRA LA  CONEXION
             $mysqli->close();
           
           ?>     
    </tbody>

</table>
</div>
</div>
  </main>
<?php 
require_once("layout/footer.php");

?>

<style>

body{

background-attachment: fixed;
background-repeat: no-repeat;
background-size: cover;
background-position: center center;
background-image: linear-gradient(rgba(5, 7, 12, 0.75),  rgba(5, 7, 12, 0.75)), url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTc9BTPi6ZxfJ4b6QX6C_h1fpIvQ0Z-_4_EJA&usqp=CAU);
}


.container{color: white;}


*{color: white;}




</style>