<?php
session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';
error_reporting(0);

if (!isset($_SESSION["id_usuario"])) {
    header("Location: index.php");
}

$idUsuario = $_SESSION['id_usuario'];
$sql = "SELECT id, usuario, nombre, id_tipo FROM usuarios WHERE id = '$idUsuario'";
$resultado = $mysqli->query($sql);
$row2 = $resultado->fetch_assoc();


$folioe = $_POST['folioe'];


$consul = "SELECT * 
           FROM usuarios 
           WHERE usuario = '$folioe'";
$buscador = mysqli_query($mysqli, $consul);
$numero = mysqli_num_rows($buscador);
?>

<html lang="es">
<link rel="stylesheet" href="css/main.css" rel=stylesheet />

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<head>
    <title>Biblioteca</title>
</head>

<body style="background-color:  #F2F2F2;">

<?php
if ($row2['id_tipo'] == 1) {
	
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
                <h1>Datos del Usuario </h1>
            </div2>

            <div1>
                <h2><?php echo 'Bienvenido: <br>' . utf8_decode($row2['nombre']); ?>
                    <br>
                    <br>
                    <?php echo 'Matricula: <br>' . utf8_decode($row2['usuario']); ?>
                    <br>
                    <br>
                    <a href="logout.php"><img src="img/exit.png"></a>
                </h2>
            </div1>

        </div>

        <?php
        if ($numero == 1) { ?>

            <form id="cambiarcontra" class="form-horizontal" role="form" action="cambiarpass.php" method="POST" autocomplete="off">




                <table border="0">
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td colspan="8" align="center">
                            <h4>Estas a punto de cambiar la contraseña de este Usuario, corrobora que la información es la correcta
                                antes de continuar.</h4>
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
                        <input id="usuario" name="usuario" type="hidden" value="<?php echo $row['usuario']; ?>">
                        <input id="id" name="id" type="hidden" value="<?php echo $row['id']; ?>">



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
                                <font color='#007336'> <?php echo $row['last_session']; ?></font>
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
                                <h6> Nueva Contraseña:</h6>
                            </th>
                            <td align="center">
                                <font color='#007336'>
                                    <input type="password" name="contra" id="contra" size="35" required>
                                </font>
                            </td>
                            <th></th>
                            <th></th>

                            <th align="right">
                                <h6> Repetir contraseña:</h6>
                            </th>
                            <td align="center">
                                <font color='#007336'>
                                    <input type="password" name="contra2" id="contra2" size="35" required>
                                </font>
                            </td>
                            <td></td>
                            <td></td>

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
                                    Cambiar Contraseña
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
        } else { ?>

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

</body>
<?php

        }
?>

</html>