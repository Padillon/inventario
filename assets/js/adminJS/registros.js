$("#btnGenerar").on("click", function(){
    slSeleccionar = $("#slSeleccionar").val();
    valor = $("#txtValor").val();

    $.ajax({
        url: base_url+"mantenimientos/registros/buscar",
        type: "POST",
        dataType: "html",
        data: {slSeleccionar: slSeleccionar,
            valor: valor},
        success: function(data){
            $("#txtValor").html(data);
        }
    });
});