<?php 
	
	session_start();
	if($_SESSION['tipo_usuario_id'] != 1)
	{
		header("location: ./");
	}

	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre_completo']) && empty($_POST['nombre_proyecto'])  
		&& empty($_POST['nombre_rol']) && empty($_POST['horas_asignadas']) && empty($_POST['horas_trabajadas'])
		&& empty($_POST['trabajando']) && empty($_POST['nombre_estatus']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

            $ID_ProfesionalProyecto = $_POST['ID_ProfesionalProyecto'];
            $nombre_completo = $_POST['nombre_completo'];
			$nombre_proyecto = $_POST['nombre_proyecto'];
			$nombre_rol = $_POST['nombre_rol'];
			$horas_asignadas = $_POST['horas_asignadas'];
			$horas_trabajadas = $_POST['horas_trabajadas'];
			$trabajando = $_POST['trabajando'];
			$nombre_estatus  = $_POST['nombre_estatus'];


                $sql_update = mysqli_query($conection,"UPDATE profesional_proyecto
                                                                SET profesional_id = '$nombre_completo', proyecto_id='$nombre_proyecto',rol_laboral_id='$nombre_rol',
                                                                horas_asignadas='$horas_asignadas', horas_trabajadas='$horas_trabajadas',trabajando='$trabajando',estatus_id='$nombre_estatus'
                                                                WHERE profesional_proyecto.ID_ProfesionalProyecto= $ID_ProfesionalProyecto ");

                    if($sql_update){
                        $alert='<p class="msg_save">Asignación actualizada correctamente.</p>';
                    }else{
                        $alert='<p class="msg_error">Error al actualizar la asignación.</p>';
                    }
            }

	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_asignaciones.php');
		mysqli_close($conection);
	}
	$ID_ProfesionalProyecto = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT p.ID_ProfesionalProyecto, pr.nombre_completo, py.nombre_proyecto, 
                                    r.nombre_rol,p.horas_asignadas,p.horas_trabajadas,
                                    p.trabajando,e.nombre_estatus
                                    FROM profesional_proyecto p INNER JOIN profesional pr ON p.profesional_id = pr.ID_Profesional
                                    INNER JOIN proyecto py ON p.proyecto_id = py.ID_Proyecto
                                    INNER JOIN rol_laboral r ON p.rol_laboral_id = r.ID_RolLaboral
                                    INNER JOIN estatus e ON p.estatus_id = e.ID_estatus
                                    WHERE ID_ProfesionalProyecto = $ID_ProfesionalProyecto");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_asignaciones.php');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$ID_ProfesionalProyecto	= $data['ID_ProfesionalProyecto'];
			$nombre_completo	= $data['nombre_completo'];
            $nombre_proyecto 	= $data['nombre_proyecto'];
			$nombre_rol 	= $data['nombre_rol'];
			$horas_asignadas 	= $data['horas_asignadas'];
			$horas_trabajadas	= $data['horas_trabajadas'];
			$trabajando	= $data['trabajando'];
			$nombre_estatus  	= $data['nombre_estatus'];


		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Asignación</title>
	<script src="./assets/js/jquery.min.js"></script>
  	<script src="./assets/js/bootstrap.min.js"></script>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar asignación</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="ID_ProfesionalProyecto" value="<?php echo $ID_ProfesionalProyecto; ?>">
				<label for="nombre_completo">Profesional Encargado</label>

                <?php 
                    include "../conexion.php";
					$query_nombre_completo = mysqli_query($conection,"SELECT * FROM profesional");
					$result_nombre_completo = mysqli_num_rows($query_nombre_completo);

				 ?>

				<select name="nombre_completo" id="nombre_completo">
					<?php 
						if($result_nombre_completo > 0)
						{
							while ($nombre_completo = mysqli_fetch_array($query_nombre_completo)) {
					?>
							<option value="<?php echo $nombre_completo["ID_Profesional"]; ?>"><?php echo $nombre_completo["nombre_completo"] ?></option>
					<?php 
								# code...
							}
							
						}
					 ?>
				</select>

				<label for="nombre_proyecto">Nombre del Proyecto</label>

				<?php 
                    include "../conexion.php";
					$query_nombre_proyecto = mysqli_query($conection,"SELECT * FROM proyecto");
					$result_nombre_proyecto = mysqli_num_rows($query_nombre_proyecto);

				 ?>

				<select name="nombre_proyecto" id="nombre_proyecto">
					<?php 
						if($result_nombre_proyecto > 0)
						{
							while ($nombre_proyecto = mysqli_fetch_array($query_nombre_proyecto)) {
					?>
							<option value="<?php echo $nombre_proyecto["ID_Proyecto"]; ?>"><?php echo $nombre_proyecto["nombre_proyecto"] ?></option>
					<?php 
								# code...
							}
							
						}
					 ?>
				</select>
			
				<label for="nombre_rol">Rol Laboral</label>

				<?php 
                    include "../conexion.php";
					$query_nombre_rol = mysqli_query($conection,"SELECT * FROM rol_laboral");
					$result_nombre_rol = mysqli_num_rows($query_nombre_rol);

				 ?>

				<select name="nombre_rol" id="nombre_rol">
					<?php 
						if($result_nombre_rol > 0)
						{
							while ($nombre_rol = mysqli_fetch_array($query_nombre_rol)) {
					?>
							<option value="<?php echo $nombre_rol["ID_RolLaboral"]; ?>"><?php echo $nombre_rol["nombre_rol"] ?></option>
					<?php 
								# code...
							}
							
						}
					 ?>
				</select>
                <label for="horas_asignadas">Horas Asignadas</label>
				<input type="text" name="horas_asignadas" id="horas_asignadas" placeholder="Horas Asignadas"value="<?php echo $horas_asignadas; ?>">
                <label for="horas_trabajadas">Horas Trabajadas</label>
				<input type="text" name="horas_trabajadas" id="horas_trabajadas" placeholder="Horas Trabajadas"value="<?php echo $horas_trabajadas; ?>">
				<input type="hidden" name="trabajando" id="trabajando" placeholder="Trabajando"value="<?php echo $trabajando; ?>">
                
				<label for="nombre_estatus">Estatus</label>

				<?php 
                    include "../conexion.php";
					$query_estatus = mysqli_query($conection,"SELECT * FROM estatus");
					$result_estatus = mysqli_num_rows($query_estatus);

				 ?>

				<select name="nombre_estatus" id="nombre_estatus">
					<?php 
						if($result_estatus > 0)
						{
							while ($nombre_estatus = mysqli_fetch_array($query_estatus)) {
					?>
							<option value="<?php echo $nombre_estatus["ID_estatus"]; ?>"><?php echo $nombre_estatus["nombre_estatus"] ?></option>
					<?php 
								# code...
							}
							
						}
					 ?>
				</select>
				<input type="submit" value="Actualizar asignación" class="btn_save" id='editarSubmit'>

			</form>


		</div>


	</section>
	<script type="text/javascript" src="./assets/js/main.js"></script>
</body>
</html>