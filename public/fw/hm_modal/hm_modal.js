       // definición de la función
       $.fn.hm_modal = function(method, options) {
           // definimos los parámetros junto con los valores por defecto de la función
           $.fn.hm_modal.defecto = {
               cerrarclick: true,
               centrar: false,
               width: 80,
               sombra: false,
               padding: 15,
               nivelfade: 8,
               colorfade: '0,0,0',
               border: false,
               borderradius: 0,
               bordergrosor: 0,
               borderstyle: 'solid',
               bordercolor: 'transparent',
               backgroundcolorhead: 'transparent',
               backgroundcolorfooter: 'transparent',
               colorhead: 'black',
               colorfooter: 'black',
               fontsizehead: 16,
               fontsizefoot: 16,
           };
           var opts = $.extend({}, $.fn.hm_modal.defecto, options);
           var methods = {
               init: function(options) {},
               hide: function() {
                   $('.hm-modal').fadeOut();
               },
           };
           // puede recibir un array de parámetros nombrados
           // invocamos a una función genérica que hace el merge 
           // entre los recibidos y los de por defecto 
           // para cada componente que puede contener el objeto jQuery que invoca a esta función
           this.each(function() {
               var $element = $(this).prop('tagName');
               switch ($element) {
                   case 'DIV':
                       //
                       $(this).addClass('hm-modal');
                       if (opts.border == true) {
                           $(this).children('.hm-modal-content').css('border', '1px solid #E7E7E7');
                       } else {
                           $(this).children('.hm-modal-content').css('border', '0px');
                       };
                       if (opts.width == 'auto') {
                           $(this).children('.hm-modal-content').addClass('hm-width-auto');
                       } else {
                           $(this).children('.hm-modal-content').css('width', opts.width + '%');
                       };
                       $(this).children('.hm-modal-content').css('padding', opts.padding + 'px');
                       switch (opts.centrar) {
                           case false:
                               $(this).children('.hm-modal-content').css('margin', '10px auto 10px auto')
                               break
                           case true:
                               $(this).children('.hm-modal-content').css('margin', '0');
                               $(this).children('.hm-modal-content').addClass('hm-centrar');
                               break;
                       };
                       $(this).children('.hm-modal-content').css({
                           "border": opts.bordergrosor + "px " + opts.borderstyle + " " + opts.bordercolor,
                       });
                       $(this).children('.hm-modal-content').css({
                           "border-radius": opts.borderradius + "px",
                           "-webkit-border-radius": opts.borderradius + "px",
                           "-moz-border-radius": opts.borderradius + "px",
                       });
                       switch (opts.sombra) {
                           case false:
                               break
                           case true:
                               $(this).children('.hm-modal-content').addClass('hm-sombra')
                               break
                       };
                       $(this).find('.hm-modal-head').css({
                           'background-color': opts.backgroundcolorhead,
                           'color': opts.colorhead,
                           'font-size': opts.fontsizehead + 'px',
                       });
                       $(this).find('button').css({
                           'background-color': opts.backgroundcolorhead,
                           'border': '0 solid transparent'
                       });
                       $(this).find('.hm-modal-footer').css({
                           'background-color': opts.backgroundcolorfooter,
                           'color': opts.colorfooter,
                           'font-size': opts.fontsizefooter + 'px',
                       });
                       //
                       $(this).css('background-color', 'rgba(' + opts.colorfade + ',0.' + opts.nivelfade + ')');
                       $(this).find('.hm-modal-content').prepend('<span class="hm-modal-close">&#10010;</span>');
                       $(this).find('span').click(function() {
                           $(this).parent().parent().fadeOut();
                           $(this).children('.hm-modal-content').slideToggle();
                       });
                       break;
                   case 'A':
                   case 'BUTTON':
                   case 'LI':
                       var $nombre = $(this).data('hm-modal');
                       $(this).click(function() {
                           $('#' + $nombre).fadeIn(100);
                           setTimeout(function() {
                               $('.hm-modal-content').fadeIn(100);
                           }, 10);
                       });
                       break;
               }
               window.onclick = function(event) {
                   var $elemento = $(event.target);
                   var $elementotagname = $elemento.prop('tagName');
                   var $elementoclass = $elemento.prop('class');
                   var $elementoid = $elemento.prop('id');
                   var $elementoclass2 = $elementoclass.split(" ");
                   if ($elementotagname == 'DIV' && $elementoclass == $elementoclass2[0] + ' ' + 'hm-modal') {
                       if (opts.cerrarclick == true) {
                           $('div#' + $elementoid).fadeOut();
                           $('.hm-modal-content').fadeOut();
                       };
                   }
               }
           });
           if (methods[method]) {
               return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
           } else
           if (typeof method === 'object' || !method) {
               //Si no se pasa ningún parámetro o el parámetro es 
               //un objeto de configuración llamamos al inicializador  
               return methods.init.apply(this, arguments);
           } else {
               //En el resto de los casos mostramos un error
               $.error('La función ' + method + ' no existe en jQuery.tooltip');
           }
       };