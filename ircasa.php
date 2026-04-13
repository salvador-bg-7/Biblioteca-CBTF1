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

$consul =   'SELECT * 
            FROM librosprestar 
            WHERE revicion = 1
            ORDER BY fecha';           
$buscador = mysqli_query($mysqli, $consul);

$ido = $mysqli->real_escape_string($_POST['ido']);
$nombresoli = $mysqli->real_escape_string($_POST['nombresoli']);
$matriculasoli = $mysqli->real_escape_string($_POST['matriculasoli']);
$fecha = $mysqli->real_escape_string($_POST['fecha']);

$consOrg = "SELECT *
            FROM libros
            WHERE id = $ido";
$busOrg = mysqli_query($mysqli, $consOrg);




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



<div class="contenedorcabeza">

<div4>
    <a href="welcome.php"><img src="img/cabezas.png"></a>
</div4>

<div2>
    <h1>Préstamo de Libro Aprobado</h1>
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


<form method="POST" name="negar" id="negar" action="registrarircasa.php">
<table border="0" align="center">
        <tr align="center">
            <th>
                <h6> Título</h6>
            </th>
            <th></th>
            <th>
                <h6> Folio</h6>
            </th>
            <th></th>
            <th>
                <h6> Ubicación</h6>
            </th>
            <th></th>
            <th>
                <h6> Solicitante</h6>
            </th>
            <th></th>
            <th>
                <h6> Fecha de Devolución</h6>
            </th>
            <th></th>
            <th>
                <h6> Nota</h6>
            </th>
            <th></th>
            <th>
                <h6> Prestar</h6>
            </th>
            
        </tr>
        <tr>
            <td colspan="20">
                <hr size=5 noshade="noshade" color="#052E21">
            </td>
        </tr>

        
        <?php while ($row = $busOrg->fetch_assoc()) {?> 
        <tr>
            <td align="center"><?php echo $row['titulo']; ?></td>
            <td></td>
            <td align="center"><?php echo $row['folio']; ?></td>
            <td></td>
            <td align="center"><?php echo $row['ubicacion'], " - ", $row['celda']; ?></td>
            <td></td>
            <td align="center"><?php echo $nombresoli, "<br><br>", $matriculasoli; ?></td>
            <td></td>
            <td align="center">


                <input type="date" name="fechadev" id="fechadev">

                
            </td>
            <td></td>
            <td align="center">
                <input type="text" size="40" name="motivo" placeholder="Nota breve" autocomplete="off">
            </td>
            <td></td>
            <td>
                <input type="submit" name="prestar" value="Prestar">
            </td>

            <input id="tit" name="tit" type="hidden" value="<?php echo $row['titulo']; ?>">
            <input id="su1" name="su1" type="hidden" value="<?php echo $row['sub1']; ?>">
            <input id="su2" name="su2" type="hidden" value="<?php echo $row['sub2']; ?>">
            <input id="su3" name="su3" type="hidden" value="<?php echo $row['sub3']; ?>">
            <input id="su4" name="su4" type="hidden" value="<?php echo $row['sub4']; ?>">
            <input id="au1" name="au1" type="hidden" value="<?php echo $row['autor1']; ?>">
            <input id="au2" name="au2" type="hidden" value="<?php echo $row['autor2']; ?>">
            <input id="au3" name="au3" type="hidden" value="<?php echo $row['autor3']; ?>">
            <input id="au4" name="au4" type="hidden" value="<?php echo $row['autor4']; ?>">
            <input id="edit" name="edit" type="hidden" value="<?php echo $row['editorial']; ?>">
            <input id="cat1" name="cat1" type="hidden" value="<?php echo $row['cat1']; ?>">
            <input id="cat2" name="cat2" type="hidden" value="<?php echo $row['cat2']; ?>">
            <input id="cat3" name="cat3" type="hidden" value="<?php echo $row['cat3']; ?>">
            <input id="cat4" name="cat4" type="hidden" value="<?php echo $row['cat4']; ?>">
            <input id="pag" name="pag" type="hidden" value="<?php echo $row['paginas']; ?>">
            <input id="edi" name="edi" type="hidden" value="<?php echo $row['edicion']; ?>">
            <input id="fo" name="fo" type="hidden" value="<?php echo $row['folio']; ?>">
            <input id="ubi" name="ubi" type="hidden" value="<?php echo $row['ubicacion']; ?>">
            <input id="cel" name="cel" type="hidden" value="<?php echo $row['celda']; ?>">
            <input id="img" name="img" type="hidden" value="<?php echo $row['img']; ?>">
            <input id="ido" name="ido" type="hidden" value="<?php echo $ido; ?>">
            <input id="nomso" name="nomso" type="hidden" value="<?php echo $nombresoli; ?>">
            <input id="matso" name="matso" type="hidden" value="<?php echo $matriculasoli; ?>">
            <input id="fecha" name="fecha" type="hidden" value="<?php echo $fecha; ?>">

            
        </tr>
        <?php } ?>
        
    </table>
    </form>


    <?php
}
	
?>
</body>

</html>