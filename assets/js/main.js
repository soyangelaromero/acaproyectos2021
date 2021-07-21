	$(document).ready(function(){
		/////// Profesionales
	   	function loadTableData(){
	       $.ajax({
	           url : "lista_profesionales.php",
	           type : "POST",
	           success:function(data){
	              $("#tableData").html(data);
	           }
	       });
	   	}
	   	loadTableData();
		$("#registro").click(function(e){
			e.preventDefault();
			var nombre_completo = $("#nombre_completo").val();
			var fecha_nacimiento = $("#fecha_nacimiento").val();
			var correo_profesional = $("#correo_profesional").val();
			var telefono_profesional = $("#telefono_profesional").val();
			var seniority_id = $("#seniority_id").val();
			var disponible = $("#disponible").val();
			var puntuacion = $("#puntuacion").val();
			var horas_diarias = $("#horas_diarias").val();
			var horas_disponibles = $("#horas_disponibles").val();
			var nivel_ingles_id = $("#nivel_ingles_id").val();
			var pais_id = $("#pais_id").val();
			var contrasenia = $("#contrasenia").val();
			var tipo_usuario_id = $("#tipo_usuario_id").val();
			var estatus_id = $("#estatus_id").val();
			if(nombre_completo !=="" && fecha_nacimiento !=="" && correo_profesional !=="" && 
			telefono_profesional !=="" && seniority_id !=="" && disponible !=="" &&
			puntuacion !=="" && horas_diarias !=="" && horas_disponibles !=="" && nivel_ingles_id !=="" &&
			pais_id !=="" && contrasenia !=="" && tipo_usuario_id !=="" && estatus_id !==""){
				$.ajax({
					url : "registro_profesional.php",
					type: "POST",
					cache: false,
					data : {nombre_completo:nombre_completo,fecha_nacimiento:fecha_nacimiento,
					correo_profesional:correo_profesional,telefono_profesional:telefono_profesional,
					seniority_id:seniority_id,disponible:disponible,puntuacion:puntuacion,
					horas_diarias:horas_diarias,horas_disponibles:horas_disponibles,
					nivel_ingles_id:nivel_ingles_id,pais_id:pais_id,contrasenia:contrasenia,
					tipo_usuario_id:tipo_usuario_id, estatus_id:estatus_id},
					success:function(data){
						alert("Datos insertados correctamente");
						$("#profesionalForm")[0].reset();
						loadTableData();
					},
				});
			}else{
				alert("Todos los campos son obligatorios");
			}
		});	

		$(document).on("click",".btn_ok",function(){
			if (confirm("¿Estás seguro de eliminar esto?")) {
				var ID_Profesional = $(this).data('ID_Profesional');
				var element = this;
				$.ajax({
					url :"eliminar_confirmar_profesional.php",
					type:"POST",
					cache:false,
					data:{ID_Profesional:ID_Profesional},
					success:function(data){
						if (data == 1) {
							$(element).closest("tr").fadeOut();
							alert("Registro eliminado correctamente");	
						}else{
							alert("Identificación inválida");
						}
					}
				});
			}
		});

		$(document).on("click",".btn_save",function(){
			var ID_Profesional = $(this).data('ID_Profesional');
			$.ajax({
				url :"editar_profesional.php",
				type:"POST",
				cache:false,
				data:{ID_Profesional:ID_Profesional},
				success:function(data){
					$("#editarFormProfesional").html(data);
				},
			});
		});

		$(document).on("click","#editarSubmit", function(){
			var nombre_completo = $("#nombre_completo").val();
			var fecha_nacimiento = $("#fecha_nacimiento").val();
			var correo_profesional = $("#correo_profesional").val();
			var telefono_profesional = $("#telefono_profesional").val();
			var seniority_id = $("#seniority_id").val();
			var disponible = $("#disponible").val();
			var puntuacion = $("#puntuacion").val();
			var horas_diarias = $("#horas_diarias").val();
			var horas_disponibles = $("#horas_disponibles").val();
			var nivel_ingles_id = $("#nivel_ingles_id").val();
			var pais_id = $("#pais_id").val();
			var contrasenia = $("#contrasenia").val();
			var tipo_usuario_id = $("#tipo_usuario_id").val();
			var estatus_id = $("#estatus_id").val();
			
			$.ajax({
				url:"editar_profesional.php",
				type:"POST",
				cache:false,
				data : {nombre_completo:nombre_completo,fecha_nacimiento:fecha_nacimiento,
					correo_profesional:correo_profesional,telefono_profesional:telefono_profesional,
					seniority_id:seniority_id,disponible:disponible,puntuacion:puntuacion,
					horas_diarias:horas_diarias,horas_disponibles:horas_disponibles,
					nivel_ingles_id:nivel_ingles_id,pais_id:pais_id,contrasenia:contrasenia,
					tipo_usuario_id:tipo_usuario_id, estatus_id:estatus_id},
				success:function(data){
					if (data ==1) {
						alert("Registro actualizado correctamente");
						loadTableData();
					}else{
						alert("Algo salió mal");	
					}
				}
			});
		});
		////// Proyectos
		function loadTableData(){
			$.ajax({
				url : "lista_proyectos.php",
				type : "POST",
				success:function(data){
				   $("#tableData").html(data);
				}
			});
			}
			loadTableData();
		 $("#registro").click(function(e){
			 e.preventDefault();
			 var nombre_proyecto = $("#nombre_proyecto").val();
			 var descripcion_breve = $("#descripcion_breve").val();
			 var nombre_empresa = $("#nombre_empresa").val();
			 var nivel_prioridad = $("#nivel_prioridad").val();
			 var nivel_progreso = $("#nivel_progreso").val();
			 var fecha_inicio = $("#fecha_inicio").val();
			 var fecha_fin_estimada = $("#fecha_fin_estimada").val();
			 var fecha_fin_real = $("#fecha_fin_real").val();
			 var total_horas_estimadas = $("#total_horas_estimadas").val();
			 var total_horas_real = $("#total_horas_real").val();
			 var gasto_estimado = $("#gasto_estimado").val();
			 var gasto_real = $("#gasto_real").val();
			 var nombre_estatus = $("#nombre_estatus").val();
			 if(nombre_proyecto !=="" && descripcion_breve !=="" && nombre_empresa !=="" && 
			 nivel_prioridad !=="" && nivel_progreso !=="" && fecha_inicio !=="" &&
			 fecha_fin_estimada !=="" && fecha_fin_real !=="" && total_horas_estimadas !=="" && total_horas_real !=="" &&
			 gasto_estimado !=="" && gasto_real !=="" && nombre_estatus !==""){
				 $.ajax({
					 url : "registro_proyecto.php",
					 type: "POST",
					 cache: false,
					 data : {nombre_proyecto:nombre_proyecto,descripcion_breve:descripcion_breve,
					 cliente_id:nombre_empresa,prioridad_id:nivel_prioridad,
					 progreso_id:nivel_progreso,fecha_inicio:fecha_inicio,fecha_fin_estimada:fecha_fin_estimada,
					 total_horas_estimadas:total_horas_estimadas,total_horas_real:total_horas_real,
					 gasto_estimado:gasto_estimado,gasto_real:gasto_real,estatus_id:nombre_estatus},
					 success:function(data){
						 alert("Datos insertados correctamente");
						 $("#proyectosForm")[0].reset();
						 loadTableData();
					 },
				 });
			 }else{
				 alert("Todos los campos son obligatorios");
			 }
		 });	
 
		 $(document).on("click",".btn_ok",function(){
			 if (confirm("¿Estás seguro de eliminar esto?")) {
				 var ID_Proyecto = $(this).data('ID_Proyecto');
				 var element = this;
				 $.ajax({
					 url :"eliminar_confirmar_proyecto.php",
					 type:"POST",
					 cache:false,
					 data:{ID_Proyecto:ID_Proyecto},
					 success:function(data){
						 if (data == 1) {
							 $(element).closest("tr").fadeOut();
							 alert("Registro eliminado correctamente");	
						 }else{
							 alert("Identificación inválida");
						 }
					 }
				 });
			 }
		 });
 
		 $(document).on("click",".btn_save",function(){
			 var ID_Proyecto = $(this).data('ID_Proyecto');
			 $.ajax({
				 url :"editar_proyecto.php",
				 type:"POST",
				 cache:false,
				 data:{ID_Proyecto:ID_Proyecto},
				 success:function(data){
					 $("#editarFormProyecto").html(data);
				 },
			 });
		 });
 
		 $(document).on("click","#editarSubmit", function(){
			var nombre_proyecto = $("#nombre_proyecto").val();
			var descripcion_breve = $("#descripcion_breve").val();
			var nombre_empresa = $("#nombre_empresa").val();
			var nivel_prioridad = $("#nivel_prioridad").val();
			var nivel_progreso = $("#nivel_progreso").val();
			var fecha_inicio = $("#fecha_inicio").val();
			var fecha_fin_estimada = $("#fecha_fin_estimada").val();
			var fecha_fin_real = $("#fecha_fin_real").val();
			var total_horas_estimadas = $("#total_horas_estimadas").val();
			var total_horas_real = $("#total_horas_real").val();
			var gasto_estimado = $("#gasto_estimado").val();
			var gasto_real = $("#gasto_real").val();
			var nombre_estatus = $("#nombre_estatus").val();
			 
			 $.ajax({
				 url:"editar_proyecto.php",
				 type:"POST",
				 cache:false,
				 data : {nombre_proyecto:nombre_proyecto,descripcion_breve:descripcion_breve,
					cliente_id:nombre_empresa,prioridad_id:nivel_prioridad,
					progreso_id:nivel_progreso,fecha_inicio:fecha_inicio,fecha_fin_estimada:fecha_fin_estimada,
					total_horas_estimadas:total_horas_estimadas,total_horas_real:total_horas_real,
					gasto_estimado:gasto_estimado,gasto_real:gasto_real,estatus_id:nombre_estatus},
				 success:function(data){
					 if (data ==1) {
						 alert("Registro actualizado correctamente");
						 loadTableData();
					 }else{
						 alert("Algo salió mal");	
					 }
				 }
			 });
		 });
	});