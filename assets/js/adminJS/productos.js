function resete(){
    $('#create_nombre').val('');
    $('#create_categoria').val('');
    $('#create_codigo').val('');
    $('#create_descripcion').val('');
    $('#create_precio_compra').val('');
    $('#create_precio_venta').val('');
    $('#create_img').val('');
    $('#create_inventariable').val('');
    $('#create_presentacion').val('');
    $('#data_id').val('');
    $('#btn-create').val("update");

    $("#create_perecedero").prop('checked', false);
    $("#create_perecedero").val('0');
}

function viewProducto(){
    
}

$(document).ready(function(){
    $('input[type="checkbox"]').on('change', function(e){
        var val = $(this).attr("value"); 
        if(val!=0){
            $('#create_perecedero').val('0');
        }else{
        $('#create_perecedero').val('1');
        }
    });
});

$(document).on('click','.btn-active',function(){
    var id = $(this).attr("id");
    var data= $(this).attr("value");
    var data2 = data.split('*');
    if (data2[2]==1) {
        document.getElementById("ti-cabeza").innerHTML="Eliminar";
        document.getElementById("g-active").innerHTML="Eliminar";
        document.getElementById("titulo").innerHTML = "Está seguro de eliminar el producto?";
        document.getElementById("id-pro-active").value=data2[0];
        document.getElementById("estado-pro-active").value=data2[2];
    }else{
        document.getElementById("ti-cabeza").innerHTML="Activar";
        document.getElementById("g-active").innerHTML="Activar";
        document.getElementById("titulo").innerHTML = "Desea activar el producto?";
        document.getElementById("id-pro-active").value=data2[0];
        document.getElementById("estado-pro-active").value=data2[2];
    }        
});

$(document).on('click', '.edit_data', function(){   
    var id = $(this).attr("id");
    document.getElementById("id-pro-edit").value=id;
});



