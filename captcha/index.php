<?php




?>

<html>
    <head>
    <title>Prueba captcha</title>
     <script src="https://www.google.com/recaptcha/api.js"></script>
    </head>
    
    <body>
        <form id="form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        Usuario: <input type="text" name="ususario">
        <br><br>
        Contraseña: <input type="password" name="contra">
        <br><br>
            
            
        <div class="g-recaptcha" data-sitekey="6Lcv0FQbAAAAAHZV3zpNKKl-9YIPvm193AAR5RJC"></div>    
        
            
        <br>
        <input type="submit" name="log" value="Login">    
        </form>
    </body>

</html>

