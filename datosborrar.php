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

$folioe = $_POST['folioe'];


$consul = "SELECT * 
           FROM libros 
           WHERE folio = '$folioe'";
$buscador = mysqli_query($mysqli, $consul);
$numero = mysqli_num_rows($buscador);





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

<?php
if ($row['id_tipo'] == 1) {
	
?>

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
                <h1>Corrobora los datos del Libro que estas por Eliminar de la BD</h1>
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

<?php 
if ($numero == 1 ) {?>
    
    <form name="eliminar" method="POST" action="borrarlibro.php">
        
            

            <table border="0">
                <tr></tr>
                <tr></tr>
                <tr></tr>
                 <tr>
                    <td colspan="19" align="center">
                    <h4>Estas a punto de eliminar este libro de la base de datos de manera permanente asegúrate de que 
                        la información es la correcta antes de continuar.</h4>
                    </td>
                </tr>
                <tr>
                    <td colspan="19">
                        <hr size=5 noshade="noshade" color="#007336">
                    </td>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($buscador)) {
                    
                    switch ($row['disponibilidad']) {
                        case 0:
                            $row['disponibilidad'] = "Disponible <br>😊";
                            break;
                        
                        case 1:
                            $row['disponibilidad'] = "No disponible <br>😢";
                            break;
                    }
         
                    ?>
                <input id="ido" name="ido" type="hidden" value="<?php echo $row['id']; ?>">
                <input id="titulo" name="titulo" type="hidden" value="<?php echo $row['titulo']; ?>">
                <input id="sub1" name="sub1" type="hidden" value="<?php echo $row['sub1']; ?>">
                <input id="sub2" name="sub2" type="hidden" value="<?php echo $row['sub2']; ?>">
                <input id="sub3" name="sub3" type="hidden" value="<?php echo $row['sub3']; ?>">
                <input id="sub4" name="sub4" type="hidden" value="<?php echo $row['sub4']; ?>">
                <input id="autor1" name="autor1" type="hidden" value="<?php echo $row['autor1']; ?>">
                <input id="autor2" name="autor2" type="hidden" value="<?php echo $row['autor2']; ?>">
                <input id="autor3" name="autor3" type="hidden" value="<?php echo $row['autor3']; ?>">
                <input id="autor4" name="autor4" type="hidden" value="<?php echo $row['autor4']; ?>">
                <input id="editorial" name="editorial" type="hidden" value="<?php echo $row['editorial']; ?>">
                <input id="cat1" name="cat1" type="hidden" value="<?php echo $row['cat1']; ?>">
                <input id="cat2" name="cat2" type="hidden" value="<?php echo $row['cat2']; ?>">
                <input id="cat3" name="cat3" type="hidden" value="<?php echo $row['cat3']; ?>">
                <input id="cat4" name="cat4" type="hidden" value="<?php echo $row['cat4']; ?>">
                <input id="paginas" name="paginas" type="hidden" value="<?php echo $row['paginas']; ?>">
                <input id="edicion" name="edicion" type="hidden" value="<?php echo $row['edicion']; ?>">
                <input id="folio" name="folio" type="hidden" value="<?php echo $row['folio']; ?>">
                <input id="disponibilidad" name="disponibilidad" type="hidden" value="<?php echo $row['disponibilidad']; ?>">
                <input id="ubicacion" name="ubicacion" type="hidden" value="<?php echo $row['ubicacion']; ?>">
                <input id="celda" name="celda" type="hidden" value="<?php echo $row['celda']; ?>">
                <input id="img" name="img" type="hidden" value="<?php echo $row['img']; ?>">
                 
                   
                <tr>
                    <th align="right">
                        <h6> Titulo:</h6>
                    </th>
                    <td align="center">
                        <font color='#007336'> <?php echo $row['titulo']; ?></font>
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
                        <font color='#007336'> <?php echo $row['disponibilidad']; ?></font>
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
                    <td align="center" rowspan="30">
                        <center><img src="<?php echo $row['img']; ?>"></center>
                    </td>

                </tr>

                <tr>
                    <td colspan="18">
                        <hr size=1 noshade="noshade" color="#007336">
                    </td>
                </tr>

                <tr>
                    <th align="right">
                        <h6> Categorias:</h6>
                    </th>
                    <td align="center">
                        <font color='#007336'> <?php echo $row['cat1'], "<br><br>", $row['cat2'], "<br><br>",  
                        $row['cat3'], "<br><br>",  $row['cat4']; ?></font>
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
                        <font color='#007336'> <?php echo $row['paginas']; ?></font>
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
                        <hr size=1 noshade="noshade" color="#007336">
                    </td>
                </tr>

                <tr>
                    <th align="right">
                        <h6> Editorial:</h6>
                    </th>
                    <td align="center">
                        <font color='#007336'> <?php echo $row['editorial']; ?></font>
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
                        <font color='#007336'> <?php echo $row['ubicacion'], " - ", $row['celda']; ?></font>
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
                        <hr size=1 noshade="noshade" color="#007336">
                    </td>
                </tr>

                <tr>
                    <th align="right">
                        <h6> Edicion:</h6>
                    </th>
                    <td align="center">
                        <font color='#007336'> <?php echo $row['edicion'] ?></font>
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
                        <font color='#007336'> <?php echo $row['folio']; ?></font>
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
                        <hr size=1 noshade="noshade" color="#007336"> 
                    </td>
                </tr>
                <tr>
                <th align="right">
                        <h6> Motivo:</h6>
                    </th>
                    <td colspan="17">
                        <font color='#007336'> 
                            <input type="text" name="motivo" id="motivo" size="100" required>
                        </font>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="18">
                        <hr size=1 noshade="noshade" color="#007336"> 
                    </td>
                </tr>

               

               
                    <tr>
                        <td colspan="18" align="center">
                            <button type="submit" class="btn btn-info"><i class="icon-hand-right">
                                </i>
                                <br>
                                Eliminar
                                <br>
                                <br>
                            </button>
                        </td>
                    </tr>
                
                <?php
            }
                ?>
                
            </table>
    </center>
    </form>



<?php
}

else {?>

    <table align="center">
        <tr></tr>
        
        <br>
        <br>
        
        <tr>
            <td>
            <h4>El folio que estas buscando No existe.</h4>
            </td>
        </tr>
        <br>
        <br>
        <br>
        <br>
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