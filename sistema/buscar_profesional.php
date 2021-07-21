<?php 
	session_start();
	if($_SESSION['tipo_usuario_id'] != 1)
	{
		header("location: ./");
	}
	
	include "../conexion.php";	

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de profesionales</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<?php 

			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda))
			{
				header("location: lista_profesionales.php");
				mysqli_close($conection);
			}


		 ?>
		
		<h1>Lista de profesionales</h1>
		<a href="registro_profesionales.php" class="btn_new">Crear Profesional</a>
		
		<form action="buscar_profesional.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
                <th>ID Profesional</th>
                <th>Nombre Completo</th>
				<th>Fecha de Nacimiento</th>
				<th>Correo Eléctronico</th>
				<th>Teléfono</th>
				<th>Senority</th>
                <th>Disponible</th>
				<th>Puntuación</th>
				<th>Horas Diarias</th>
				<th>Horas Disponibles</th>
				<th>Nivel de Inglés</th>
                <th>País</th>
                <th>Tipo de Usuario</th>
                <th>Estatus</th>
                <th>Acciones</th>
			</tr>
		<?php 
			//Paginador
            $sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM profesional WHERE ID_Profesional > 0 ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);


			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM profesional
																WHERE ( ID_Profesional LIKE '%$busqueda%' OR 
																		nombre_completo LIKE '%$busqueda%' OR 
																		correo_profesional LIKE '%$busqueda%' OR 
																		telefono_profesional LIKE '%$busqueda%'OR
																		fecha_nacimiento LIKE '%$busqueda%' 
																		
																		
																		 ) 
																AND estatus_id > 1  ");

			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection,"SELECT p.ID_Profesional, p.nombre_completo, p.fecha_nacimiento,p.correo_profesional,p.telefono_profesional,s.nivel_seniority,
                                            p.disponible,p.puntuacion,p.horas_diarias,p.horas_disponibles,n.nivel_ingles,ps.nombre_pais,p.contrasenia,t.tipo_usuario,e.nombre_estatus 
                                             FROM profesional p INNER JOIN tipo_usuario t ON p.tipo_usuario_id = t.ID_TipoUsuario
                                                INNER JOIN seniority s ON p.seniority_id = s.ID_Seniority
                                                INNER JOIN nivel_ingles n ON p.nivel_ingles_id = n.ID_NivelIngles
                                                INNER JOIN pais ps ON p.pais_id = ps.ID_Pais
                                                INNER JOIN estatus e ON p.estatus_id = e.ID_estatus
										WHERE 
										(   p.ID_Profesional 		LIKE '%$busqueda%' OR 
                                            p.nombre_completo 		LIKE '%$busqueda%' OR 
											p.fecha_nacimiento 		LIKE '%$busqueda%' OR 
											p.correo_profesional 	LIKE '%$busqueda%' OR 
											p.telefono_profesional  LIKE  '%$busqueda%'OR
                                            s.nivel_seniority       LIKE  '%$busqueda%'OR
                                            p.disponible       		LIKE  '%$busqueda%' OR
											p.puntuacion       		LIKE  '%$busqueda%'OR
											p.horas_diarias      	LIKE  '%$busqueda%' OR
											p.horas_disponibles     LIKE  '%$busqueda%'OR
											n.nivel_ingles     		LIKE  '%$busqueda%' OR
											ps.nombre_pais 			LIKE  '%$busqueda%'OR
											t.tipo_usuario 			LIKE '%$busqueda%'OR
											e.nombre_estatus		LIKE '%$busqueda%'
											) 
										AND
										estatus_id > 1 ORDER BY p.ID_Profesional ASC LIMIT $desde,$por_pagina 
				");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
				<tr>
                	<td><?php echo $data["ID_Profesional"]; ?></td>
                	<td><?php echo $data["nombre_completo"]; ?></td>
					<td><?php echo $data["fecha_nacimiento"]; ?></td>
					<td><?php echo $data["correo_profesional"]; ?></td>
					<td><?php echo $data["telefono_profesional"]; ?></td>
					<td><?php echo $data["nivel_seniority"]; ?></td>
					<td><?php echo $data["disponible"]; ?></td>
					<td><?php echo $data["puntuacion"]; ?></td>
					<td><?php echo $data['horas_diarias'] ?></td>
                    <td><?php echo $data['horas_disponibles'] ?></td>
                    <td><?php echo $data['nivel_ingles'] ?></td>
                    <td><?php echo $data['nombre_pais'] ?></td>
                    <td><?php echo $data['tipo_usuario'] ?></td>
                    <td><?php echo $data['nombre_estatus'] ?></td>
					<td>
						<a class="link_edit" href="editar_profesional.php?id=<?php echo $data["ID_Profesional"]; ?>">Editar</a>

					<?php if($data["ID_Profesional"] != 1){ ?>
						|
						<a class="link_delete" href="eliminar_confirmar_profesional.php?id=<?php echo $data["ID_Profesional"]; ?>">Eliminar</a>
					<?php } ?>
						
					</td>
				</tr>
			
		<?php 
				}

			}
		 ?>


		</table>
<?php 
	
	if($total_registro != 0)
	{
 ?>
		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>
<?php } ?>


	</section>
</body>
</html>