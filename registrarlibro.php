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


$errors = array();

if (!empty($_POST)) {
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
    $fechaad = $mysqli->real_escape_string($_POST['fechaad']);
    $foto = $mysqli->real_escape_string($_FILES['foto']['name']);
    $ruta = $mysqli->real_escape_string($_FILES['foto']['tmp_name']);
    $destino = "imagenes/" . $foto;
    copy($ruta, $destino);


    if (folioExiste($folio)) {
        $errors[] = "Libro ya registrado con este folio";
    }

    if (count($errors) == 0) {

        $regl = registrarLibro(
            $titulo,
            $sub1,
            $sub2,
            $sub3,
            $sub4,
            $descripcion,
            $autor1,
            $autor2,
            $autor3,
            $autor4,
            $editorial,
            $cat1,
            $cat2,
            $cat3,
            $cat4,
            $paginas,
            $edicion,
            $folio,
            $seccion,
            $celda,
            $destino,
            $fechaad
        );

        if ($regl > 0) {

            echo "<script languaje='javascript';> alert('El libro $titulo has sido registrado exitosamente.'); 
            location.href = 'registrarlibro.php';</script>";
            exit;





            exit;
        } else {
            $errors[] = "Error al Registrar";
        }
    }
}
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>



</head>

<body style="background-color:  #F2F2F2;">

    <?php
    if ($row['id_tipo'] == 1) {

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
                <h1>Registrar Libro</h1>
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
            <table border="0">



                <form id="registrarlibro" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" enctype="multipart/form-data">

                    <div id="signupalert" style="display:none" class="alert alert-danger">
                        <p>Error:</p>
                        <span></span>
                    </div>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td align="right">
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <h6><label for="titulo" class="col-md-3 control-label">Título:</label></h6>
                            </div>
                        </td>
                        <td colspan="4">
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <input type="text" size="147" class="form-control" name="titulo" placeholder="Título del Libro" value="<?php if (isset($titulo)) echo $titulo; ?>" required>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td align="right">
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <h6><label for="subtitulos" class="col-md-3 control-label">Subtítulos:</label></h6>
                            </div>
                        </td>
                        <td>
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <input type="text" size="30" class="form-control" name="sub1" placeholder="Subtítulo del Libro" value="<?php if (isset($sub1)) echo $sub1; ?>" required>
                            </div>
                        </td>
                        <td>
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <input type="text" size="30" class="form-control" name="sub2" placeholder="Subtítulo del Libro" value="<?php if (isset($sub2)) echo $sub2; ?>">
                            </div>
                        </td>
                        <td>
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <input type="text" size="30" class="form-control" name="sub3" placeholder="Subtítulo del Libro" value="<?php if (isset($sub3)) echo $sub3; ?>">
                            </div>
                        </td>
                        <td>
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <input type="text" size="30" class="form-control" name="sub4" placeholder="Subtítulo del Libro" value="<?php if (isset($sub4)) echo $sub4; ?>">
                            </div>
                        </td>
                    </tr>



                    <tr>
                        <td align="right">

                            <div style="margin-bottom: 10px" class="col-md-9">
                                <h6><label for="autor" class="col-md-3 control-label">Autor:</label></h6>
                            </div>
                        </td>
                        <td>
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <input type="text" size="30" class="form-control" name="autor1" placeholder="Autor del Libro" value="<?php if (isset($autor1)) echo $autor1; ?>" required>
                            </div>
                        </td>
                        <td>
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <input type="text" size="30" class="form-control" name="autor2" placeholder="Autor del Libro" value="<?php if (isset($autor2)) echo $autor2; ?>">
                            </div>
                        </td>
                        <td>
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <input type="text" size="30" class="form-control" name="autor3" placeholder="Autor del Libro" value="<?php if (isset($autor3)) echo $autor3; ?>">
                            </div>
                        </td>
                        <td>
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <input type="text" size="30" class="form-control" name="autor4" placeholder="Autor del Libro" value="<?php if (isset($autor4)) echo $autor4; ?>">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="right">

                            <div style="margin-bottom: 10px" class="col-md-9">
                                <h6><label for="text" class="col-md-3 control-label">Editorial:</label></h6>
                            </div>
                        </td>
                        <td colspan="4">
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <input type="text" size="147" class="form-control" name="editorial" placeholder="Editorial del Libro" value="<?php if (isset($editorial)) echo $editorial; ?>" required>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="right">

                            <div style="margin-bottom: 10px" class="col-md-9">
                                <h6><label for="descripcion" class="col-md-3 control-label">Categoría:</label></h6>
                            </div>
                        </td>
                        <td align="center">
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <select name="cat1" value="<?php if (isset($cat1)) echo $cat1; ?>" required>
                                    <option> </option>
                                    <option>Administración</option>
                                    <option>Agropecuaria</option>
                                    <option>Algebra</option>
                                    <option>Artes</option>
                                    <option>Atlas Nacional</option>
                                    <option>Biología</option>
                                    <option>Calculo</option>
                                    <option>Ciencias Sociales</option>
                                    <option>Contabilidad</option>
                                    <option>Derecho</option>
                                    <option>Ecología</option>
                                    <option>Educación</option>
                                    <option>Enciclopedias</option>
                                    <option>Estadística</option>
                                    <option>Ética</option>
                                    <option>Etimología</option>
                                    <option>Filosofía</option>
                                    <option>Física</option>
                                    <option>Forestal</option>
                                    <option>Geografía</option>
                                    <option>Geometría</option>
                                    <option>Guías</option>
                                    <option>Historia</option>
                                    <option>INEGI</option>
                                    <option>Informática</option>
                                    <option>Ingles</option>
                                    <option>Lectura y Redacción</option>
                                    <option>Lógica</option>
                                    <option>Matemáticas</option>
                                    <option>Orientación </option>
                                    <option>Psicología</option>
                                    <option>Química</option>
                                    <option>Recursos Naturales</option>
                                    <option>Revistas</option>
                                    <option>Tecnología</option>

                            </div>
                        </td>
                        <td align="center">
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <select name="cat2" value="<?php if (isset($cat2)) echo $cat2; ?>">
                                    <option> </option>
                                    <option>Administración</option>
                                    <option>Agropecuaria</option>
                                    <option>Algebra</option>
                                    <option>Artes</option>
                                    <option>Atlas Nacional</option>
                                    <option>Biología</option>
                                    <option>Calculo</option>
                                    <option>Ciencias Sociales</option>
                                    <option>Contabilidad</option>
                                    <option>Derecho</option>
                                    <option>Ecología</option>
                                    <option>Educación</option>
                                    <option>Enciclopedias</option>
                                    <option>Estadística</option>
                                    <option>Ética</option>
                                    <option>Etimología</option>
                                    <option>Filosofía</option>
                                    <option>Física</option>
                                    <option>Forestal</option>
                                    <option>Geografía</option>
                                    <option>Geometría</option>
                                    <option>Guías</option>
                                    <option>Historia</option>
                                    <option>INEGI</option>
                                    <option>Informática</option>
                                    <option>Ingles</option>
                                    <option>Lectura y Redacción</option>
                                    <option>Lógica</option>
                                    <option>Matemáticas</option>
                                    <option>Orientación </option>
                                    <option>Psicología</option>
                                    <option>Química</option>
                                    <option>Recursos Naturales</option>
                                    <option>Revistas</option>
                                    <option>Tecnología</option>
                                    < </div>
                        </td>
                        <td align="center">
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <select name="cat3" value="<?php if (isset($cat3)) echo $cat3; ?>">
                                    <option> </option>
                                    <option>Administración</option>
                                    <option>Agropecuaria</option>
                                    <option>Algebra</option>
                                    <option>Artes</option>
                                    <option>Atlas Nacional</option>
                                    <option>Biología</option>
                                    <option>Calculo</option>
                                    <option>Ciencias Sociales</option>
                                    <option>Contabilidad</option>
                                    <option>Derecho</option>
                                    <option>Ecología</option>
                                    <option>Educación</option>
                                    <option>Enciclopedias</option>
                                    <option>Estadística</option>
                                    <option>Ética</option>
                                    <option>Etimología</option>
                                    <option>Filosofía</option>
                                    <option>Física</option>
                                    <option>Forestal</option>
                                    <option>Geografía</option>
                                    <option>Geometría</option>
                                    <option>Guías</option>
                                    <option>Historia</option>
                                    <option>INEGI</option>
                                    <option>Informática</option>
                                    <option>Ingles</option>
                                    <option>Lectura y Redacción</option>
                                    <option>Lógica</option>
                                    <option>Matemáticas</option>
                                    <option>Orientación </option>
                                    <option>Psicología</option>
                                    <option>Química</option>
                                    <option>Recursos Naturales</option>
                                    <option>Revistas</option>
                                    <option>Tecnología</option>

                            </div>
                        </td>
                        <td align="center">
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <select name="cat4" value="<?php if (isset($cat4)) echo $cat4; ?>">
                                    <option> </option>
                                    <option>Administración</option>
                                    <option>Agropecuaria</option>
                                    <option>Algebra</option>
                                    <option>Artes</option>
                                    <option>Atlas Nacional</option>
                                    <option>Biología</option>
                                    <option>Calculo</option>
                                    <option>Ciencias Sociales</option>
                                    <option>Contabilidad</option>
                                    <option>Derecho</option>
                                    <option>Ecología</option>
                                    <option>Educación</option>
                                    <option>Enciclopedias</option>
                                    <option>Estadística</option>
                                    <option>Ética</option>
                                    <option>Etimología</option>
                                    <option>Filosofía</option>
                                    <option>Física</option>
                                    <option>Forestal</option>
                                    <option>Geografía</option>
                                    <option>Geometría</option>
                                    <option>Guías</option>
                                    <option>Historia</option>
                                    <option>INEGI</option>
                                    <option>Informática</option>
                                    <option>Ingles</option>
                                    <option>Lectura y Redacción</option>
                                    <option>Lógica</option>
                                    <option>Matemáticas</option>
                                    <option>Orientación </option>
                                    <option>Psicología</option>
                                    <option>Química</option>
                                    <option>Recursos Naturales</option>
                                    <option>Revistas</option>
                                    <option>Tecnología</option>

                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td align="right">

                            <div style="margin-bottom: 10px" class="col-md-9">
                                <h6><label for="text" class="col-md-3 control-label">N° Páginas:</label></h6>
                            </div>
                        </td>
                        <td>
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <input type="text" size="30" class="form-control" name="paginas" placeholder="Páginas del Libro" value="<?php if (isset($paginas)) echo $paginas; ?>" required>
                            </div>
                        </td>

                        <td rowspan="4" colspan="3" align="center">
                            <div class="form-group">
                                <div style="margin-bottom: 10px" class="col-md-offset-3 col-md-9">
                                    <button id="registrar" type="submit" class="registrar"><i class="registrar"></i>Registrar</button>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="right">

                            <div style="margin-bottom: 10px" class="col-md-9">
                                <h6><label for="text" class="col-md-3 control-label">N° Edición:</label></h6>
                            </div>
                        </td>
                        <td>
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <input type="text" size="30" class="form-control" name="edicion" placeholder="Edición del Libro" value="<?php if (isset($edicion)) echo $edicion; ?>" required>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="right">

                            <div style="margin-bottom: 10px" class="col-md-9">
                                <h6><label for="text" class="col-md-3 control-label">Folio:</label></h6>
                            </div>
                        </td>
                        <td>
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <input type="text" size="30" class="form-control" name="folio" placeholder="Folio del Libro" value="<?php if (isset($folio)) echo $folio; ?>" required>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="right">

                            <div style="margin-bottom: 10px" class="col-md-9">
                                <h6><label for="text" class="col-md-3 control-label">Ubicación:</label></h6>
                            </div>
                        </td>
                        <td>
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <select name="columna" value="<?php if (isset($seccion)) echo $seccion; ?>" required>
                                    <option>Sección</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                    <option>D</option>
                                </select>
                                <select name="celda" value="<?php if (isset($celda)) echo $celda; ?>" required>
                                    <option>Celda</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                    <option>13</option>
                                    <option>14</option>
                                    <option>15</option>
                                    <option>16</option>
                                    <option>17</option>
                                    <option>18</option>
                                    <option>19</option>
                                    <option>20</option>
                                </select>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <h6><label for="text" class="col-md-3 control-label">Fecha de Adquisición:</label></h6>
                            </div>
                        </td>
                        <td colspan="5">
                            <div class="form-group">
                                <div style="margin-bottom: 10px" class="col-md-offset-3 col-md-9">
                                    <input type="date" name="fechaad" id="fechaad">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <div style="margin-bottom: 10px" class="col-md-9">
                                <h6><label for="text" class="col-md-3 control-label">Imágen:</label></h6>
                            </div>
                        </td>
                        <td colspan="5">
                            <div class="form-group">
                                <div style="margin-bottom: 10px" class="col-md-offset-3 col-md-9">
                                    <input type="file" name="foto" id="foto">
                                </div>
                            </div>
                        </td>
                    </tr>

                </form>


            </table>
        </center>
        </div>
        </div>
        </div>
        <?php echo resultBlock($errors); ?>

    <?php
    }

    ?>
</body>

</html>