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
    <h1>Editar Imagen del Libro</h1>
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

$foled = $mysqli->real_escape_string($_POST['fol']);
$consul = "SELECT * FROM libros WHERE folio LIKE $foled ";
$buscador = mysqli_query($mysqli, $consul);
$numero = mysqli_num_rows($buscador);
 

while ($row = mysqli_fetch_assoc($buscador)) { 

?>

<center>
        <table border="0">



            <form id="editar" action="modificarfoto.php" method="POST" autocomplete="off" enctype="multipart/form-data">
			<input id="id" name="id" type="hidden" value="<?php echo $row['id']; ?>">
			<input id="dis" name="dis" type="hidden" value="<?php echo $row['disponibilidad']; ?>">

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
						<input type="text" size="147" name="titulo" value="<?php echo $row['titulo']; ?>" required readonly>

                        </div>
                    </td>

                </tr>
                <tr>
                    <td align="right">
                        <div style="margin-bottom: 10px" class="col-md-9">
                            <h6><label for="subtitulos" class="col-md-3 control-label">Subtitulos:</label></h6>
                        </div>
                    </td>
                    <td>
                        <div style="margin-bottom: 10px" class="col-md-9">
                            <input readonly type="text" size="30" class="form-control" name="sub1" placeholder="Subtitulo del Libro" value="<?php echo $row['sub1']; ?>" required>
                        </div>
                    </td>
                    <td>
                        <div style="margin-bottom: 10px" class="col-md-9">
                            <input readonly type="text" size="30" class="form-control" name="sub2" placeholder="Subtitulo del Libro" value="<?php echo $row['sub2']; ?>">
                        </div>
                    </td>
                    <td>
                        <div style="margin-bottom: 10px" class="col-md-9">
                            <input readonly type="text" size="30" class="form-control" name="sub3" placeholder="Subtitulo del Libro" value="<?php echo $row['sub3']; ?>">
                        </div>
                    </td>
                    <td>
                        <div style="margin-bottom: 10px" class="col-md-9">
                            <input readonly type="text" size="30" class="form-control" name="sub4" placeholder="Subtitulo del Libro" value="<?php echo $row['sub4']; ?>">
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
                            <input readonly type="text" size="30" class="form-control" name="autor1" placeholder="Autor del Libro" value="<?php echo $row['autor1']; ?>" required>
                        </div>
                    </td>
                    <td>
                        <div style="margin-bottom: 10px" class="col-md-9">
                            <input readonly type="text" size="30" class="form-control" name="autor2" placeholder="Autor del Libro" value="<?php echo $row['autor2']; ?>">
                        </div>
                    </td>
                    <td>
                        <div style="margin-bottom: 10px" class="col-md-9">
                            <input readonly type="text" size="30" class="form-control" name="autor3" placeholder="Autor del Libro" value="<?php echo $row['autor3']; ?>">
                        </div>
                    </td>
                    <td>
                        <div style="margin-bottom: 10px" class="col-md-9">
                            <input readonly type="text" size="30" class="form-control" name="autor4" placeholder="Autor del Libro" value="<?php echo $row['autor4']; ?>">
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
                            <input readonly type="text" size="147" class="form-control" name="editorial" placeholder="Editorial del Libro" value="<?php echo $row['editorial']; ?>" required>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="right">

                        <div style="margin-bottom: 10px" class="col-md-9">
                            <h6><label for="descripcion" class="col-md-3 control-label">Categoría:</label></h6>
                        </div>
                    </td>
                    <td>
                        <div style="margin-bottom: 10px" class="col-md-9">
                            <select  name="cat1" value="<?php echo $row['cat1']; ?>" required>
                                <option> <?php echo $row['cat1']; ?></option>
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
                    <td>
                        <div style="margin-bottom: 10px" class="col-md-9">
                            <select name="cat2" value="<?php echo $row['cat2']; ?>">
                                <option> <?php echo $row['cat2']; ?></option>
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
                    <td>
                        <div style="margin-bottom: 10px" class="col-md-9">
                            <select name="cat3" value="<?php echo $row['cat3']; ?>">
                                <option><?php echo $row['cat3']; ?> </option>
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
                    <td>
                        <div style="margin-bottom: 10px" class="col-md-9">
                            <select name="cat4" value="<?php echo $row['cat4']; ?>">
                                <option> <?php echo $row['cat4']; ?></option>
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
                            <h6><label for="text" class="col-md-3 control-label">N° Paginas:</label></h6>
                        </div>
                    </td>
                    <td>
                        <div style="margin-bottom: 10px" class="col-md-9">
                            <input readonly type="text" size="30" class="form-control" name="paginas" placeholder="Paginas del Libro" value="<?php echo $row['paginas']; ?>" required>
                        </div>
                    </td>

                    <td rowspan="4" colspan="3" align="center">
                        <div class="form-group">
                            <div style="margin-bottom: 10px" class="col-md-offset-3 col-md-9">
                                <button id="registrar" type="submit" class="registrar">Actualizar Libro</button>
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
                            <input readonly type="text" size="30" class="form-control" name="edicion" placeholder="Edición del Libro" value="<?php echo $row['edicion']; ?>" required>
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
                            <input type="text" size="30" class="form-control" name="folio" placeholder="Folio del Libro" value="<?php echo $row['folio']; ?>" readonly>
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
                            <select name="columna" value="<?php echo $row['ubicacion']; ?>" required >
                                <option><?php echo $row['ubicacion']; ?></option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                            </select>
                            <select name="celda" value="<?php echo $row['celda']; ?>" required>
                                <option><?php echo $row['celda']; ?></option>
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
                            <h6><label for="text" class="col-md-3 control-label">Imagen:</label></h6>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <div style="margin-bottom: 10px" class="col-md-offset-3 col-md-9">
                            <input type="file" name="foto" id="foto">
                        </div>
                        </div>
                    </td>
                    </form>
                </tr>

            


        </table>
    </center>



<?php

	
}
?>


<?php
}
	
?>
</body>

</html>