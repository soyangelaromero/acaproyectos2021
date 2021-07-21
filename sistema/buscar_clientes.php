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
	<title>Lista de Clientes</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<?php 

			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda))
			{
				header("location: lista_clientes.php");
				mysqli_close($conection);
			}


		 ?>
		
		<h1>Lista de profesionales</h1>
		<a href="registro_cliente.php" class="btn_new">Crear Cliente</a>
		
		<form action="buscar_clientes.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
                <th>Nombre de la Empresa</th>
				<th>Sector del Mercado</th>
				<th>País</th>
				<th>Nombre del Representante</th>
				<th>Teléfono</th>
                <th>Correo Eléctronico</th>
				<th>Cantidad de Proyectos</th>
				<th>Estatus</th>
                <th>Acciones</th>
			</tr>
		<?php 
			//Paginador
            $sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM cliente WHERE ID_Cliente > 0 ");
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


			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM cliente
																WHERE ( ID_Cliente LIKE '%$busqueda%' OR 
																		nombre_empresa LIKE '%$busqueda%' OR 
																		sector_mercado LIKE '%$busqueda%' OR
																		nombre_representante LIKE '%$busqueda%'
																		
																		
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

			$query = mysqli_query($conection,"SELECT c.ID_Cliente, c.nombre_empresa, c.sector_mercado,p.nombre_pais,c.nombre_representante,c.telefono,
												c.correo_contacto,c.cantidad_proyectos,e.nombre_estatus
												FROM cliente c INNER JOIN pais p ON c.pais_id = p.ID_Pais
												INNER JOIN estatus e ON c.estatus_id = e.ID_estatus
										WHERE 
										(   c.ID_Cliente 		LIKE '%$busqueda%' OR 
											c.nombre_empresa 		LIKE '%$busqueda%' OR 
											c.sector_mercado 		LIKE '%$busqueda%' OR 
											p.nombre_pais 	LIKE '%$busqueda%' OR 
											c.nombre_representante  LIKE  '%$busqueda%'OR
                                            c.telefono      LIKE  '%$busqueda%'OR
                                            c.correo_contacto       		LIKE  '%$busqueda%' OR
											c.cantidad_proyectos      		LIKE  '%$busqueda%'OR
											e.nombre_estatus     	LIKE  '%$busqueda%' 
											
											) 
											AND
										estatus_id > 1 ORDER BY c.ID_Cliente ASC LIMIT $desde,$por_pagina 
				");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
					<tr>
					<td><?php echo $data["nombre_empresa"]; ?></td>
					<td><?php echo $data["sector_mercado"]; ?></td>
					<td><?php echo $data["nombre_pais"]; ?></td>
					<td><?php echo $data["nombre_representante"]; ?></td>
					<td><?php echo $data["telefono"]; ?></td>
					<td><?php echo $data["correo_contacto"]; ?></td>
					<td><?php echo $data["cantidad_proyectos"]; ?></td>
					<td><?php echo $data['nombre_estatus'] ?></td>
					<td>
						<a class="link_edit" href="editar_cliente.php?id=<?php echo $data["ID_Cliente"]; ?>">Editar</a>

						<a class="link_delete" href="eliminar_confirmar_cliente.php?id=<?php echo $data["ID_Cliente"]; ?>">Eliminar</a>
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