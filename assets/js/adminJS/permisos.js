$(document).on('click', '.modal_editar', function(){  
    var data = $(this).attr("value");
    data_permiso = data.split("*");
    // ******************************************* ROL Y MENU ***********************************************
    document.getElementById("titulo_rol").innerHTML = "Usuario tipo "+data_permiso[2];
    
    document.getElementById("titulo_menu").innerHTML = "Menu "+data_permiso[1];
    // ******************************************* RADIO BUTON ***********************************************
    $("#id_permiso").val(data_permiso[0]);
    //leer
    if(data_permiso[3]==1){
        $("#radio_leer").prop('checked', true);
        $("#radio_leer").val('1');
    }
    //insertar
    if(data_permiso[4]==1){
        $("#radio_insertar").prop('checked', true);
        $("#radio_insertar").val('1');
    }
    //actualizar
    if(data_permiso[3]==1){
        $("#radio_actualizar").prop('checked', true);
        $("#radio_actualizar").val('1');
    }
    //eliminar
    if(data_permiso[3]==1){
        $("#radio_eliminar").prop('checked', true);
        $("#radio_eliminar").val('1');
    }


});

$(document).on('click','.condicion_leer',function(){
    valor = $("#radio_leer").val();
    if(valor == 1){
        $("#radio_leer").val('0');
        $("#radio_insertar").prop('checked', false);
        $("#radio_insertar").val('0');
        $("#radio_actualizar").prop('checked', false);
        $("#radio_actualizar").val('0');
        $("#radio_eliminar").prop('checked', false);
        $("#radio_eliminar").val('0');
    }else{
        $("#radio_leer").val('1');
    }
});

$(document).on('click','.condicion_insertar',function(){
    leer = $("#radio_leer").val();
    if(leer == 1){
        radio = $("#radio_insertar").val();
        if(radio == 1){
            $("#radio_insertar").val('0');
        }else{
            $("#radio_insertar").val('1');
        }

    }else{
        $("#radio_insertar").prop('checked', false);
        $("#radio_insertar").val('0');
    }
});
$(document).on('click','.condicion_actualizar',function(){
    leer = $("#radio_leer").val();
    if(leer == 1){
        radio = $("#radio_actualizar").val();
        if(radio == 1){
            $("#radio_actualizar").val('0');
        }else{
            $("#radio_actualizar").val('1');
        }

    }else{
        $("#radio_actualizar").prop('checked', false);
        $("#radio_actualizar").val('0');
    }
});
$(document).on('click','.condicion_eliminar',function(){
    leer = $("#radio_leer").val();
    if(leer == 1){
        radio = $("#radio_eliminar").val();
        if(radio == 1){
            $("#radio_eliminar").val('0');
        }else{
            $("#radio_eliminar").val('1');
        }

    }else{
        $("#radio_eliminar").prop('checked', false);
        $("#radio_eliminar").val('0');
    }
});