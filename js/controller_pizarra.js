$(document).ready(function(){
	var plantillaColumna = '<div data-column="$$COLUMN$$" class="column column-$$COLUMN$$ col-md-$$SIZE$$ inline"><h5 class="title-column"><strong>$$TITLE$$</strong></h5><div id="tareas-$$COLUMN$$" class="tareas droptrue tareas-contenedor" data-estado="$$COLUMN$$"></div></div>';
	var plantillaTarea = '<div id="caja-$$IDTAREA$$" data-idTarea="$$IDTAREA$$" class="tarea ui-state-default"><h6 class="nombre_tarea"><strong>$$TAREANAME$$</strong></h6><hr><p class="descripcion">$$TAREADESCRIPCION$$</p><p class="tiempo"><span class="glyphicon glyphicon-time"></span> $$TIEMPO$$ hrs.</p><p class="author"><strong>Asignado a:</strong> $$AUTHOR$$</p><button title="Añadir tiempo" data-id="$$IDTAREA$$" type="button" class="btn btn-success btn-xs btnAddTime"><span class="glyphicon glyphicon-time"></span></button><button title="Eliminar tarea" data-id="$$IDTAREA$$" type="button" class="btn btn-danger btn-xs btnEliminar"><span class="glyphicon glyphicon-remove"></span></button><button title="Editar Tarea" type="button" class="btn btn-info btn-xs btnEditar" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil"></span></button></div>';

	$("#myModal .modal-footer #updateTarea").on('click', function(e){
		e.preventDefault();
		nombre = $("#myModal .modal-body #nombre").val();
		descripcion = $("#myModal .modal-body #descripcion").val();
		autor = $("#myModal .modal-body #autor").val();
		idTarea = $("#myModal .modal-body #idTarea").val();

		if (nombre == "" || descripcion == "" || autor == "" || idTarea == "") {
			alert("Error");
			return false;
		}

		$.ajax({
 			url: "/taller_04/modelo/procesador.php",
		  	method: "GET",
		  	data: { controlador: "projectController", accion: "updateTarea", nombre: nombre, descripcion: descripcion, autor: autor, idTarea: idTarea, idproject: window.id_project},
		  	dataType: 'json',
		  	success: function (data, text) {
		  		if (data.status == 'ok' && data.mensaje == 1){
		  			alert("Tarea actualizada correctamente!");
		  			location.reload();
		  		}
		  	},
		    error: function (request, status, error) {
		        console.log('error');
		        alert("Problemas al actualizar la tarea. Recargue la página.");
		    }
 		});

	});
	$(".crearTarea").on('click', function(){
		console.log("click en crear tarea");
		$.ajax({
 			url: "/taller_04/modelo/procesador.php",
		  	method: "GET",
		  	data: { controlador: "projectController", accion: "getAutores"},
		  	dataType: 'json',
		  	success: function (data, text) {
		  		console.log(data);
		  		if (data.status == 'ok' ){
		  			$("#myModal2 .modal-body #autor").html('<option selected>Seleccione..</option>');
		  			$.each(data.mensaje, function (index, value){
		  				$("#myModal2 .modal-body #autor").append('<option value="'+value.username+'">'+value.username+'</option>');
		  			});
		  		}else{
		  			alert("Error al cargar información de la tarea.")
		  		}
		  	},
		    error: function (request, status, error) {
		        console.log('error');
		    }
 		});
 		$('#myModal2').on('show.bs.modal', function (e) {
			//alert('modal show');
		});
	});

	$("#myModal2 #guardarTarea").on('click', function(){
		nombre = $("#myModal2 .modal-body #nombre").val();
		descripcion = $("#myModal2 .modal-body #descripcion").val();
		autor = $("#myModal2 .modal-body #autor").val();
		if (nombre == "" || descripcion == "" || autor == ""){
			alert("Error");
			return false;
		}
		$.ajax({
 			url: "/taller_04/modelo/procesador.php",
		  	method: "GET",
		  	data: { controlador: "projectController", accion: "crearTarea", nombre: nombre, descripcion: descripcion, autor: autor, idproject: window.id_project},
		  	dataType: 'json',
		  	success: function (data, text) {
		  		if (data.status == 'ok' && data.mensaje == 1){
		  			alert("Tarea creada correctamente!");
		  			location.reload();
		  		}
		  	},
		    error: function (request, status, error) {
		        console.log('error');
		        alert("Problemas al actualizar la tarea. Recargue la página.");
		    }
 		});
	});

	$.ajax({
		url: "/taller_04/modelo/procesador.php",
	  	method: "GET",
	  	data: { controlador: "projectController", accion: "getProject", idproject: window.id_project},
	  	dataType: 'json',
	  	success: function (data, text) {
	  		if (data.status == 'ok'){
	  			console.log(data);
	  			$.each(data.mensaje.columnsName, function (index, value){
	  				size = Math.trunc(12/parseInt(data.mensaje.columnsName.length))
	  				aux = plantillaColumna;
	  				aux =  aux.replace(/\$\$COLUMN\$\$/g,value.orden);
	  				aux =  aux.replace(/\$\$SIZE\$\$/g, size);
	  				aux =  aux.replace(/\$\$TITLE\$\$/g, value.nombre_columna);
	  				$('.board').append(aux);
	  			})
	  			$.each(data.mensaje.tareasProject, function (index, value){
	  				aux = plantillaTarea;
	  				aux =  aux.replace(/\$\$IDTAREA\$\$/g,value.id);
	  				aux =  aux.replace(/\$\$TAREANAME\$\$/g, value.nombre);
	  				aux =  aux.replace(/\$\$TAREADESCRIPCION\$\$/g, value.descripcion);
	  				aux =  aux.replace(/\$\$AUTHOR\$\$/g, value.username);
	  				aux =  aux.replace(/\$\$TIEMPO\$\$/g, value.tiempo);
	  				$('.board .column.column-'+value.columna+' .tareas').append(aux);
	  			});
	  			$( ".droptrue" ).sortable({
	  				revert    : true,
					connectWith: "div.tareas-contenedor",
				 	dropOnEmpty: true,
				 	stop: function( event, ui ) {
				 		idTarea= ui.item.attr("data-idtarea");
				 		idColumn= ui.item.parent().parent().attr("data-column");
				 		ui.item.css({"pointer-events": "none","opacity":"0.85"});
				 		$.ajax({
				 			url: "/taller_04/modelo/procesador.php",
						  	method: "GET",
						  	data: { controlador: "projectController", accion: "moveTarea", idTarea: idTarea, idColumn: idColumn, idproject: window.id_project},
						  	dataType: 'json',
						  	success: function (data, text) {
						  		if (data.status == 'ok' && data.mensaje == 1){
						  			ui.item.css({"pointer-events": "auto","opacity":"1"});
						  		}
						  	},
						    error: function (request, status, error) {
						        console.log('error');
						        alert("Problemas al actualizar la tarea. Recargue la página.");
						    }
				 		});
				 	}
				});
	  			$('.tareas.droptrue').disableSelection();
	  			var projectInfo = data.mensaje.projectInfo;
	  			projectInfo.color = (projectInfo.color[0] == "#") ? projectInfo.color : "#"+projectInfo.color;
	  			$(".board .column").css({"background":projectInfo.color});
	  			$(".title-project").html(projectInfo.nombre);
	  			$(".subtitle-project").html(projectInfo.descripcion);

	  			$(".btnEditar").on('click', function(){
	  				autotarea= $(this).siblings().eq(3).text().replace("Asignado a: ","");
	  				$.ajax({
			 			url: "/taller_04/modelo/procesador.php",
					  	method: "GET",
					  	data: { controlador: "projectController", accion: "getAutores"},
					  	dataType: 'json',
					  	success: function (data, text) {
					  		//console.log(data);
					  		if (data.status == 'ok' ){
					  			$("#myModal .modal-body #autor").html('<option >Seleccione..</option>');
					  			$.each(data.mensaje, function (index, value){
					  				$("#myModal .modal-body #autor").append('<option value="'+value.username+'">'+value.username+'</option>');
					  			});
					  			console.log("autor: "+autotarea)
					  			$("#myModal .modal-body #autor").val(autotarea);
					  		}else{
					  			alert("Error al cargar información de la tarea.")
					  		}
					  	},
					    error: function (request, status, error) {
					        console.log('error');
					    }
			 		});
					$("#myModal .modal-body #nombre").val($(this).siblings().eq(0).text());
					$("#myModal .modal-body #descripcion").val($(this).siblings().eq(2).text());
					$("#myModal .modal-body #idTarea").val($(this).parent().attr("data-idtarea"));
					
					$('#myModal').on('show.bs.modal', function (e) {
						//alert('modal show');
					});
	  			});
	  			$(".btnEliminar").on('click', function(){
	  				var r = confirm("Está seguro que desea eliminar esta tarea?");
					if (!r){
						return false;
					};
					id = $(this).attr("data-id");
					if (id == '' || id == null){
						alert("Error al eliminar");
						return false;
					}
					$.ajax({
			 			url: "/taller_04/modelo/procesador.php",
					  	method: "GET",
					  	data: { controlador: "projectController", accion: "deleteTarea", id: id},
					  	dataType: 'json',
					  	success: function (data, text) {
					  		console.log(data);
					  		if (data.status == 'ok' && data.mensaje == 1){
					  			alert("Tarea eliminada correctamente!");
					  			location.reload();
					  		}else{
					  			alert("Error: "+data.mesaje);
					  		}
					  	},
					    error: function (request, status, error) {
					        console.log('error');
					    }
			 		});
	  			});
	  			$(".btnAddTime").on('click', function(){
	  				var horas = prompt("Ingresa las HORAS que deseas añadir", "1");
	  				if (!horas) {
	  					return false;
	  				}
	  				id = $(this).attr("data-id");
	  				if (id == '' || id == null){
	  					alert("Error al guardar tiempo");
	  					return false;
	  				}
	  				if (!isNaN(horas)){
	  					$.ajax({
				 			url: "/taller_04/modelo/procesador.php",
						  	method: "GET",
						  	data: { controlador: "projectController", accion: "addHoraTarea", horas: horas, id: id},
						  	dataType: 'json',
						  	success: function (data, text) {
						  		console.log(data);
						  		if (data.status == 'ok' && data.mensaje == 1){
						  			alert("Tiempo guardado correctamente!");
						  			location.reload();
						  		}else{
						  			alert("Error: "+data.mesaje);
						  		}
						  	},
						    error: function (request, status, error) {
						        console.log('error');
						    }
				 		});
	  				}else{
	  					alert("Formato no válido!");
	  				}
	  			});
	  		}else{
	        	console.log('error');
	  		}
	    },
	    error: function (request, status, error) {
	        console.log('error');
	    }
	})
});
















