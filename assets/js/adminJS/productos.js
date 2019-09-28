var producto_existente=undefined;
var cod_existente=undefined;

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
//verificar si exite producto o código
$('#codigo_manual').keyup(function(){
    $.ajax({
        url: base_url+"mantenimiento/productos/getExistenteCod",
        type: "POST",
        dataType: "json",
        data:{ getExistente: $('#codigo_manual').val()},
        success: function(data){
            if (data != null) {
                cod_existente = data.codigo;           
            }
        },
    });
});

$('#create_nombre').keyup(function(){

    $.ajax({
        url: base_url+"mantenimiento/productos/getExistente",
        type: "POST",
        dataType: "json",
        data:{ getExistente: $('#create_nombre').val()},
        success: function(data){
            if (data != null) {             
                producto_existente = data.nombre;
                
            }
        },
    });
});

jQuery.validator.addMethod("productoE",
function(value, element) {
    if (value == producto_existente){     
        return false;
     } else {
        return true;
     }       
},
"Producto ya existe."
);
jQuery.validator.addMethod("codE",
function(value, element) {
    if (value == cod_existente){     
        return false;
     } else {
        return true;
     }       
},
"Código ya existe."
);

$("#formularioAgregar").validate({
    rules: {
        create_nombre:
        {
             required:true,
             productoE:'#create_nombre',
        },
        codigo_manual:{
            required:true,
            codE:'#codigo_manual',
        }

    },
});



function viewProducto(num){
    valores = $("#viewPro"+num).val();
    datos = valores.split("*");
    stock_actual = datos[14];

    $("#viewCodigo").val(datos[4]);
    $("#viewNombre").val(datos[1]);
    $("#viewDescripcion").val(datos[6]);
    $("#viewStock").val(datos[5]);
    
    $("#viewCompra").val("$ "+datos[7]);
    $("#viewVenta").val("$ "+datos[8]);

    equi = datos[15];
    total = Math.floor(stock_actual / equi);

    $("#selectEqui").val(datos[11]);
    $("#viewStock_actual").val(total);

    $("#viewMarca").val(datos[13]);
    $("#viewCategoria").val(datos[3]);
    if (datos[12] != 1) {
        $("#create_perecedero").prop('checked', false);
        $("#create_perecedero").val('0');
    }else{
        $("#create_perecedero").prop('checked', true);
        $("#create_perecedero").val('1 ');
    }
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
     //Para saber si el roducto es perecedero
    $('#create_perecedero').on('change', function(e){     
        if( $("#create_perecedero").prop('checked')){
            $('#create_perecedero').val('1');
        }else{
        $('#create_perecedero').val('0');
        }      
    });

     //Activar entrada de codigo manual
     $('#activar_cod_manual').on('change', function(e){     
        if( $("#activar_cod_manual").prop('checked')){
            $('#codigo_manual').val('');
            $('#codigo_manual').prop('disabled',false);
            $('#create_codigo').val("");
            JsBarcode("#barcode",0,{height:40});
        }else{
            $('#codigo_manual').prop('disabled',true);
            $('#codigo_manual').val('');
            codigoBarra();
        }      
    });

    $('#codigo_manual').on('change',function(){     
        JsBarcode("#barcode", $(this).val(),{height:40});
        $('#create_codigo').val($(this).val());
    });
});

$(document).on('click','.btn-delete',function(){
    var id = $(this).attr("id");
    var data= $(this).attr("value");
    var data2 = data.split('*');
    if (data2[2]==1) {
        document.getElementById("ti-cabeza").innerHTML="Eliminar";
        document.getElementById("g-delete").innerHTML="Eliminar";
        document.getElementById("titulo").innerHTML = "Está seguro de eliminar el producto?";
        document.getElementById("id-pro-delete").value=data2[0];
        document.getElementById("estado-pro-delete").value=data2[2];
    }  
});

$(document).on('click', '.edit_data', function(){   
    var id = $(this).attr("id");
    document.getElementById("id-pro-edit").value=id;
});

$("#btnGenerarActivos").click(function(){
    window.open(base_url+"mantenimiento/productos/getReporteActivos", "_blank");
});

$("#btnGenerarInactivos").click(function(){
    window.open(base_url+"mantenimiento/productos/getReporteInactivos", "_blank");
});

$("#btnElegirMarca").on("click", function(){
    valor = $("#elegirMarca").val();
    window.open(base_url+"mantenimiento/productos/getReporteMarca?valor="+valor, "_blank");
});

$("#btnElegirCategoria").on("click", function(){
    valor = $("#elegirCategoria").val();
    window.open(base_url+"mantenimiento/productos/getReporteCategoria?valor="+valor, "_blank");
});

$("#btnelegirStock").on("click", function(){
    valorCategoria = $("#elegirCategoriaStock").val();
    valorMarca = $("#elegirMarcaStock").val();
    window.open(base_url+"mantenimiento/productos/getReporteStock?valorCat="+valorCategoria+"&valorMar="+valorMarca, "_blank");
});