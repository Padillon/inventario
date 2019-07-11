
//codigo de buarra generador

var marca = document.getElementById('create_marca');
var categoria = document.getElementById('create_categoria');
marca.addEventListener('change',
  function(){
    var marcaOption = this.options[marca.selectedIndex];
    var categoriaOption = this.options[categoria.selectedIndex];
      $.ajax({  
        url: base_url+"mantenimiento/productos/getSerie",
        type: "POST",
        dataType: "json",
        data:{ marca: marcaOption.value, categoria: categoriaOption.value},
        success: function(data){
            var serie = data[0].cuenta;
            serie++;
              //fragmento marca
            var long_marca = marcaOption.value.length ; // conseguimos la longitud de marca
            var marca_cod = "";
            if(long_marca <= 1){
                marca_cod = "000"+marcaOption.value;
            }else if(long_marca <= 2){
                marca_cod = "00"+marcaOption.value;
            }else if(long_marca <= 3){
                marca_cod = "0"+marcaOption.value;
            }else{
                marca_cod = marcaOption.value;
            }
            // fragmento categoria
            var long_marca = categoriaOption.value.length ; // conseguimos la longitud de marca
            var categoria_cod = "";
            if(long_marca <= 1){
                categoria_cod = "000"+categoriaOption.value;
            }else if(long_marca <= 2){
                categoria_cod = "00"+categoriaOption.value;
            }else if(long_marca <= 3){
                categoria_cod = "0"+categoriaOption.value;
            }else{
                categoria_cod = categoriaOption.value;
            }
            
            //fragmento serie
            var long_serie = serie.length; // conseguimos la longitud de marca
            var serie_cod = "";
            
            if(serie <= 9){
                serie_cod = "000"+serie;
            }else if(serie <= 99){
                serie_cod = "00"+serie;
            }else if(serie <= 999){
                serie_cod = "0"+serie;
            }else{
                serie_cod = serie;
            }
            JsBarcode("#barcode", String(marca_cod)+String(categoria_cod)+String(serie_cod));
        },
    });

  });


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
    $("#viewStock_actual").val(datos[14]);
    $("#viewCompra").val("$ "+datos[7]);
    $("#viewVenta").val("$ "+datos[8]);
    $("#viewPresentacion").val(datos[11]);
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
    $('input[type="checkbox"]').on('change', function(e){
        var val = $(this).attr("value"); 
        if(val!=0){
            $('#create_perecedero').val('1');
        }else{
        $('#create_perecedero').val('0');
        }
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