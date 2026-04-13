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

$valor = '1';
$idi = $mysqli->real_escape_string($_POST['idi']);

$tit = $mysqli->real_escape_string($_POST['tit']);
$su1 = $mysqli->real_escape_string($_POST['su1']);
$su2 = $mysqli->real_escape_string($_POST['su2']);
$su3 = $mysqli->real_escape_string($_POST['su3']);
$su4 = $mysqli->real_escape_string($_POST['su4']);
$dis = $mysqli->real_escape_string($_POST['dis']);
$catt1 = $mysqli->real_escape_string($_POST['catt1']);
$catt2 = $mysqli->real_escape_string($_POST['catt2']);
$catt3 = $mysqli->real_escape_string($_POST['catt3']);
$catt4 = $mysqli->real_escape_string($_POST['catt4']);
$au1 = $mysqli->real_escape_string($_POST['au1']);
$au2 = $mysqli->real_escape_string($_POST['au2']);
$au3 = $mysqli->real_escape_string($_POST['au3']);
$au4 = $mysqli->real_escape_string($_POST['au4']);
$pag = $mysqli->real_escape_string($_POST['pag']);
$ed = $mysqli->real_escape_string($_POST['ed']);
$ubi = $mysqli->real_escape_string($_POST['ubi']);
$cel = $mysqli->real_escape_string($_POST['cel']);
$edi = $mysqli->real_escape_string($_POST['edi']);
$fo = $mysqli->real_escape_string($_POST['fo']);
$rev = 1;
$nomsoli = $row['nombre'];
$matsoli = $row['usuario'];


$prestar = "UPDATE libros 
            SET disponibilidad = '$valor' 
            WHERE id LIKE '$idi'";
$prestarya = mysqli_query($mysqli, $prestar);


if ($prestarya) { 

    $regprestar = registroprestar($idi, $tit, $su1, $su2, $su3, $su4, $au1, $au2, $au3, $au4, 
	$ed, $catt1, $catt2, $catt3, $catt4, $pag, $edi, $fo, $ubi, $cel, $rev, $nomsoli, $matsoli);
    if ($regprestar > 0) {?>

    <script languaje='javascript' ;>
        alert('El Libro se te entregara en recepción, ahora ya  puedes pasar por él.😉');
        location.href = 'welcome.php';
    </script>";

    
<?php
    }
} else { ?>

    <script>
        alert('Ocurrio un error, por favor notifica en recepcion.😢');
        location.href = 'welcome.php';
    </script>

<?php
}
?>