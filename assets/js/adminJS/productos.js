
//codigo de barra
//codigo de buarra generador
    function codigoBarra(){
        var marcaOption = marca.options[marca.selectedIndex];
        var categoriaOption = categoria.options[categoria.selectedIndex];
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
                cod_generado = String(marca_cod)+String(categoria_cod)+String(serie_cod);
                JsBarcode("#barcode", cod_generado,{height:35});
                $('#create_codigo').val(cod_generado);  
                $('#codigo_manual').val(cod_generado);

            },
        });
    }
var producto_existente=undefined;
var cod_existente=undefined;
var codBarra_existente=undefined;
var codBarra_existente2=undefined;
//validamos formilario
function validarFormulario(){
    validar = 0;
   // if (producto_existente != "" || codBarra_existente != "" || codBarra_existente2 != "" || cod_existente == "") {
    if ($('#create_nombre').val() == "") {
        toastr.warning('Ingrese un nombre.');
        validar == 1;
    }else if(producto_existente != undefined || codBarra_existente != undefined || codBarra_existente2 != undefined || cod_existente != undefined){
        toastr.warning('Nombre o código ya existente.');
        validar == 1;
    }else if(validar == 0){
        document.getElementById("formularioAgregar").submit();
     //   alert('se va');
    }
}

if($('#create_perecedero').val() > 0){
    $("#create_perecedero").prop('checked', true);
}
if($('#activar_cod_manual').val() > 0){
    $("#activar_cod_manual").prop('checked', true);
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
            }else{
                cod_existente = undefined;
            }
        },
    });
});
$('#cod_barra_presentacion').keyup(function(){
      
    $.ajax({
        url: base_url+"mantenimiento/productos/getExistenteCod",
        type: "POST",
        dataType: "json",
        data:{ getExistente: $('#cod_barra_presentacion').val()},
        success: function(data){
            if (data != null) {
                codBarra_existente = data.codigo;
                codBarra_existente2 = true;       
            }else{
                codBarra_existente = undefined;
                codBarra_existente2 = undefined;
            }
        },
    });
    $("#listaPresentaciones tbody tr").each(function(){
        if ($("#cod_barra_presentacion").val() ==  $(this).find(".codBar").val()) {
            codBarra_existente2 = true;           
        }   
    });
    
});


$("#nombre_autocomplete").keydown(function(event){
    if (event.which==8) {
    //    $("#nombre_autocomplete").val("");
        $("#btnAgregar").val("");
        $("#codigo_autocomplete").val("");
    //    $('#codigo_id').val("");

    }
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
                
            }else{
                producto_existente = undefined;
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
jQuery.validator.addMethod("codEBarra",
function(value, element) {
    if (value == codBarra_existente || codBarra_existente2 == true){     
        return false;
    } else {
        return true;
    }
    
    }
    
    ,
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
        },
        cod_barra_presentacion:{
            codEBarra: '#cod_barra_presentacion'
        }

    },
});



function viewProducto(num){
    valores = $("#viewPro"+num).val();
    datos = valores.split("*");
    stock_actual = datos[11];
    total = 0;
    equi = Number(datos[12]);
    $("#viewCodigo").val(datos[4]);
    $("#viewNombre").val(datos[1]);
    $("#viewDescripcion").val(datos[5]);
    if (datos[4] != 0) {
        $("#viewStock").val(datos[4]/equi);
    }else{
        $("#viewStock").val(0);
    }
    
    $("#viewCompra").val("$ "+datos[13]);
    $("#viewVenta").val("$ "+datos[14]);
    alert(stock_actual + '   ' + equi);
    if (stock_actual != 0) {
        total = Math.floor(stock_actual / equi);
    }

    $("#selectEqui").val(datos[8]);
    $("#viewStock_actual").val(total);

    $("#viewMarca").val(datos[10]);
    $("#viewCategoria").val(datos[3]);
    if (datos[9] != 1) {
        $("#create_perecedero").prop('checked', false);
        $("#create_perecedero").val('0');
    }else{
        $("#create_perecedero").prop('checked', true);
        $("#create_perecedero").val('1 ');
    }
    $("#viewImagen").attr("src", base_url+"assets/images/productos/"+datos[6]);
    
    if (datos[2] = 1){
        $("#viewEstado").addClass("form-control alert alert-success");
        $("#viewEstado").val("Activo");
    } else{
        $("#viewEstado").addClass("form-control alert alert-danger");
        $("#viewEstado").val("Inactivo");
    }
    
}
function eliminar_presentacion(){
    $("#myTabContent tbody tr").each(function(){
        $(this).remove();
    });
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
         alert($("#data_id").val()); 
         if ($("#data_id").val() == undefined ) { ///evaluamos que no exista ide de producto para saber que es edición
            if( $("#activar_cod_manual").prop('checked')){
                codigoBarra();
                eliminar_presentacion();
                $('#codigo_manual').val('');
                $('#codigo_manual').prop('disabled',false);
                $('#create_codigo').val("");
                $('#cod_barra_presentacion').val("");
                $('#cod_barra_presentacion').prop('disabled',true);
               
            }else{
                codBarra_existente=undefined;
                codBarra_existente2=undefined;
                $('#codigo_manual').prop('disabled',true);
                $('#codigo_manual').val('');
                JsBarcode("#barcode", 0,{height:35});
                $('#cod_barra_presentacion').prop('disabled',false);
                eliminar_presentacion();
               
            }     
         }
    });
    //escuchar los cambios del código ingresado
    $('#codigo_manual').on('change',function(){    
        if ($(this).val()=="") {
            codigoBarra();
        }else{
            JsBarcode("#barcode", $(this).val(),{height:40});
            $('#create_codigo').val($(this).val());
        }
    });
});
//accion a la hora de eliminar un producto
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

