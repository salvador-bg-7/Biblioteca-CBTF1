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
$row2 = $resultado->fetch_assoc();


$tit = $mysqli->real_escape_string($_POST['tit']);
$su1 = $mysqli->real_escape_string($_POST['su1']);
$su2 = $mysqli->real_escape_string($_POST['su2']);
$su3 = $mysqli->real_escape_string($_POST['su3']);
$su4 = $mysqli->real_escape_string($_POST['su4']);
$au1 = $mysqli->real_escape_string($_POST['au1']);
$au2 = $mysqli->real_escape_string($_POST['au2']);
$au3 = $mysqli->real_escape_string($_POST['au3']);
$au4 = $mysqli->real_escape_string($_POST['au4']);
$edit = $mysqli->real_escape_string($_POST['edit']);
$cat1 = $mysqli->real_escape_string($_POST['cat1']);
$cat2 = $mysqli->real_escape_string($_POST['cat2']);
$cat3 = $mysqli->real_escape_string($_POST['cat3']);
$cat4 = $mysqli->real_escape_string($_POST['cat4']);
$pag = $mysqli->real_escape_string($_POST['pag']);
$edi = $mysqli->real_escape_string($_POST['edi']);
$fo = $mysqli->real_escape_string($_POST['fo']);
$ubi = $mysqli->real_escape_string($_POST['ubi']);
$cel = $mysqli->real_escape_string($_POST['cel']);
$img = $mysqli->real_escape_string($_POST['img']);
$ido = $mysqli->real_escape_string($_POST['ido']);
$nomso = $mysqli->real_escape_string($_POST['nombresoli']);
$matso = $mysqli->real_escape_string($_POST['matriculasoli']);
$fecha = $mysqli->real_escape_string($_POST['fecha']);
$motivo = $mysqli->real_escape_string($_POST['nota']);
$fechadev = $mysqli->real_escape_string($_POST['fechadev']);
$valor = 0;
$devuelto = 1;

$actupres = "UPDATE prestados 
        SET devuelto = '$valor' 
        WHERE idoriginal LIKE '$ido'";

$actupresya = mysqli_query($mysqli, $actupres);

if ($actupresya) {
    $registrodev = registrodev
        ($ido, $tit, $su1, $su2, $su3, $su4, $au1, $au2, $au3, $au4, $edit, $cat1, $cat2, $cat3, $cat4, $pag, $edi, $fo,
        $ubi, $cel, $img, $nomso, $matso, $fecha, $motivo, $devuelto, $fechadev);

    if ($registrodev) {
        $actulib = "UPDATE libros 
                    SET disponibilidad = '$valor' 
                    WHERE id LIKE '$ido'";

        $actulibya = mysqli_query($mysqli, $actulib);
 
    }    
    if ($actulibya) {
        
        ?>

        <script languaje='javascript' ;>
            alert('El libro ha sido devuelto con exito, ahora se encuentra disponible de nuevo.😉');
            location.href = 'devolver.php';
        </script>";
    
        
    <?php
        }
    } else { ?>
    
        <script>
            alert('Ocurrio un error, por favor notifica a servicio tecnico.😢');
            location.href = 'devolver.php';
        </script>
    
    <?php
    }
    ?>




