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

$titulo = $mysqli->real_escape_string($_POST['titulo']);
$sub1 = $mysqli->real_escape_string($_POST['sub1']);
$sub2 = $mysqli->real_escape_string($_POST['sub2']);
$sub3 = $mysqli->real_escape_string($_POST['sub3']);
$sub4 = $mysqli->real_escape_string($_POST['sub4']);
$descripcion = '';
$autor1 = $mysqli->real_escape_string($_POST['autor1']);
$autor2 = $mysqli->real_escape_string($_POST['autor2']);
$autor3 = $mysqli->real_escape_string($_POST['autor3']);
$autor4 = $mysqli->real_escape_string($_POST['autor4']);
$editorial = $mysqli->real_escape_string($_POST['editorial']);
$cat1 = $mysqli->real_escape_string($_POST['cat1']);
$cat2 = $mysqli->real_escape_string($_POST['cat2']);
$cat3 = $mysqli->real_escape_string($_POST['cat3']);
$cat4 = $mysqli->real_escape_string($_POST['cat4']);
$paginas = $mysqli->real_escape_string($_POST['paginas']);
$edicion = $mysqli->real_escape_string($_POST['edicion']);
$folio = $mysqli->real_escape_string($_POST['folio']);
$seccion = $mysqli->real_escape_string($_POST['columna']);
$celda = $mysqli->real_escape_string($_POST['celda']);
$idlibro = $mysqli->real_escape_string($_POST['id']);
$dispo = $mysqli->real_escape_string($_POST['dis']);
$foto = $mysqli->real_escape_string($_FILES['foto']['name']);
$ruta = $mysqli->real_escape_string($_FILES['foto']['tmp_name']);
$destino = "imagenes/".$foto;
copy($ruta,$destino);




$actualizar = "UPDATE libros SET  img = '$destino' WHERE id LIKE '$idlibro'";

$act = mysqli_query($mysqli, $actualizar);

if ($act) { ?>

    <script>
        alert('El Libro ha sido Actualizado correctamente, ahora ya puedes visualizar los cambios.');
        location.href = 'editarlibro.php';
    </script>

<?php
} else { ?>

    <script>
        alert('El Libro No se puede actualizar intentelo mas tarde.');
        location.href = 'editarlibro.php';
    </script>

<?php
}
?>