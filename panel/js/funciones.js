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
});