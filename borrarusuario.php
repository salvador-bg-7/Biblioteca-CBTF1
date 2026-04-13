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
$usu = $mysqli->real_escape_string($_POST['usuario']);
$pas = $mysqli->real_escape_string($_POST['pass']);
$nom = $mysqli->real_escape_string($_POST['nombre']);
$crr = $mysqli->real_escape_string($_POST['correo']);
$lst = $mysqli->real_escape_string($_POST['last']);
$act = $mysqli->real_escape_string($_POST['activacion']);
$idt = $mysqli->real_escape_string($_POST['id_tipo']);
$mot = $mysqli->real_escape_string($_POST['motivo']);

if ($idt == "Usuario") {

$consul = "DELETE 
           FROM usuarios 
           WHERE usuario = '$usu' AND id = '$ido'";
$borrar = mysqli_query($mysqli, $consul);


if ($borrar) {

    $registrouborrado = registrouborrado
    ($ido, $usu, $pas, $nom, $crr, $lst, $act, $idt, $mot);

if ($registrouborrado) { ?>

    <script languaje='javascript' ;>
        alert('El Usuario ha sido Borrado, ahora ya no tiene acceso a el sistema.');
        location.href = 'welcome.php';
    </script>";



    
<?php
    }}}
 else { ?>

    <script>
        alert('Ocurrio un error, No puedes Eliminar una cuenta de un Administrador.😢');
        location.href = 'welcome.php';
    </script>

<?php
}
?>







?>

