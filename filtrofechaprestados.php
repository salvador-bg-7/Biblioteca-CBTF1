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







?>

<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro Biblioteca CBTF1</title>

	<link rel="stylesheet" href="css/main.css" rel=stylesheet />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<script src="js/bootstrap.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>




<body style="background-color:  #F2F2F2;">

	<?php
	if ($row2['id_tipo'] == 1) {

	?>

		<!-- destruccion  -->
		<script>
			window.onload = function() {
				killerSession();
			}

			function killerSession() {
				setTimeout("window.open('logout.php','_top');", 600000);
			}
		</script>
		<!-- destruccion  -->



		<div class="contenedorcabeza">

			<div4>
				<a href="welcome.php"><img src="img/cabezas.png"></a>
			</div4>

			<div2>
				<h1>Selecciona las fehas para crear el reporte</h1>
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

        <form method="POST" name="tablaprestar" id="tablaprestar" action="tablaprestadosf.php"  target="_blank">
        <table align="center">
            <br>
            <br>
            <tr>
                <td align="center">
                    <h6>Fecha de inicio:</h6>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td align="center">
                    <h6>Fecha final:</h6>
                </td>
            </tr>
            <tr>
                <td align="center">
                <br>    
                    <input type="date" name="fecha1" id="fecha1">
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td align="center">
                <br>    
                    <input type="date" name="fecha2" id="fecha2">
                </td>
            </tr>
            <tr>
                
                <td align="center" colspan="8">
                <br>    
                <button id="generar" type="submit" class="generar"><i class="generar"></i>Generar Reporte</button>
                </td>
            </tr>
        </table>
        </form>

	
			
	<?php
	}

	?>

</body>


</html>