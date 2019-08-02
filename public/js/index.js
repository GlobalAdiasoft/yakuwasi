$(document).ready(function() {
    $("#formulario_logueo").on("submit", function(e) {
        e.preventDefault();
        var f = $(this);
        var metodo = f.attr("method");
        var url = f.attr("action");
        var formData = new FormData(this);
        formData.append("dato", "valor");
        $.ajax({
            url: url,
            type: metodo,
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {

            },
            success: function(response) {

                alertify.set('notifier', 'position', 'top-center');
                if (response == 0.1) {
                    alertify.notify('El campo de <strong>usuario</strong> esta vacío.', 'custom', 3, function() {});
                    $('input[name=usuario]').focus();
                }
                if (response == 0.2) {
                    alertify.notify('El campo de <strong>contraseña</strong> esta vacío.', 'custom', 3, function() {});
                    $('input[name=password]').focus();
                }
                if (response == 0) {
                    alertify.notify('El <strong>usuario</strong> no existe.', 'custom', 3, function() {});
                    $('input[name=usuario]').focus();
                    $('input[name=password]').val('');
                }
                if (response == 2) {
                    alertify.notify('<strong>Contraseña</strong> errónea.', 'custom', 3, function() {})
                    $('input[name=password]').focus();
                    $('input[name=password]').val('');
                }
                if (response == 1) {
                    location.reload();
                }
            },
            error: function() {},
        });
    });
});