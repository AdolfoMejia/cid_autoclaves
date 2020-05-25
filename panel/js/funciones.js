$(document).ready(function(){
    $('#add-form').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
		$.ajax({
            type: "POST",
			url: $(this).attr("action"),
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
			success: ajaxResponse,
        });
		return false;
    });

    function ajaxResponse(datos){
        $("#add-form")[0].reset();
        $('#responser').fadeIn("medium").html(datos);
    }

    $('a.delete').click(function(e){
        e.preventDefault();
        var action = $(this).attr('data-modal-type');
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');

        var datosEnvio ='action=' + action + '&id=' + id + '&type=' + type;

		$.ajax({
            type: "POST",
			url: $(this).attr("href"),
            data: datosEnvio,
			success: ajaxResponseDelete,
        });
		return false;
    });

    function ajaxResponseDelete(datos){
        $('#messageAlert').fadeIn("medium").html(datos);
    }
});