<?php
session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';

$errors = array();

if (!empty($_POST)) {
    $usuario = $mysqli->real_escape_string($_POST['usuario']);
    $contra = $mysqli->real_escape_string($_POST['contra']);

    if (isNullLogin($usuario, $contra)) {
        $errors[] = "Debes de llenar todos los datos";
    }
    $errors[] = login($usuario, $contra);
}

?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión</title>


    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <script src="js/bootstrap.min.js"></script>

</head>

<body style="background-color:  #F2F2F2;">


    <div class="container">
        <div id="sesion" style="margin-top:0px;">
            <div class="panel panel-info">
                <br>
                <br>
                <br>


                <div>
                    <center><img src="img/logo.png"></center>
                </div>

                <center>
                    <div>
                        <table border="0">

                            <div style="padding-top:40px" class="panel-body">

                                <tr>
                                    <form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

                                        <td colspan="100" align="center">
                                            <div style="margin-bottom: 10px" class="input-group">

                                                <input id="usuario" type="text" class="form-control" name="usuario" value="" placeholder="Matricula" required>
                                            </div>
                                        </td>
                                </tr>

                                <tr>
                                    <td colspan="100" align="center">
                                        <div style="margin-bottom: 10px" class="input-group">

                                            <input id="password" type="password" class="form-control" name="contra" placeholder="Contraseña" required>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="100" align="center">
                                        <div style="margin-top:10px" class="form-group">
                                            <div class="col-sm-12 controls">
                                                <button id="btn-login" type="submit" class="btn btn-success">Iniciar Sesi&oacute;n</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="40" align="center">
                                        <div class="form-group" style="margin-top:30px">

                                            <div style="float:center; font-size: 80%; position: relative; top:10px">
                                                Eres Nuevo! <a href="selecregistro.php">Registrate aquí</a>
                                            </div>

                                        </div>
                                    </td>


                                </tr>
                            </div>
                            </form>
                            <?php echo resultBlock($errors); ?>
                    </div>
                    </table>
                </center>
            </div>
        </div>
    </div>
</body>

</html>