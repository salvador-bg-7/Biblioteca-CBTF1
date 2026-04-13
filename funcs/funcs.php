<?php
	
	function isNull($nombre, $matricula, $contra1, $contra2, $email){
		if(strlen(trim($nombre)) < 1 || strlen(trim($matricula)) < 1 || strlen(trim($contra1)) < 1 || strlen(trim($contra2)) < 1 || strlen(trim($email)) < 1)
		{
			return true;
			} else {
			return false;
		}		
	}
	
	function isEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
			} else {
			return false;
		}
	}
	
	function validaPassword($contra1, $contra2)
	{
		if (strcmp($contra1, $contra2) !== 0){
			return false;
			} else {
			return true;
		}
	}
	
	function minMax($min, $max, $valor){
		if(strlen(trim($valor)) < $min)
		{
			return true;
		}
		else if(strlen(trim($valor)) > $max)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function usuarioExiste($matricula)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE usuario = ? LIMIT 1");
		$stmt->bind_param("s", $matricula);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;
		}
	}
	
	function folioExiste($folio)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT id FROM libros WHERE folio = ? LIMIT 1");
		$stmt->bind_param("i", $folio);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;
		}
	}

	function emailExiste($email)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE correo = ? LIMIT 1");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;	
		}
	}
	
	function generateToken()
	{
		$gen = md5(uniqid(mt_rand(), false));	
		return $gen;
	}
	
	function hashPassword($contra1) 
	{
		$hash = password_hash($contra1, PASSWORD_DEFAULT);
		return $hash;
	}
	
	function resultBlock($errors){
		if(count($errors) > 0)
		{
			echo "<div id='error' class='alert alert-danger' role='alert'>
			<a href='#' onclick=\"showHide('error');\">[X]</a>
			<ul>";
			foreach($errors as $error)
			{
				echo "<li>".$error."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}
	
	function registraUsuario($matricula, $contra_hass, $nombre, $email, $activo, $token, $tipo_usuario, $esp){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("INSERT INTO usuarios (usuario, pass, nombre, correo, activacion, token, id_tipo, especialidad) 
		VALUES(?,?,?,?,?,?,?,?)");
		$stmt->bind_param('ssssisis', $matricula, $contra_hass, $nombre, $email, $activo, $token, $tipo_usuario, $esp);
		
		
			$stmtPersonal = $mysqli->prepare("INSERT INTO personal (usuariop, nombrep) VALUES (?,?)");
			$stmtPersonal->bind_param('ss', $matricula, $nombre);
		

		if ($stmt->execute(). $stmtPersonal->execute()){
			return $mysqli->insert_id;
			} else {
			return 0;	
		}		
	}

	function registrarLibro($titulo, $sub1, $sub2, $sub3, $sub4, $descripcion, $autor1, $autor2, $autor3, 
	$autor4, $editorial, $cat1, $cat2, $cat3, $cat4, $paginas, $edicion, $folio, $seccion, $celda, $destino, $fechaad){
		
		global $mysqli;
		
		$stmtl = $mysqli->prepare("INSERT INTO libros (titulo, sub1, sub2, sub3, sub4, descripcion, autor1, autor2, 
		autor3, autor4, editorial, cat1, cat2, cat3, cat4, paginas, edicion, folio, ubicacion, celda, img, fechaad) 
		VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

		$stmtl->bind_param('sssssssssssssssiiisiss', $titulo, $sub1, $sub2, $sub3, $sub4, $descripcion, $autor1, 
		$autor2, $autor3, $autor4, $editorial, $cat1, $cat2, $cat3, $cat4, $paginas, $edicion, $folio, $seccion,
		$celda, $destino, $fechaad);
		
		if ($stmtl->execute()){
			return $mysqli->insert_id; 
			} else {
			return 0;	
		}		
	}


	function registroprestar($idi, $tit, $su1, $su2, $su3, $su4, $au1, $au2, $au3, $au4, 
	$ed, $catt1, $catt2, $catt3, $catt4, $pag, $edi, $fo, $ubi, $cel, $rev, $nomsoli, $matsoli){
		
		global $mysqli;
		
		$regborr = $mysqli->prepare("INSERT INTO librosprestar (idoriginal, titulo, sub1, sub2, sub3, sub4, autor1, autor2, 
		autor3, autor4, editorial, cat1, cat2, cat3, cat4, paginas, edicion, folio, ubicacion, celda, revicion, nombresoli, matriculasoli) 
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

		$regborr->bind_param('issssssssssssssiiississ', $idi, $tit, $su1, $su2, $su3, $su4, $au1, $au2, $au3, $au4, 
		$ed, $catt1, $catt2, $catt3, $catt4, $pag, $edi, $fo, $ubi, $cel, $rev, $nomsoli, $matsoli);
		
		if ($regborr->execute()){
			return $mysqli->insert_id;
			} else {
			return 0;	
		}		
	}


	function registronegar($ido, $tit, $su1, $su2, $su3, $su4, $au1, $au2, $au3, $au4, $edit, $cat1, $cat2, $cat3, $cat4, $pag, $edi, $fo,
	$ubi, $cel, $img, $nomso, $matso, $fecha, $motivo){
		
		global $mysqli;
		
		$regneg = $mysqli->prepare("INSERT INTO negados (idoriginal, titulo, sub1, sub2, sub3, sub4, autor1, autor2, 
		autor3, autor4, editorial, cat1, cat2, cat3, cat4, paginas, edicion, folio, ubicacion, celda, img, nombresoli, 
		matriculasoli, fechaPedido, motivo) 
		VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$regneg->bind_param('issssssssssssssiiisisssss', $ido, $tit, $su1, $su2, $su3, $su4, $au1, $au2, $au3, $au4, $edit, $cat1, $cat2, $cat3, $cat4, $pag, $edi, $fo,
        $ubi, $cel, $img, $nomso, $matso, $fecha, $motivo);
		
		if ($regneg->execute()){
			return $mysqli->insert_id;
			} else {
			return 0;	
		}		
	}

	function registroircasa($ido, $tit, $su1, $su2, $su3, $su4, $au1, $au2, $au3, $au4, $edit, $cat1, $cat2, $cat3, $cat4, $pag, $edi, $fo,
	$ubi, $cel, $img, $nomso, $matso, $fecha, $motivo, $devuelto, $fechadev){
		
		global $mysqli;
		
		$regcasa = $mysqli->prepare("INSERT INTO prestados (idoriginal, titulo, sub1, sub2, sub3, sub4, autor1, autor2, 
		autor3, autor4, editorial, cat1, cat2, cat3, cat4, paginas, edicion, folio, ubicacion, celda, img, nombresoli, 
		matriculasoli, fechaPedido, motivo, devuelto, fechadev) 
		VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$regcasa->bind_param('issssssssssssssiiisisssssis', $ido, $tit, $su1, $su2, $su3, $su4, $au1, $au2, $au3, $au4, $edit, $cat1, $cat2, $cat3, $cat4, $pag, $edi, $fo,
        $ubi, $cel, $img, $nomso, $matso, $fecha, $motivo, $devuelto, $fechadev);
		
		if ($regcasa->execute()){
			return $mysqli->insert_id;
			} else {
			return 0;	
		}		
	}

	function registrodev($ido, $tit, $su1, $su2, $su3, $su4, $au1, $au2, $au3, $au4, $edit, $cat1, $cat2, $cat3, $cat4, $pag, $edi, $fo,
	$ubi, $cel, $img, $nomso, $matso, $fecha, $motivo, $devuelto, $fechadev){
		
		global $mysqli;
		
		$regcasa = $mysqli->prepare("INSERT INTO devueltos (idoriginal, titulo, sub1, sub2, sub3, sub4, autor1, autor2, 
		autor3, autor4, editorial, cat1, cat2, cat3, cat4, paginas, edicion, folio, ubicacion, celda, img, nombresoli, 
		matriculasoli, fechaPedido, motivo, devuelto, fechadev) 
		VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$regcasa->bind_param('issssssssssssssiiisisssssis', $ido, $tit, $su1, $su2, $su3, $su4, $au1, $au2, $au3, $au4, $edit, $cat1, $cat2, $cat3, $cat4, $pag, $edi, $fo,
        $ubi, $cel, $img, $nomso, $matso, $fecha, $motivo, $devuelto, $fechadev);
		
		if ($regcasa->execute()){
			return $mysqli->insert_id;
			} else {
			return 0;	
		}		
	}

	function registroborrado
    ($ido, $tit, $su1, $su2, $su3, $su4, $au1, $au2, $au3, $au4, $edt, $ca1, $ca2, $ca3, $ca4, $pag, $edi, $fol,
    $dis, $ubi, $cel, $img, $mot){
		
		global $mysqli;
		
		$regborr = $mysqli->prepare("INSERT INTO librosborrados (ido, titulo, sub1, sub2, sub3, sub4, autor1, autor2, 
		autor3, autor4, editorial, cat1, cat2, cat3, cat4, paginas, edicion, folio, disponibilidad, ubicacion, celda, 
		img, motivo) 
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

		$regborr->bind_param('issssssssssssssiiiisiss', $ido, $tit, $su1, $su2, $su3, $su4, $au1, $au2, $au3, $au4, $edt, 
		$ca1, $ca2, $ca3, $ca4, $pag, $edi, $fol, $dis, $ubi, $cel, $img, $mot);
		
		if ($regborr->execute()){
			return $mysqli->insert_id;
			} else {
			return 0;	
		}		
	}

	function registrouborrado ($ido, $usu, $pas, $nom, $crr, $lst, $act, $idt, $mot)
	{
		global $mysqli;
		
		$reguborr = $mysqli->prepare("INSERT INTO usuariosbo (ido, usuario, pass, nombre, correo, ultima,
		activacion, id_tipo, motivo) 
        VALUES(?,?,?,?,?,?,?,?,?)");

		$reguborr->bind_param('isssssiis', $ido, $usu, $pas, $nom, $crr, $lst, $act, $idt, $mot);
		
		if ($reguborr->execute()){
			return $mysqli->insert_id;
			} else {
			return 0;	
		}		

	}




	function buscar($busx){
		global $mysqli;

		$busqueda = $mysqli->prepare("SELECT * FROM libros WHERE titulo = '$busx'");
		


	}

	
	function enviarEmail($email, $nombre, $asunto, $cuerpo){
		
		require_once 'PHPMailer/PHPMailerAutoload.php';
		
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls'; //Modificar
		$mail->Host = 'smtp.gmail.com'; //Modificar
		$mail->Port = 587; //Modificar
		
		$mail->Username = 'galindo13s.b@gmail.com'; //Modificar
		$mail->Password = 'Ch-123698745Ch'; //Modificar
		
		$mail->setFrom('galindo13s.b@gmail.com', 'Pruebas Biblioteca CBTF1'); //Modificar
		$mail->addAddress($correo, $nombre);
		
		$mail->Subject = $asunto;
		$mail->Body    = $cuerpo;
		$mail->IsHTML(true);
		
		if($mail->send())
		return true;
		else
		return false;
	}
	
	function validaIdToken($id, $token){
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token = ? LIMIT 1");
		$stmt->bind_param("is", $id, $token);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {
			$stmt->bind_result($activacion);
			$stmt->fetch();
			
			if($activacion == 1){
				$msg = "La cuenta ya se activo anteriormente.";
				} else {
				if(activarUsuario($id)){
					$msg = 'Cuenta activada.';
					} else {
					$msg = 'Error al Activar Cuenta';
				}
			}
			} else {
			$msg = 'No existe el registro para activar.';
		}
		return $msg;
	}
	
	function activarUsuario($id)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET activacion=1 WHERE id = ?");
		$stmt->bind_param('s', $id);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}
	
	function isNullLogin($usuario, $contra){
		if(strlen(trim($usuario)) < 1 || strlen(trim($contra)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	
	function login($usuario, $contra)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT id, id_tipo, pass FROM usuarios 
		WHERE usuario = ? || correo = ? LIMIT 1");
		$stmt->bind_param("ss", $usuario, $usuario);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {
			
			if(isActivo($usuario)){
				
				$stmt->bind_result($id, $id_tipo, $pass);
				$stmt->fetch();
				
				$validaPassw = password_verify($contra, $pass);
				
				if($validaPassw){
					
					lastSession($id);
					$_SESSION['id_usuario'] = $id;
					$_SESSION['tipo_usuario'] = $id_tipo;
					
					header("location: welcome.php");
					} else {
					
					$errors = "La contrase&ntilde;a es incorrecta";
				}
				} else {
				$errors = 'El usuario no esta activo';
			}
			} else {
			$errors = "El nombre de usuario o correo electr&oacute;nico no existe";
		}
		return $errors;
	}
	
	function lastSession($id)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET last_session=NOW(), 
		token_password='', password_request=0 WHERE id = ?");
		$stmt->bind_param('s', $id);
		$stmt->execute();
		$stmt->close();
	}
	
	function isActivo($usuario)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1");
		$stmt->bind_param('ss', $usuario, $usuario);
		$stmt->execute();
		$stmt->bind_result($activacion);
		$stmt->fetch();
		
		if ($activacion == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}	
	
	function generaTokenPass($user_id)
	{
		global $mysqli;
		
		$token = generateToken();
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET token_password=?, password_request=1 WHERE id = ?");
		$stmt->bind_param('ss', $token, $user_id);
		$stmt->execute();
		$stmt->close();
		
		return $token;
	}
	
	function getValor($campo, $campoWhere, $valor)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT $campo FROM usuarios WHERE $campoWhere = ? LIMIT 1");
		$stmt->bind_param('s', $valor);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($_campo);
			$stmt->fetch();
			return $_campo;
		}
		else
		{
			return null;	
		}
	}
	
	function getPasswordRequest($id)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT password_request FROM usuarios WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($_id);
		$stmt->fetch();
		
		if ($_id == 1)
		{
			return true;
		}
		else
		{
			return null;	
		}
	}
	
	function verificaTokenPass($user_id, $token){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token_password = ? AND password_request = 1 LIMIT 1");
		$stmt->bind_param('is', $user_id, $token);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($activacion);
			$stmt->fetch();
			if($activacion == 1)
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
		else
		{
			return false;	
		}
	}
	
	function cambiaPassword($contra1, $folioe){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET pass = $contra1
		 WHERE usuario = $folioe ");
		$stmt->bind_param('s', $contra1,);
		
		if($stmt->execute()){
			return true;
			} else {
			return false;		
		}
	}		