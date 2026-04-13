<?php
session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';

if (!isset($_SESSION["id_usuario"])) {
	header("Location: index.php");
}

$idUsuario = $_SESSION['id_usuario'];
$sql = "SELECT id, usuario, nombre FROM usuarios WHERE id = '$idUsuario'";
$resultado = $mysqli->query($sql);
$row = $resultado->fetch_assoc();


?>

<html>
<link rel="stylesheet" href="css/main.css" rel=stylesheet />

<head>
	<title>Biblioteca</title>
</head>

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
			<h1>Categorías</h1>
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

	<center>
		<div id="menubus" >

			<ul>
				<li>

					<div style="line-height: 15px">
						<a href="cat1.php">
							<img src="img/cat1.png">
							<h6>Administración</h6>
						</a>
					</div>

				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat2.php">
							<img src="img/cat2.png">
							<h6>Agropecuaria</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat3.php">
							<img src="img/cat3.png">
							<h6>Algebra</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat4.php">
							<img src="img/cat4.png">
							<h6>Artes</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat5.php">
							<img src="img/cat5.png">
							<h6>Atlas Nacional</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat6.php">
							<img src="img/cat6.png">
							<h6>Biología</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat7.php">
							<img src="img/cat7.png">
							<h6>Calculo</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat8.php">
							<img src="img/cat8.png">
							<h6>Ciencias Sociales</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat9.php">
							<img src="img/cat9.png">
							<h6>Contabilidad</h6>
						</a>
					</div>

				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat10.php">
							<img src="img/cat10.png">
							<h6>Derecho</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat11.php">
							<img src="img/cat11.png">
							<h6>Ecología</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat12.php">
							<img src="img/cat12.png">
							<h6>Educación</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat13.php">
							<img src="img/cat13.png">
							<h6>Enciclopedias</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat14.php">
							<img src="img/cat14.png">
							<h6>Estadística </h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat15.php">
							<img src="img/cat15.png">
							<h6>Ética</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat16.php">
							<img src="img/cat16.png">
							<h6>Etimología</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat17.php">
							<img src="img/cat17.png">
							<h6>Filosofía</h6>
						</a>
					</div>

				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat18.php">
							<img src="img/cat18.png">
							<h6>Física</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat19.php">
							<img src="img/cat19.png">
							<h6>Forestal</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat20.php">
							<img src="img/cat20.png">
							<h6>Geografía</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat21.php">
							<img src="img/cat21.png">
							<h6>Geometría</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat22.php">
							<img src="img/cat22.png">
							<h6>Guías</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat23.php">
							<img src="img/cat23.png">
							<h6>Historia</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat24.php">
							<img src="img/cat24.png">
							<h6>INEGI</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat25.php">
							<img src="img/cat25.png">
							<h6>Informática</h6>
						</a>
					</div>

				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat26.php">
							<img src="img/cat26.png">
							<h6>Ingles</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat27.php">
							<img src="img/cat27.png">
							<h6>Lectura y Redacción</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat28.php">
							<img src="img/cat28.png">
							<h6>Lógica</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat29.php">
							<img src="img/cat29.png">
							<h6>Matemáticas</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat30.php">
							<img src="img/cat30.png">
							<h6>Orientación </h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat31.php">
							<img src="img/cat31.png">
							<h6>Psicología</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat32.php">
							<img src="img/cat32.png">
							<h6>Química</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat33.php">
							<img src="img/cat33.png">
							<h6>Recursos Naturales</h6>
						</a>
					</div>

				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat34.php">
							<img src="img/cat34.png">
							<h6>Revistas</h6>
						</a>
					</div>
				</li>
				<li>

					<div style="line-height: 15px">
						<a href="cat35.php">
							<img src="img/cat35.png">
							<h6>Tecnología</h6>
						</a>
					</div>
				</li>
			</ul>

		</div>
	</center>
</body>

</html>