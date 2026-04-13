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

$consul =   "SELECT * 
            FROM librosprestar 
            WHERE revicion = 1
            ORDER BY fecha";           
$buscador = mysqli_query($mysqli, $consul);
$numero = mysqli_num_rows($buscador);

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
    <h1>Prestar Libro</h1>
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
    if ($numero >= 1) {?>

    
    
    <table border="0" align="center">
        <tr align="center">
            <th>
                <h6> Título</h6>
            </th>
            <th></th>
            <th></th>
            <th>
                <h6> Autor</h6>
            </th>
            <th></th>
            <th></th>
            <th>
                <h6> Editorial</h6>
            </th>
            <th></th>
            <th></th>
            <th>
                <h6> Edición</h6>
            </th>
            <th></th>
            <th></th>
            <th>
                <h6> Categorías</h6>
            </th>
            <th></th>
            <th></th>
            <th>
                <h6> Páginas</h6>
            </th>
            <th></th>
            <th></th>
            <th>
                <h6> Ubicación</h6>
            </th>
            <th></th>
            <th></th>
            <th>
                <h6> Folio</h6>
            </th>
            <th></th>
            <th></th>
            <th>
                <h6> Solicitante</h6>
            </th>
            <th></th>
            <th></th>
            <th>
                <h6> Prestar</h6>
            </th>
            <th></th>
            <th></th>
            <th>
                <h6> Negar</h6>
            </th>
        
        </tr>
        <tr>
            <td colspan="35">
                <hr size=5 noshade="noshade" color="#052E21">
            </td>
        </tr>
        <?php while ($row = $buscador->fetch_assoc()) {?>     
            <tr>   
                <td align="center"><?php echo $row['titulo']; ?></td>
                <td></td>
                <td></td>
                <td align="center"><?php echo $row['autor1'], "<br><br>", $row['autor2'], "<br><br>", $row['autor3'], "<br><br>", $row['autor4']; ?></td>
                <td></td>
                <td></td>
                <td align="center"><?php echo $row['editorial']; ?></td>
                <td></td>
                <td></td>
                <td align="center"><?php echo $row['edicion']; ?></td>
                <td></td>
                <td></td>
                <td align="center"><?php echo $row['cat1'], "<br><br>", $row['cat2'], "<br><br>", $row['cat3'], "<br><br>", $row['cat4']; ?></td>
                <td></td>
                <td></td>
                <td align="center"><?php echo $row['paginas']; ?></td>
                <td></td>
                <td></td>
                <td align="center"><?php echo $row['ubicacion'], " - ", $row['celda']; ?></td>
                <td></td>
                <td></td>
                <td align="center"><?php echo $row['folio']; ?></td>
                <td></td>
                <td></td>
                <td align="center"><?php echo $row['nombresoli'], "<br><br>", $row['matriculasoli']; ?></td>
                <td></td>
                <td></td>
                
                <td align="center">
                    <form method="POST" name="prestar" id="prestar" action="ircasa.php">
                    <input id="ido" name="ido" type="hidden" value="<?php echo $row['idoriginal']; ?>">
                    <input id="nombresoli" name="nombresoli" type="hidden" value="<?php echo $row['nombresoli']; ?>">
                    <input id="matriculasoli" name="matriculasoli" type="hidden" value="<?php echo $row['matriculasoli']; ?>">
                    <input id="fecha" name="fecha" type="hidden" value="<?php echo $row['fecha']; ?>">

                    <input type="submit" name="prestar" value="Prestar">
                    </form>
                </td>
                <td></td>
                <td></td>

                <td align="center"> 
                    <form method="POST" name="negar" id="negar" action="negar.php">
                    <input id="ido" name="ido" type="hidden" value="<?php echo $row['idoriginal']; ?>">
                    <input id="nombresoli" name="nombresoli" type="hidden" value="<?php echo $row['nombresoli']; ?>">
                    <input id="matriculasoli" name="matriculasoli" type="hidden" value="<?php echo $row['matriculasoli']; ?>">
                    <input id="fecha" name="fecha" type="hidden" value="<?php echo $row['fecha']; ?>">
                    
                    <input type="submit" name="prestar" value="Negar">
                    </form>
                </td>
            </tr>
            <tr>
                <td colspan="35">
                    <hr size=1 noshade="noshade" color="#052E21">
                </td>
            </tr>
            <?php } ?> 
    </table>
    <?php
    }
    
    else {?>
        <table align="center" border="0">
        <tr>
        <td>    
        <h4>En estos momentos no se ha encontrado ninguna solicitud de préstamo.</h4> 
        </td>
        </tr>
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