$(document).ready(function(){
    //movimiento del menu
    $('a.smooth').click(function(e){
        e.preventDefault();
        enlace  = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(enlace).offset().top - 100
        }, 1500);
    });

    $('button.productos').click(function(){
        name = $(this).attr('data-name');
        type = $(this).attr('data-type');

        var datosEnvio ='action=modal' + '&name=' + name + '&type=' + type;

		$.ajax({
			type: "POST",
            url: "index.php",
            data: datosEnvio
        })
        .done(function( data ) {
            $('#modal').fadeIn("fast").html(data);
        });
		return false;
    });

    /////////////CARGANDO DATOS, RECIBIENDO DATOS Y ERROR DE AJAX
    function cargandoAjax(){
        $('.gif').fadeIn("fast");
        $(".mensajeEnvio").fadeIn("fast");
    }

        function cargandoAjaxCorreo(){
            $('.gif').fadeIn("fast");
            $(".envioCorreo").fadeIn("fast");
        }

    function datosAjax(datos){
        $('.gif').hide();
        $('.mensajeEnvio').fadeIn("fast").html(datos);
    }

        function datosAjaxCorreo(datos){
            // $('.gif').hide();
            $('#modal').fadeIn("fast").html(datos);
            // setTimeout(function() {
            //     $(".envioCorreo").fadeOut("slow");
            // },3000);
        }

    function errorAjax(datos){
        $('.gif').hide();
        $('.mensajeEnvio').fadeIn("fast");
        $('.mensajeEnvio').html("<p>Error en servidor, contactar al administrador...</p>").addClass('mensajeEnvio_error');
    }

        function errorAjaxCorreo(datos){
            $('.gif').hide();
            $('.envioCorreo').fadeIn("fast");
            $('.envioCorreo').html("<p>Error en servidor, contactar al administrador...</p>").addClass('mensajeEnvio_error');
        }
});