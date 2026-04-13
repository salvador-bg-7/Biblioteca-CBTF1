<?php

require 'funcs/conexion.php';
require 'funcs/funcs.php';

$errors = array();

if (!empty($_POST)) {
    $nombre = $mysqli->real_escape_string($_POST['nombre']);
    $matricula = $mysqli->real_escape_string($_POST['matricula']);
    $contra1 = $mysqli->real_escape_string($_POST['contra1']);
    $contra2 = $mysqli->real_escape_string($_POST['contra2']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $esp = $mysqli->real_escape_string($_POST['esp']);
    $activo = 1;
    $tipo_usuario = 3;


    if (isNull($nombre, $matricula, $contra1, $contra2, $email)) {
        $errors[] = "Debes llenar todos los campos";
    }
    if (!isEmail($email)) {
        $errors[] = "Email No Valido";
    }
    if (!validaPassword($contra1, $contra2)) {
        $errors[] = "Las Contraseñas no Coinciden";
    }
    if (usuarioExiste($matricula)) {
        $errors[] = "Matricula ya registrada";
    }
    if (emailExiste($email)) {
        $errors[] = "El Email $email ya existe";
    }
    if (count($errors) == 0) {
        $contra_hass = hashPassword($contra1);
        $token = generateToken();
        $reg = registraUsuario($matricula, $contra_hass, $nombre, $email, $activo, $token, $tipo_usuario, $esp);

        if ($reg > 0) {
            echo "<script languaje='javascript';> alert('$nombre has sido registrado exitosamente. ahora ya  puedes iniciar sesión. :)'); 
          location.href = 'index.php';</script>";
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

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body style="background-color:  #F2F2F2;">

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



    <div>
        <center><img src="img/logo.png"></center>
    </div>

    <center>
        <table border="0">
            <tr>

                <div class="panel-heading">
                    <td colspan="10" align="center">
                        <div class="panel-title" style="float:left; font-size: 130%; position: relative; top:20px; margin-bottom: 40px">Reg&iacute;strate
                        </div>
                    </td>


                    <td colspan="10" align="center">
                        <div style="float:right; font-size: 80%; position: relative; top:20px; margin-bottom: 40px"><a id="signinlink" href="index.php">Iniciar Sesi&oacute;n</a>
                        </div>
                    </td>
                </div>

            </tr>
            <div class="cuerporegistro">

                <form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

                    <div id="signupalert" style="display:none" class="alert alert-danger">
                        <p>Error:</p>
                        <span></span>
                    </div>
                    <tr>
                        <div class="form-group">
                            <td colspan="10" align="right">
                                <div style="margin-bottom: 10px" class="col-md-9">
                                    <label for="nombre" class="col-md-3 control-label">Nombre y Apellido:</label>
                                </div>
                            </td>
                            <td colspan="10" align="center">
                                <div style="margin-bottom: 10px" class="col-md-9">
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre y Apellido" value="<?php if (isset($nombre)) echo $nombre; ?>" required>
                                </div>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td colspan="10" align="right">
                                <div style="margin-bottom: 10px" class="col-md-9">
                                    <label for="usuario" class="col-md-3 control-label">CURP:
                                    </label>
                                </div>
                            </td>
                            <td colspan="10" align="center">
                                <div style="margin-bottom: 10px" class="col-md-9">
                                    <input type="text" class="form-control" name="matricula" placeholder="CURP" value="<?php if (isset($matricula)) echo $matricula; ?>" required>
                                </div>
                            </td>
                        </div>
                    </tr>

                    <tr>
                        <div class="form-group">
                            <td colspan="10" align="right">
                                <div style="margin-bottom: 10px" class="col-md-9">
                                    <label for="password" class="col-md-3 control-label">Contraseña:
                                    </label>
                                </div>
                            </td>
                            <td colspan="10" align="center">
                                <div style="margin-bottom: 10px" class="col-md-9">
                                    <input type="password" class="form-control" name="contra1" placeholder="Contraseña" required>
                                </div>
                            </td>
                        </div>
                    </tr>
                    <tr>

                        <div class="form-group">
                            <td colspan="10" align="right">
                                <div style="margin-bottom: 10px" class="col-md-9">
                                    <label for="con_password" class="col-md-3 control-label">Confirmar Contraseña:</label>
                                </div>
                            </td>
                            <td colspan="10" align="center">
                                <div style="margin-bottom: 10px" class="col-md-9">
                                    <input type="password" class="form-control" name="contra2" placeholder="Confirmar Contraseña" required>
                                </div>
                            </td>
                        </div>

                    </tr>
                    <tr>
                        <div class="form-group">
                            <td colspan="10" align="right">

                                <div style="margin-bottom: 10px" class="col-md-9">
                                    <label for="email" class="col-md-3 control-label">Email:
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div style="margin-bottom: 10px" class="col-md-9">
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if (isset($correo)) echo $correo; ?>" required>

                                </div>
                            </td>
                        </div>
                    </tr>
                    
                    <tr>
                        <td colspan="100" align="center">

                            <label for="captcha" class="col-md-3 control-label"></label>


                        </td>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <label for="captcha" class="col-md-3 control-label"></label>

                        </div>
                        <td colspan="100" align="center">
                            <div class="form-group">
                                <div style="margin-bottom: 10px" class="col-md-offset-3 col-md-9">
                                    <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button>
                                </div>
                            </div>
                        </td>
                    </tr>


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