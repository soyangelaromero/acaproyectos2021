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
				header("location: lista_proyectos.php");
				mysqli_close($conection);
			}


		 ?>
		
		<h1>Lista de Proyectos</h1>
		<a href="registro_proyecto.php" class="btn_new">Crear Proyectos</a>
		
		<form action="buscar_proyectos.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
                <th>Nombre del Proyecto</th>
				<th>Descripción</th>
				<th>Nombre del cliente</th>
				<th>Prioridad</th>
				<th>Progreso</th>
                <th>Fecha de Inicio</th>
				<th>Fecha de Fin Estimada</th>
				<th>Fecha Fin Real</th>
				<th>Total Horas Estimadas</th>
				<th>Total Horas Real</th>
                <th>Gasto Estimado</th>
                <th>Gasto Real</th>
                <th>Estatus</th>
                <th>Acciones</th>
			</tr>
		<?php 
			//Paginador
            $sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM proyecto WHERE ID_Proyecto> 0 ");
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


			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM proyecto
																WHERE ( ID_Proyecto LIKE '%$busqueda%' OR 
																		nombre_proyecto LIKE '%$busqueda%' OR 
																		descripcion_breve LIKE '%$busqueda%'  OR
                                                                        fecha_inicio LIKE '%$busqueda%'  
																		
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

			$query = mysqli_query($conection,"SELECT po.ID_Proyecto, po.nombre_proyecto, po.descripcion_breve,c.nombre_empresa,pr.nivel_prioridad,pg.nivel_progreso,
			po.fecha_inicio,po.fecha_fin_estimada,po.fecha_fin_real,po.total_horas_estimadas,po.total_horas_real,po.gasto_estimado,
			po.gasto_real,e.nombre_estatus FROM proyecto po INNER JOIN cliente c ON p.cliente_id = c.ID_Cliente
			INNER JOIN prioridad pr ON p.prioridad_id = pr.ID_Prioridad
			INNER JOIN progreso pg ON p.progreso_id = pg.ID_Progreso
			INNER JOIN estatus e ON p.estatus_id = e.ID_estatus
                                            
										WHERE 
										(   po.ID_Proyecto 		    LIKE '%$busqueda%' OR 
                                            po.nombre_proyecto		LIKE '%$busqueda%' OR 
											po.descripcion_breve		LIKE '%$busqueda%'  
											
											) 
										AND
										estatus_id > 1 ORDER BY po.ID_Proyecto ASC LIMIT $desde,$por_pagina 
				");

			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
				<tr>
                    <td><?php echo $data["ID_Proyecto"]; ?></td>
					<td><?php echo $data["nombre_proyecto"]; ?></td>
					<td><?php echo $data["descripcion_breve"]; ?></td>
					<td><?php echo $data["nombre_empresa"]; ?></td>
					<td><?php echo $data["nivel_prioridad"]; ?></td>
					<td><?php echo $data["nivel_progreso"]; ?></td>
					<td><?php echo $data["fecha_inicio"]; ?></td>
					<td><?php echo $data["fecha_fin_estimada"]; ?></td>
					<td><?php echo $data['fecha_fin_real'] ?></td>
                    <td><?php echo $data['total_horas_estimadas'] ?></td>
                    <td><?php echo $data['total_horas_real'] ?></td>
                    <td><?php echo $data['gasto_estimado'] ?></td>
					<td><?php echo $data['gasto_real'] ?></td>
                    <td><?php echo $data['nombre_estatus'] ?></td>
					<td>
						<a class="link_edit" href="editar_proyecto.php?id=<?php echo $data["ID_Proyecto"]; ?>">Editar</a>

						<a class="link_delete" href="eliminar_confirmar_proyecto.php?id=<?php echo $data["ID_Proyecto"]; ?>">Eliminar</a>
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