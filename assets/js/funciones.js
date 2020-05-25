$(document).ready(function(){
    $( $('.carousel-item')[0] ).addClass('active');

    //movimiento del menu
    $('a.smooth').click(function(e){
        e.preventDefault();
        enlace  = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(enlace).offset().top - 100
        }, 1500);
    });

    $('button.modal-open').click(function(){
        var action = $(this).attr('data-modal-type');
        var name = $(this).attr('data-name');
        var type = $(this).attr('data-type');

        var datosEnvio ='action=' + action + '&name=' + name + '&type=' + type;

		$.ajax({
            type: "POST",
			url: "index.php",
            data: datosEnvio,
			success: ajaxResponse,
        });
		return false;
    });

    function ajaxResponse(datos){
        $('body').addClass('overflow');
        $('#modal').fadeIn("fast").html(datos);
    }
});