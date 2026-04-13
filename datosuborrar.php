<?php
session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';

if (!isset($_SESSION["id_usuario"])) {
    header("Location: index.php");
}

$idUsuario = $_SESSION['id_usuario'];
$sql = "SELECT id, usuario, nombre, id_tipo FROM usuarios WHERE id = '$idUsuario'";
$resultado = $mysqli->query($sql);
$row = $resultado->fetch_assoc();

$folioe = $_POST['folioe'];


$consul = "SELECT * 
           FROM usuarios 
           WHERE usuario = '$folioe'";
$buscador = mysqli_query($mysqli, $consul);
$numero = mysqli_num_rows($buscador);




?>

<html>
<link rel="stylesheet" href="css/main.css" rel=stylesheet />

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<head>
    <title>Biblioteca</title>
</head>

<body style="background-color:  #F2F2F2;">

<?php
if ($row['id_tipo'] == 1) {
	
?>

<!-- destruccion  -->
<script>
window.onload = function(){killerSession();}
function killerSession(){
setTimeout("window.open('logout.php','_top');",600000);
}
</script>
<!-- destruccion  -->

    <center>

        <div class="contenedorcabeza">

            <div4>
                <a href="welcome.php"><img src="img/cabezas.png"></a>
            </div4>

            <div2>
                <h1>Corrobora los datos del Usuario que estas por Eliminar</h1>
            </div2>

            <div1>
                <h2><?php echo 'Bienvenido: <br>' . utf8_decode($row['nombre']); ?>
                    <br>
                    <br>
                    <?php echo 'Matricula: <br>' . utf8_decode($row['usuario']); ?>
                    <br>
                    <br>
                    <a href="logout.php"><img src="img/exit.png"></a>
                </h2>
            </div1>

        </div>

<?php
if ($numero == 1) {?>

    <form name="eliminar" method="POST" action="borrarusuario.php">
        
            

    <table border="0">
        <tr></tr>
        <tr></tr>
        <tr></tr>
         <tr>
            <td colspan="8" align="center">
            <h4>Estas a punto de eliminar a este Usuario de la base de datos de manera permanente, asegúrate de que 
                la información es la correcta antes de continuar.</h4>
            </td>
        </tr>
        <tr>
            <td colspan="8">
                <hr size=5 noshade="noshade" color="#007336">
            </td>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($buscador)) {
            
            switch ($row['activacion']) {
                case 0:
                    $row['activacion'] = "Usuario No Activo <br>😢";
                    break;
                
                case 1:
                    $row['activacion'] = "Usuario Activo <br>😊";
                    break;
            }

            switch ($row['id_tipo']) {
                case 1:
                    $row['id_tipo'] = "Administrador";
                    break;
                
                case 2:
                    $row['id_tipo'] = "Usuario";
                    break;
            }
 
            ?>
        <input id="ido" name="ido" type="hidden" value="<?php echo $row['id']; ?>">
        <input id="usuario" name="usuario" type="hidden" value="<?php echo $row['usuario']; ?>">
        <input id="pass" name="pass" type="hidden" value="<?php echo $row['pass']; ?>">
        <input id="nombre" name="nombre" type="hidden" value="<?php echo $row['nombre']; ?>">
        <input id="correo" name="correo" type="hidden" value="<?php echo $row['correo']; ?>">
        <input id="last" name="last" type="hidden" value="<?php echo $row['last_session']; ?>">
        <input id="activacion" name="activacion" type="hidden" value="<?php echo $row['activacion']; ?>">
        <input id="id_tipo" name="id_tipo" type="hidden" value="<?php echo $row['id_tipo']; ?>">
        
         
           
        <tr>
            <th align="right">
                <h6> Nombre:</h6>
            </th>
            <td align="center">
                <font color='#007336'> <?php echo $row['nombre']; ?></font>
            </td>
            <th></th>
            <th></th>
           
            <th align="right">
                <h6> Matricula:</h6>
            </th>
            <td align="center">
                <font color='#007336'> <?php echo $row['usuario']; ?></font>
            </td>
            <td></td>
            <td></td>
           
            

        </tr>

        <tr>
            <td colspan="8">
                <hr size=1 noshade="noshade" color="#007336">
            </td>
        </tr>

        <tr>
            <th align="right">
                <h6> Email:</h6>
            </th>
            <td align="center">
                <font color='#007336'> <?php echo $row['correo']; ?></font>
            </td>
            <th></th>
            <th></th>
            
            <th align="right">
                <h6> Ultimo inicio de sesión:</h6>
            </th>
            <td align="center">
                <font color='#007336'> <?php 
                
                echo str_replace('-', '/', date('d-m-Y H:i', strtotime($row['last_session'])).' Hrs'); 
 
                
                ?></font>
            </td>
            <td></td>
            <td></td>
            
        </tr>

        <tr>
            <td colspan="8">
                <hr size=1 noshade="noshade" color="#007336">
            </td>
        </tr>

        <tr>
            <th align="right">
                <h6> Actividad:</h6>
            </th>
            <td align="center">
                <font color='#007336'> <?php echo $row['activacion']; ?></font>
            </td>
            <th></th>
            <th></th>
          
            <th align="right">
                <h6> Tipo:</h6>
            </th>
            <td align="center">
                <font color='#007336'> <?php echo $row['id_tipo']; ?></font>
            </td>
            <td></td>
            <td></td>
        
        </tr>

     

        <tr>
            <td colspan="8">
                <hr size=1 noshade="noshade" color="#007336"> 
            </td>
        </tr>
        <tr>
        <th align="right">
                <h6> Motivo:</h6>
            </th>
            <td colspan="17">
                <font color='#007336'> 
                    <input type="text" name="motivo" id="motivo" size="50" required>
                </font>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="8">
                <hr size=1 noshade="noshade" color="#007336"> 
            </td>
        </tr>

       

       
            <tr>
                <td colspan="8" align="center">
                    <button type="submit" class="btn btn-info"><i class="icon-hand-right">
                        </i>
                        <br>
                        Eliminar
                        <br>
                        <br>
                    </button>
                </td>
            </tr>
        
        <?php
    }
        ?>
        
    </table>
</center>
</form>

<?php
}

else {?>

    <table align="center">
        <tr></tr>
        
        <br>
        <br>
        
        <tr>
            <td>
            <h4>La Matricula que estas buscando No existe.</h4>
            </td>
        </tr>
        <br>
        <br>
        <br>
        <br>
        <tr>
        <td align="center">    
        <a href="welcome.php"><input type="button" value="Volver"></a>
        </td>
        </tr>
    </table>


<?php
}
?>



<?php
}
	
?>
       
</body>

</html>