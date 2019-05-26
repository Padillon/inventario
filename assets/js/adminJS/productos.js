if($('#create_perecedero').val() > 0){
    $("#create_perecedero").prop('checked', true);
}

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

function viewProducto(num){
    valores = $("#viewPro"+num).val();
    datos = valores.split("*");

    $("#viewCodigo").val(datos[4]);
    $("#viewNombre").val(datos[1]);
    $("#viewDescripcion").val(datos[6]);
    $("#viewStock").val(datos[5]);
    $("#viewCompra").val("$ "+datos[7]);
    $("#viewVenta").val("$ "+datos[8]);
    $("#viewPresentacion").val(datos[11]);
    $("#viewMarca").val(datos[13]);
    $("#viewCategoria").val(datos[3]);
    $("#viewPerecedero").val(datos[12]);
    $("#viewImagen").attr("src", base_url+"assets/images/productos/"+datos[9]);

    if(datos[12] = 1){
        $("#viewPerecedero").prop('checked', true);
    } else {
        $("#viewPerecedero").prop('checked', false);
    }
    
    if (datos[2] = 1){
        $("#viewEstado").addClass("form-control alert alert-success");
        $("#viewEstado").val("Activo");
    } else{
        $("#viewEstado").addClass("form-control alert alert-danger");
        $("#viewEstado").val("Inactivo");
    }
    
}

$(document).ready(function(){
    $('input[type="checkbox"]').on('change', function(e){
        var val = $(this).attr("value"); 
        if(val!=0){
            $('#create_perecedero').val('1');
        }else{
        $('#create_perecedero').val('0');
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
