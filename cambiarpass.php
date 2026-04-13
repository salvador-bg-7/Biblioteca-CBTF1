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
$row2 = $resultado->fetch_assoc();


    $errors = array();
    
    $contra1 = $mysqli->real_escape_string($_POST['contra']);
    $contra2 = $mysqli->real_escape_string($_POST['contra2']);
    $usu = $mysqli->real_escape_string($_POST['usuario']);
    $id = $mysqli->real_escape_string($_POST['id']);
    

    
    
    if (!validaPassword($contra1, $contra2)) {
        $errors[] = "Las Contraseñas no Coinciden";
    }

    if (count($errors) == 0) {
        $contra_hass = hashPassword($contra1);

        $acpass = "UPDATE usuarios 
        SET pass = '$contra_hass' 
        WHERE usuario = '$usu'";

        $actupresya = mysqli_query($mysqli, $acpass);

        if ($actupresya) { ?>

            <script languaje='javascript' ;>
                alert('La Contraseña ha sido actualizada correctamente.');
                location.href = 'welcome.php';
            </script>";


<?php
            exit;
        } else {
            $errors[] = "Error al Registrar";
        }
    }


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

                <table border="0">
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td colspan="8" align="center">
                            <h4> 
                                <?php
                                    echo resultBlock($errors);
                                ?>
                            </h4>
                        </td>
                    </tr>
                    
        <tr>
            <td align="center">
                <a href="recpass.php"><input type="button" value="Volver"></a>
            </td>
        </tr>
    </table>
    <?php
}
	
?>
</body>
