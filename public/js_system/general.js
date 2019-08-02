$(window).resize(function() {
    $(".select2-container").each(function() {
        $(this).css({ 'width': '100%' });
    });
});
$(window).load(function() {
    $(".select2-container").each(function() {
        $(this).css({ 'width': '100%' });
    });
});
$(document).ready(function() {
    $.extend(true, $.fn.dataTable.defaults, {
        "buttons": [{ "extend": 'copyHtml5', "text": 'Copiar', "className": 'btn btn-dark btn-sm' }, { "extend": 'excelHtml5', "text": 'Excel', "className": 'btn btn-dark btn-sm' }, { "extend": 'print', "text": 'IMPRIMIR', "className": 'btn btn-dark btn-sm', 'postfixButtons': ['colvisRestore'] }, { "extend": 'csvHtml5', "text": 'CSV', "className": 'btn btn-dark btn-sm', "fieldSeparator": '|', "fieldBoundary": "", "extension": ".txt", "header": false }, 'colvis'],
        dom: '<"row"<"col-12 col-sm-12 col-md-6"l><"col-12 col-sm-12 col-md-6"f>>rt<"top"B><"col-12"i>p',
        "lengthMenu": [
            [10, 15, 20, -1],
            [10, 15, 20, "All"]
        ],
        "language": {
            "url": "../public/fw/datatables/Spanish.json"
        },
        "order": [
            [0, "desc"]
        ]
    });
    $.fn.select2.defaults.set("theme", "bootstrap");
    if (jQuery().select2) {
        $.extend($.fn.select2.defaults.defaults.language, {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando..";
            }
        });
    }
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $(".select2-container").each(function() {
        $(this).css({ 'width': '100%' });
    });
    $(".two-decimals").change(function() {
        if ($(this).val() == "") {
            $(this).val(0.00);
        }
        this.value = this.value;
    });
});

function abrir_modal(nombre, title) {
    alertify.dialog(nombre, function() {
        return {
            main: function(content) {
                this.setContent(content);
            },
            setup: function() {
                return {
                    focus: {
                        element: function() {
                            return this.elements.body.querySelector(this.get('selector'));
                        },
                        select: true
                    },
                    options: {
                        basic: false,
                        title: title,
                        maximizable: false,
                        resizable: false,
                        padding: true,
                        modal: true,
                        transition: false,
                    }
                };
            },
            settings: {
                selector: undefined
            }
        };
    });
}

function actualizar_select2() {
    $(".select2-container").each(function() {
        $(this).css({ 'width': '100%' });
    });
}

function eliminar_item(id) {
    $.ajax({
        url: '../Pedidos/eliminar_item',
        type: "POST",
        dataType: "html",
        data: {
            'id': id,
        },
        success: function(data) {
            table = $('.datatable').DataTable();
            table.ajax.reload();
        }
    });
}