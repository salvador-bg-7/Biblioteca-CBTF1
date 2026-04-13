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
            FROM prestados 
            WHERE devuelto = 1
            ORDER BY fecha';
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
    <h1>Devolver Libro</h1>
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
    if ($numero >= 1) { ?>
        

            <table border="0" align="center">
            <tr></tr>


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
                        <h6> Fecha de Préstamo</h6>
                    </th>
                    <th></th>
                    <th>
                        <h6> Nombre de Solicitante</h6>
                    </th>
                    <th></th>
                    <th>
                        <h6> Matricula de Solicitante</h6>
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
                        <h6> Devolver</h6>
                    </th>



                </tr>
                <tr>
                    <td colspan="22">
                        <hr size=5 noshade="noshade" color="#052E21">
                    </td>
                </tr>
                <?php 
                
                while ($row = $buscador->fetch_assoc()) { ?>
                    <form method="POST" name="devolverya" id="devolverya" action="devolverbi.php">

                    <?php

                    $fecha1 = strtotime($row['fechadev']);

                    $fecha2 = strtotime(date("Y-m-d"));

                    if ($fecha2 > $fecha1) {?>
                        
                    <tr bgcolor="red">
                        <td align="center"><?php echo $row['titulo']; ?></td>
                        <td></td>
                        <td align="center"><?php echo $row['folio']; ?></td>
                        <td></td>
                        <td align="center"><?php echo $row['ubicacion'], " - ", $row['celda']; ?></td>
                        <td></td>
                        <td align="center"><?php 
                        
                        

                        echo str_replace('-', '/', date('d-m-Y', strtotime($row['fecha']))); 
                        
                        ?></td>
                        <td></td>
                        <td align="center"><?php echo $row['nombresoli']; ?></td>
                        <td></td>
                        <td align="center"><?php echo $row['matriculasoli']; ?></td>
                        <td></td>
                        <td align="center"><?php 
                        
                        echo str_replace('-', '/', date('d-m-Y', strtotime($row['fechadev']))); 
                        
                        ?></td>
                        <td></td>
                        <td align="center">
                            <input type="text" size="20" name="nota" placeholder="Nota breve" >
                        </td>
                        <td></td>


                        <td align="center">

                            <input id="ido" name="ido" type="hidden" value="<?php echo $row['idoriginal']; ?>">
                            <input id="nombresoli" name="nombresoli" type="hidden" value="<?php echo $row['nombresoli']; ?>">
                            <input id="matriculasoli" name="matriculasoli" type="hidden" value="<?php echo $row['matriculasoli']; ?>">
                            <input id="fecha" name="fecha" type="hidden" value="<?php echo $row['fecha']; ?>">
                            <input id="fechadev" name="fechadev" type="hidden" value="<?php echo $row['fechadev']; ?>">
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


                            <input type="submit" name="prestar" value="Devolver">




                        </td>
                        </form>
                        <td></td>
                        </tr>
                    <tr>
                        <td colspan="22">
                            <hr size=1 noshade="noshade" color="#052E21">
                        </td>
                    </tr>


                    <?php    
                    }
                    ?>


<?php

$fecha1 = strtotime($row['fechadev']);

$fecha2 = strtotime(date("Y-m-d"));

if ($fecha1 > $fecha2) {?>
    
<tr>
    <td align="center"><?php echo $row['titulo']; ?></td>
    <td></td>
    <td align="center"><?php echo $row['folio']; ?></td>
    <td></td>
    <td align="center"><?php echo $row['ubicacion'], " - ", $row['celda']; ?></td>
    <td></td>
    <td align="center"><?php 
    
    

    echo str_replace('-', '/', date('d-m-Y', strtotime($row['fecha']))); 
    
    ?></td>
    <td></td>
    <td align="center"><?php echo $row['nombresoli']; ?></td>
    <td></td>
    <td align="center"><?php echo $row['matriculasoli']; ?></td>
    <td></td>
    <td align="center"><?php 
    
    echo str_replace('-', '/', date('d-m-Y', strtotime($row['fechadev']))); 
    
    ?></td>
    <td></td>
    <td align="center">
        <input type="text" size="20" name="nota" placeholder="Nota breve" >
    </td>
    <td></td>


    <td align="center">

        <input id="ido" name="ido" type="hidden" value="<?php echo $row['idoriginal']; ?>">
        <input id="nombresoli" name="nombresoli" type="hidden" value="<?php echo $row['nombresoli']; ?>">
        <input id="matriculasoli" name="matriculasoli" type="hidden" value="<?php echo $row['matriculasoli']; ?>">
        <input id="fecha" name="fecha" type="hidden" value="<?php echo $row['fecha']; ?>">
        <input id="fechadev" name="fechadev" type="hidden" value="<?php echo $row['fechadev']; ?>">
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


        <input type="submit" name="prestar" value="Devolver">




    </td>
    </form>
    <td></td>
    </tr>
<tr>
    <td colspan="22">
        <hr size=1 noshade="noshade" color="#052E21">
    </td>
</tr>


<?php    
}
?>





                    
                <?php } ?>
            </table>
        
    <?php
    } 
    
    else { ?>
    
        <table align="center" border="0">
            <tr>
                <td>
                    <h4>En estos momentos no se encuentra ningún libro en préstamo.</h4>
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