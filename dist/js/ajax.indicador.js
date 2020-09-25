function ajaxindicatorstart(){
    //muestra preloader
    $("#preloadAjax").fadeIn();
}

function ajaxindicatorstop(){
    //oculta preloader
    $("#preloadAjax").fadeOut();
}
	
jQuery(document).ajaxStart(function () {
    ajaxindicatorstart();
}).ajaxStop(function () {
    ajaxindicatorstop();
}).ajaxError(function(event, xhr, status, error){    
    if(xhr.status == 404){
        swal("¡Error!", "Ha ocurrido un error inesperado, por favor contacte a sistemas, código de error: " + xhr.status, "error");
    }else if(xhr.status == 500){
        swal("", xhr.responseText, "");
        //swal.fire("¡Error!", "Ha ocurrido un error inesperado, código de error: "+xhr.status+", por favor vuelva a intentarlo, si el problema persiste, favor de contactar a sistemas.", "error");	
    }else if(xhr.status == 503){
        swal("", xhr.responseText, "");
        //swal.fire("¡Error!", "Ha ocurrido un error inesperado, código de error: "+xhr.status+", por favor vuelva a intentarlo, si el problema persiste, favor de contactar a sistemas.", "error");
    }else if(xhr.status === 0){
        console.log(xhr);
    }
});

jQuery.fn.reset = function () {
    $(this).each (function() { this.reset(); });
}