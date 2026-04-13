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

<html>
<link rel="stylesheet" href="css/main.css" rel=stylesheet />

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<head>
    <title>Biblioteca</title>

    
</head>

<body style="background-color:  #F2F2F2;">


<!-- destruccion  -->
<script>
window.onload = function(){killerSession();}
function killerSession(){
setTimeout("window.open('logout.php','_top');",600000);
}
</script>
<!-- destruccion  -->



    <center>

    <div class="contenedorcabeza">

		<div4>
		<a href="welcome.php"><img src="img/cabezas.png"></a>
		</div4>

		<div2>
		<h1>Solicitud de Préstamo</h1>
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
        $idi = $mysqli->real_escape_string($_POST['idi']);
        $img = $mysqli->real_escape_string($_POST['img']);
       

        $consul2 = "SELECT * 
           FROM prestados 
           WHERE devuelto = 1
           AND titulo = '$tit' 
           AND folio = '$fo'";
$buscador2 = mysqli_query($mysqli, $consul2);





        ?>
        <form name="prestamo" method="POST" action="prestamo.php">
            <input id="idi" name="idi" type="hidden" value="<?php echo $idi; ?>">
            <input id="tit" name="tit" type="hidden" value="<?php echo $tit; ?>">
            <input id="su1" name="su1" type="hidden" value="<?php echo $su1; ?>">
            <input id="su2" name="su2" type="hidden" value="<?php echo $su2; ?>">
            <input id="su3" name="su3" type="hidden" value="<?php echo $su3; ?>">
            <input id="su4" name="su4" type="hidden" value="<?php echo $su4; ?>">
            <input id="dis" name="dis" type="hidden" value="<?php echo $dis; ?>">
            <input id="catt1" name="catt1" type="hidden" value="<?php echo $catt1; ?>">
            <input id="catt2" name="catt2" type="hidden" value="<?php echo $catt2; ?>">
            <input id="catt3" name="catt3" type="hidden" value="<?php echo $catt3; ?>">
            <input id="catt4" name="catt4" type="hidden" value="<?php echo $catt4; ?>">
            <input id="au1" name="au1" type="hidden" value="<?php echo $au1; ?>">
            <input id="au2" name="au2" type="hidden" value="<?php echo $au2; ?>">
            <input id="au3" name="au3" type="hidden" value="<?php echo $au3; ?>">
            <input id="au4" name="au4" type="hidden" value="<?php echo $au4; ?>">
            <input id="pag" name="pag" type="hidden" value="<?php echo $pag; ?>">
            <input id="ed" name="ed" type="hidden" value="<?php echo $ed; ?>">
            <input id="ubi" name="ubi" type="hidden" value="<?php echo $ubi; ?>">
            <input id="cel" name="cel" type="hidden" value="<?php echo $cel; ?>">
            <input id="edi" name="edi" type="hidden" value="<?php echo $edi; ?>">
            <input id="fo" name="fo" type="hidden" value="<?php echo $fo; ?>">


            <table border="0">
                <tr></tr>
                <tr></tr>
                <tr>
                    <td colspan="19">
                        <hr size=5 noshade="noshade" color="#052E21">
                    </td>
                </tr>
                <tr>
                    <th align="right">
                        <h6> Titulo:</h6>
                    </th>
                    <td align="center">
                        <font color='#666666'> <?php echo $tit; ?></font>
                    </td>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th align="right">
                        <h6> Disponibilidad:</h6>
                    </th>
                    <td align="center">
                        <font color='#666666'> <?php echo $dis; ?></font>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="center" rowspan="10">
                        <center><img src="<?php echo $img; ?>"></center>
                    </td>

                </tr>

                <tr>
                    <td colspan="18">
                        <hr size=1 noshade="noshade" color="#052E21">
                    </td>
                </tr>

                <tr>
                    <th align="right">
                        <h6> Subtitulos:</h6>
                    </th>
                    <td align="center">
                        <font color='#666666'> <?php echo $su1, "<br><br>", $su2, "<br><br>",  $su3, "<br><br>",  $su4; ?></font>
                    </td>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th align="right">
                        <h6> Categorias:</h6>
                    </th>
                    <td align="center">
                        <font color='#666666'> <?php echo $catt1, "<br><br>", $catt2, "<br><br>",  $catt3, "<br><br>",  $catt4; ?></font>
                    </td>

                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="18">
                        <hr size=1 noshade="noshade" color="#052E21">
                    </td>
                </tr>

                <tr>
                    <th align="right">
                        <h6> Autor:</h6>
                    </th>
                    <td align="center">
                        <font color='#666666'> <?php echo $au1, "<br><br>", $au2, "<br><br>",  $au3, "<br><br>",  $au4; ?></font>
                    </td>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th align="right">
                        <h6> Paginas:</h6>
                    </th>
                    <td align="center">
                        <font color='#666666'> <?php echo $pag; ?></font>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="18">
                        <hr size=1 noshade="noshade" color="#052E21">
                    </td>
                </tr>

                <tr>
                    <th align="right">
                        <h6> Editorial:</h6>
                    </th>
                    <td align="center">
                        <font color='#666666'> <?php echo $ed; ?></font>
                    </td>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th align="right">
                        <h6> Ubicacion:</h6>
                    </th>
                    <td align="center">
                        <font color='#666666'> <?php echo $ubi, " - ", $cel; ?></font>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="18">
                        <hr size=1 noshade="noshade" color="#052E21">
                    </td>
                </tr>

                <tr>
                    <th align="right">
                        <h6> Edicion:</h6>
                    </th>
                    <td align="center">
                        <font color='#666666'> <?php echo $edi ?></font>
                    </td>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th align="right">
                        <h6> Folio:</h6>
                    </th>
                    <td align="center">
                        <font color='#666666'> <?php echo $fo ?></font>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>


                <tr>
                    <td colspan="18">
                        <hr size=1 noshade="noshade" color="#052E21">
                    </td>
                </tr>

                <?php

                

                if ($dis == "Disponible <br>😊") {?>
                    <tr>
                    <td colspan="18" align="center">
                        <button type="submit"  class="btn btn-info"><i class="icon-hand-right">
                        </i>
                        <br>
                        Solicitar Prestamo
                        <br>
                        <br>
                        </button>
                    </td>
                    </tr>
                <?php
                }
                
                else {?>
                    <tr>
                    <td colspan="19" align="center">   
                    <br>    
                    <?php echo "Este libro se encuentra en préstamo, y estara disponible de nuevo en la fecha de: "?> 
                    <?php 
                    while ($row = $buscador2->fetch_assoc()) {
                    echo 
                    (str_replace('-', '/', date('d-m-Y', strtotime($row['fechadev']))));
                    ?> 
                    <br>     
                    <br>     
                    <a href="buscar.php"><input type="button" value="Volver"></a>
                    <br>  
                    <br>  
                    <br>  
                    <br>  
                    </td>

                    </tr>
                <?php    
                }
            }


                ?>
            </table>
    </center>
    </form>


</body>

</html>