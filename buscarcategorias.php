<?php
//Aqui va el código PHP del Vídeo
?>

<html>
<link rel="stylesheet" href="css/main.css" rel=stylesheet />

<head>
    <title>Biblioteca</title>
    <div>
        <center><img src="img/cabeza.png"></center>
        <a href="logout.php" class="botoncr">Cerrar Sesión<br /></a>
    </div>
</head>

<body>
    <!-- destruccion  -->
<script>
window.onload = function(){killerSession();}
function killerSession(){
setTimeout("window.open('logout.php','_top');",600000);
}
</script>
<!-- destruccion  -->
    <center>
        <table align="left" border="1">
            <tr>
                <td colspan="1" align="left">
                    <div style="margin-bottom: 10px" class="input-group">

                        <input id="buscarcategoria" type="text" class="form-control" name="buscarcategoria" value="" placeholder="Categoria del Libro" required>
                    </div>
                </td>
                <td>
                    <div style="margin-bottom: 10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <button id="btn-login" type="submit" class="btn btn-success">Buscar</a>
                        </div>
                    </div>
                </td>
            </tr>
            </tabe>

            <table2 align="center" border="1">
                <tr>
                    <th>
                        <font color='#2C8DDC'> N°</font>
                    </th>
                    <th>
                        <font color='#2C8DDC'> Categoria</font>
                    </th>
                    <th>
                        <font color='#2C8DDC'> Titulo</font>
                    </th>
                    <th>
                        <font color='#2C8DDC'> Subtitulos</font>
                    </th>
                    <th>
                        <font color='#2C8DDC'> Autor</font>
                    </th>
                    <th>
                        <font color='#2C8DDC'> Editorial</font>
                    </th>
                    <th>
                        <font color='#2C8DDC'> Edición</font>
                    </th>
                    <th>
                        <font color='#2C8DDC'> Disponibilidad</font>
                    </th>
                    <th>
                        <font color='#2C8DDC'> Paginas</font>
                    </th>
                    <th>
                        <font color='#2C8DDC'> Folio</font>
                    </th>
                    <th>
                        <font color='#2C8DDC'> Observación</font>
                    </th>
                </tr>
            </table2>
    </center>
</body>

</html>