// ******************* Presentación *************** //
/*$("#nombre_autocomplete").autocomplete({
    source: function(request, response){
        $.ajax({
            url: base_url+"mantenimiento/productos/getPresentacion",
            type: "POST",
            dataType: "json",
            data:{ nombre: request.term},
            success: function(data){
                response($.map(data, function (item) {
                    return {
                        label: item.nombre,
                        id:item.id_presentacion+'*'+item.nombre,
                    }
                }))
            },
        });
    }, //indica la informacion a mostrar al momento de comenzar a llenar el campo
    minLength:1, //caracteres que activan el autocomplete
    select: function(event, ui){
       data = ui.item.id;
       info = data.split("*");

       $("#btnAgregar").val(data);
      // $("#codigo_id").val(info[0]);
    },
  });
*/
  
$("#btnAgregar").on("click",function(){
    existente = 0;
    codigo = 0;
    precio_compra= 0;
    precio_venta = 0;
    cantidad= 0;
    otras_cantidaes= 0;
    data = $("#create_presentacion").val().split('*');
    codigo_barra = $("#cod_barra_presentacion").val();
    //obtenermos el valor y verificamos que contengan un valor
    precio_compra = $("#precio_compra").val();
    precio_venta = $("#precio_venta").val();
    cantidad = $("#cantidad_presentacion").val();

    //verificamos si la presentacion  ingresada ya se encuentra en la lista.
    $("#listaPresentaciones tbody tr").each(function(){
        if (data[0] ==  $(this).find(".id_producto").val()) {
            existente = 1;
        }   
    });
    //verificamos que todos los productos tengan su código
    if ($("#activar_cod_manual").prop('checked')==false ) {
        if (codigo_barra== "") {
            toastr.warning('Ingrese un código.');
            codigo = 1;
        }else if(existente==1){
   
            toastr.warning('Ya existe esta presentación!');
    
    
        }else if ( codBarra_existente2 != undefined || codBarra_existente != undefined ) {
            toastr.warning('Código de producto ya existe');
            
        }else if (cantidad<=0 || cantidad == "" || precio_venta == "" ||  precio_compra =="") {
            toastr.warning('Ingrese correctamente las cantidades y precio');
            otras_cantidaes= 1;
        }
    }else{
        codigo_barra=$("#codigo_manual").val();    
    }


   if (data != 0 & existente == 0  & otras_cantidaes==0 & codigo==0  & codBarra_existente2==undefined & codBarra_existente == undefined){
       infoCuenta = data;
        var html="";
        html += "<tr>";
        html += "<td class='col-md-2 '><input type='hidden' name='id_presentacion[]' class='form-control id_producto' value='"+infoCuenta[0]+"' >"+infoCuenta[0]+"</td>";
        html += "<td class='col-md-2 '>"+infoCuenta[1]+"</td>";
        html += "<td class='col-md-2 '><input type='hidden'  name='codigos_de_barra[]' class='form-control codBar' value='"+codigo_barra+"'><input class='form-control codBarEdit' disabled value='"+codigo_barra+"'></td>";
        html += "<td class='col-md-2 '><input type='hidden'  name='cantidad_prese[]' class='form-control' value='"+cantidad+"' >"+cantidad+"</td>";
        html += "<td class='col-md-2 '><input type='hidden'  name='precio_compra[]' class='form-control' value='"+precio_compra+"' >"+precio_compra+"</td>";
        html += "<td class='col-md-2 '><input type='hidden'  name='precio_venta[]' class='form-control' value='"+precio_venta+"' >"+precio_venta+"</td>";
        html += "<td class='col-md-2 '><button type='button' class='btn btn-danger  btn-remove-presentacion'>Eliminar  <span class='fa fa-times' style='color: #fff'></span></button></td>";    
        html += "</tr>";
        $("#listaPresentaciones tbody").append(html);

        var option = document.createElement("option");
        option.text = infoCuenta[1];
        option.value = infoCuenta[0];
        var select = document.getElementById("presentaciones");
        select.appendChild(option);

        $("#btnAgregar").val(null);
        $("#precio_compra").val(0);         
        $("#precio_venta").val(0);
        $("#cantidad_presentacion").val("");
        $("#nombre_autocomplete").val(null);
        $("#codigo_autocomplete").val(null);
        $("#cod_barra_presentacion").val(null);
       // $("#codigo_id").val(null);
    }


});

$(document).on("click", ".btn-remove-presentacion", function(){
    index = $(this).closest("tr").index();
    x = document.getElementById("presentaciones");
    x.options.remove(index); 

    $(this).closest("tr").remove();
});
