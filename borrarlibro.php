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

$ido = $mysqli->real_escape_string($_POST['ido']);
$tit = $mysqli->real_escape_string($_POST['titulo']);
$su1 = $mysqli->real_escape_string($_POST['sub1']);
$su2 = $mysqli->real_escape_string($_POST['sub2']);
$su3 = $mysqli->real_escape_string($_POST['sub3']);
$su4 = $mysqli->real_escape_string($_POST['sub4']);
$au1 = $mysqli->real_escape_string($_POST['autor1']);
$au2 = $mysqli->real_escape_string($_POST['autor2']);
$au3 = $mysqli->real_escape_string($_POST['autor3']);
$au4 = $mysqli->real_escape_string($_POST['autor4']);
$edt = $mysqli->real_escape_string($_POST['editorial']);
$ca1 = $mysqli->real_escape_string($_POST['cat1']);
$ca2 = $mysqli->real_escape_string($_POST['cat2']);
$ca3 = $mysqli->real_escape_string($_POST['cat3']);
$ca4 = $mysqli->real_escape_string($_POST['cat4']);
$pag = $mysqli->real_escape_string($_POST['paginas']);
$edi = $mysqli->real_escape_string($_POST['edicion']);
$fol = $mysqli->real_escape_string($_POST['folio']);
$dis = $mysqli->real_escape_string($_POST['disponibilidad']);
$ubi = $mysqli->real_escape_string($_POST['ubicacion']);
$cel = $mysqli->real_escape_string($_POST['celda']);
$img = $mysqli->real_escape_string($_POST['img']);
$mot = $mysqli->real_escape_string($_POST['motivo']);

$consul = "DELETE 
           FROM libros 
           WHERE folio = '$fol' AND id = '$ido'";
$borrar = mysqli_query($mysqli, $consul);

if ($borrar) {

    $registroborrado = registroborrado
    ($ido, $tit, $su1, $su2, $su3, $su4, $au1, $au2, $au3, $au4, $edt, $ca1, $ca2, $ca3, $ca4, $pag, $edi, $fol,
    $dis, $ubi, $cel, $img, $mot);

if ($registroborrado) {
            
    ?>

    <script languaje='javascript' ;>
        alert('El libro ha sido Borrado, ahora ya no esta disponoble.');
        location.href = 'welcome.php';
    </script>";

    
<?php
    }}
 else { ?>

    <script>
        alert('Ocurrio un error, por favor notifica a servicio tecnico.😢');
        location.href = 'welcome.php';
    </script>

<?php
}
?>







?>

