<?php 
	
$alert = '';
session_start();
if(!empty($_SESSION['active']))
{
	header('location: sistema/');
}else{

	if(!empty($_POST))
	{
		if(empty($_POST['correo_profesional']) || empty($_POST['contrasenia']))
		{
			$alert = 'Ingrese su correo eléctronico y su contraseña';
		}else{

			require_once "conexion.php";

			$correo_profesional = mysqli_real_escape_string($conection,$_POST['correo_profesional']);
			$pass= $_POST['contrasenia'];

			$query = mysqli_query($conection,"SELECT * FROM profesional WHERE correo_profesional = '$correo_profesional' AND contrasenia = '$pass'");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0)
			{
				$data = mysqli_fetch_array($query);
				$_SESSION['active'] = true;
				$_SESSION['idprofesional'] = $data['ID_Profesional'];
				$_SESSION['nombre_completo'] = $data['nombre_completo'];
				$_SESSION['fecha_nacimiento'] = $data['fecha_nacimiento'];
				$_SESSION['correo_profesional']  = $data['correo_profesional'];
				$_SESSION['telefono_profesional']   = $data['telefono_profesional'];
				$_SESSION['seniority_id']    = $data['seniority_id'];
                $_SESSION['disponible'] = $data['disponible'];
				$_SESSION['puntuacion'] = $data['puntuacion'];
				$_SESSION['horas_diarias'] = $data['horas_diarias'];
				$_SESSION['horas_disponibles']  = $data['horas_disponibles'];
				$_SESSION['nivel_ingles_id']   = $data['nivel_ingles_id'];
				$_SESSION['pais_id']    = $data['pais_id'];
                $_SESSION['contrasenia']  = $data['contrasenia'];
				$_SESSION['tipo_usuario_id']   = $data['tipo_usuario_id'];
				$_SESSION['estatus_id']    = $data['estatus_id'];

				header('location: sistema/');
			}else{
				$alert = 'El correo eléctronico o la contraseña son incorrectos';
				session_destroy();
			}


		}

	}
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio de Sesión</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="assets/js/jquery.min.js"></script>
  	<script src="assets/js/bootstrap.min.js"></script>
</head>
<body>
	<section id="container">
		
		<form action="" method="post">
			
			<img src="Images/logo.png" alt="Login" style="width: 250px; height: 300px">

			<input type="text" name="correo_profesional" placeholder="Correo Eléctronico">
			<input type="password" name="contrasenia" placeholder="Contraseña">
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<input type="submit" value="INGRESAR">

		</form>

	</section>
<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>