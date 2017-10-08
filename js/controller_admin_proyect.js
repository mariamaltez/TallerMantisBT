$(document).ready(function(){

	var plantilla_fila = '<tr><td style="display: none;">$$ID$$</td><td><ul class="nav navbar-nav"><li class="dropdown"><a style="padding: 0px!important" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Acciones <span class="caret"></span></a><ul class="dropdown-menu"><li><a href="#">Editar</a></li><li><a data-id="$$ID$$" class="eliminarProyectoBtn" href="#">Eliminar</a></li></ul></li></ul></td><td>$$NOMBRE$$</td><td>$$DESCRIPCION$$</td><td>$$COLUMNAS$$</td><td>$$COLOR$$</td><td>$$PROPIETARIO$$</td></tr><tr>';
	$.ajax({
		url: "/taller_04/modelo/procesador.php",
	  	method: "GET",
	  	data: { controlador: "projectController", accion: "getAllProjects"},
	  	dataType: 'json',
	  	success: function (data, text) {
	  		if (data.status == 'ok' ){
	  			$.each(data.mensaje, function (index, value){
	  				aux = plantilla_fila;
	  				aux =  aux.replace(/\$\$ID\$\$/g,value.id);
	  				aux =  aux.replace(/\$\$NOMBRE\$\$/g,value.nombre);
	  				aux =  aux.replace(/\$\$DESCRIPCION\$\$/g, value.descripcion);
	  				aux =  aux.replace(/\$\$COLUMNAS\$\$/g, value.columnas);
	  				aux =  aux.replace(/\$\$COLOR\$\$/g, value.color);
	  				aux =  aux.replace(/\$\$PROPIETARIO\$\$/g, value.username);
	  				$('.tabla_proyectos tbody').append(aux);
	  			});
	  		}else{
	  			alert("Error al cargar los proyectos.")
	  		}
	  	},
	    error: function (request, status, error) {
	        console.log('error');
	    }
	});

	$(".crearProyecto").on('click', function(){
		$(".modal-body input").val('');
		$(".ccolumna").remove();
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
		  		}else{
		  			alert("Error al cargar información de la tarea.")
		  		}
		  	},
		    error: function (request, status, error) {
		        console.log('error');
		    }
 		});
		$('#myModal').on('show.bs.modal', function (e) {
			//alert('modal show');
		});
	});

	$("#myModal #columnas").focusout(function(){
		$(".ccolumna").remove();
		var n = $(this).val();
		if (n != ''){
			if (!isNaN(n)){
				var plantilla = '<div class="form-group ccolumna"><label for="columna-$$n$$">Nombre Columna Nº $$n$$</label><input type="text" class="form-control" id="columna-$$n$$" placeholder="Nº Columnas" name="columna-$$n$$"></div>';
				for (var i = parseInt(n); i >= 1; i--) {
					aux =  plantilla;
					aux =  aux.replace(/\$\$n\$\$/g,i);
					$(aux).insertAfter('#ncol');
					$('#columna-'+i).focus();
				}
			}else{
				alert("("+n+") No es un numero valido, ingrese cantidad de columnas en numero");
			}
		}
	});

	$('#createProject').on('click', function(){
		//console.log($(".form-new").serialize());
		$.ajax({
 			url: "/taller_04/modelo/procesador.php",
		  	method: "GET",
		  	data: { controlador: "projectController", accion: "createProject", datos: $(".form-new").serialize()},
		  	dataType: 'json',
		  	success: function (data, text) {
		  		console.log(data);
		  		if (data.status == 'ok' && data.mensaje == 1){
		  			alert("Proyecto creado correctamente!");
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

	$('.tabla_proyectos tbody').on("click", ".eliminarProyectoBtn", function(e){
		e.preventDefault();
		var r = confirm("Está seguro que desea eliminar este proyecto?");
		if (!r){
			return false;
		};
		id = $(this).attr('data-id');
		if (id == '' || id == null){
			alter("Error al eliminar");
			return false;
		}
		$.ajax({
 			url: "/taller_04/modelo/procesador.php",
		  	method: "GET",
		  	data: { controlador: "projectController", accion: "deleteProject", id: id},
		  	dataType: 'json',
		  	success: function (data, text) {
		  		console.log(data);
		  		if (data.status == 'ok' && data.mensaje == 1){
		  			alert("Proyecto eliminado correctamente!");
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

});












