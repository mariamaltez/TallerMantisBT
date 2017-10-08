$(document).ready(function(){
	$.ajax({
		url: "/taller_04/modelo/procesador.php",
	  	method: "GET",
	  	data: { controlador: "projectController", accion: "getProjects"},
	  	dataType: 'json',
	  	success: function (data, text) {
	  		if (data.status == 'ok'){
	  			$.each(data.mensaje, function (index, value) {
					$('#nombres_proyectos').append('<option value="'+value.id+'">'+value.nombre+'</option>');
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