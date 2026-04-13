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


$consulnot =   "SELECT * 
            FROM librosprestar 
            WHERE revicion = 1";           
$buscadornot = mysqli_query($mysqli, $consulnot);
$numeronot = mysqli_num_rows($buscadornot);


?>

<html lang="es">
<link rel="stylesheet" href="css/main.css" rel=stylesheet />




<head>
	<meta http-equiv="refresh" content="20">
	<title>Biblioteca</title>
</head>
</div>

<body style="background-color:  #F2F2F2;">
<!-- destruccion  -->
<script>
window.onload = function(){killerSession();}
function killerSession(){
setTimeout("window.open('logout.php','_top');",600000);
}
</script>
<!-- destruccion  -->


	<div class="contenedorcabeza">

		<div4>
		<a href="welcome.php"><img src="img/cabezas.png"></a>
		</div4>

		<div2>
		<h1>BIBLIOTECA</h1>
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
if ($row['id_tipo'] == 1) {
	
?>

<?php

if ($numeronot >= 1) {?>
	<script src="push/bin/push.min.js">
    </script>

    <script>
        Push.create("Solicitud Entrante.", {
			body:"Se a solicitado el préstamo de un Libro.",
			icon: "img/iconpre.png",
			
			onClick: function(){
				window.location="prestar.php";
				thiis.close();
			}
		});
			
    </script>

	



<?php
}
?>




	<center>
		<div id="cssmenu">
			<ul>
				<li>
					<div style="line-height: 15px">
						<a href="buscar.php">
							<img src="img/iconbus2.png">
							<h3>Buscar</h3>
						</a>
					</div>

				</li>
				<li>
					<div style="line-height: 15px">
						<a href="categorias.php">
							<img src="img/iconcat.png">
							<h3>Categorías</h3>
						</a>
					</div>
				</li>
				<li>
					<div style="line-height: 15px">
						<a href="historial.php">
							<img src="img/iconhis.png">
							<h3>Historial</h3>
						</a>
					</div>
				</li>
				<li>
					<div style="line-height: 15px">
						<a href="ajustes.php">
							<img src="img/iconaju.png">
							<h3>Ajustes</h3>
						</a>
					</div>
				</li>
				<li>
					<div style="line-height: 15px">
						<a href="registrarlibro.php">
							<img src="img/iconreg.png">
							<h3>Registrar</h3>
						</a>
					</div>
				</li>
				<li>
					<div style="line-height: 15px">
						<a href="editarlibro.php">
							<img src="img/iconedi.png">
							<h3>Editar</h3>
						</a>
					</div>
				</li>
				<li>
					<div style="line-height: 15px">
						<a href="prestar.php">
							<img src="img/iconpre.png">
							<h3>Prestar</h3>
						</a>
					</div>
				</li>
				<li>
					<div style="line-height: 15px">
						<a href="devolver.php">
							<img src="img/icondev.png">
							<h3>Devolver</h3>
						</a>
					</div>
				</li>
				
			</ul>
		</div>
	</center>

<?php
}

else{?>

<!-- destruccion  -->
<script>
window.onload = function(){killerSession();}
function killerSession(){
setTimeout("window.open('logout.php','_top');",600000);
}
</script>
<!-- destruccion  -->
	
	<center>
	<div id="cssmenu">
		<ul>
			<li>
				<div style="line-height: 15px">
					<a href="buscar.php">
						<img src="img/iconbus2.png">
						<h3>Buscar</h3>
					</a>
				</div>

			</li>
			<li>
				<div style="line-height: 15px">
					<a href="categorias.php">
						<img src="img/iconcat.png">
						<h3>Categorías</h3>
					</a>
				</div>
			</li>
			
			
		</ul>
	</div>
</center>




<?php
}
?>

</body>

</html>