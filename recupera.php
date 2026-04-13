<?php


	
?>
<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Recuperar Contraseña CBTF 1</title>
		
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
		
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


        
         <div>
            <center><img src="img/logo.png"></center>
         </div>
		
		<div class="container">    
			<div id="loginbox" style="margin-top:20px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
                
                <center>    
                <table border="0">
                    <tr>   
					<div class="panel-heading">
                    <td colspan="100" align="center">     
						<div class="panel-title">Recuperar Contraseña
                        </div>
                    </td> 
                 
                      
                    
						<div style="float:right; font-size: 80%; position: relative; left:-200px; top:-1px"><a href="index.php">Iniciar Sesi&oacute;n</a>
                        </div>
                        
					</div>     
					
                    </tr>    
                        
					<div style="padding-top:30px" class="panel-body" >
						
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12">
                        </div>
						
						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
                        <tr> 
                            <td colspan="100" align="center">
							<div style="margin-top: 20px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="email" type="email" class="form-control" name="emailr" placeholder="Tu Email" required>                                        
							</div>
							</td>
                        </tr>  
                            
                        <tr>  
                            <td colspan="100" align="center">
							<div style="margin-top:30px" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-success">Enviar</a>
								</div>
							</div>
							</td>
                        </tr>
                        
                        <tr> 
                            <td colspan="100" align="center">
							<div class="form-group">
								<div style="margin-top:40px" class="col-md-12 control">
									
										No tiene una cuenta! <a href="registro.php">Registrate aquí</a>
									
								</div>
							</div> 
                            </td>    
                        </tr>     
						</form>
					</div> 
                </table> 
                </center>    
				</div>  
			</div>
		</div>
	</body>
</html>							