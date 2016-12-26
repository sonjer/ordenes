$( document ).ready(function() { //INICIO JQUERY

    $('#cantidad1').on('input', function (event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });


});//FIN JQUERY
