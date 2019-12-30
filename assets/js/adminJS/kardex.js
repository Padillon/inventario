function validarFormulario(){
    total = 0;
    validar_cantidad = 0;
    validar_fecha = 0;
    $("#tbCompras tbody tr").each(function(){
        total++; // si total llega a ser mayor de 0 es porque hay datos en la tabla
        cantidades =Number($(this).find(".cantidades").val()); // revisamos en la columna que ningun valor sea 0
        valor_p_caducidad =Number($(this).find(".pedecedero").val()); //saber si se agrego un un producto perecedero
        fechaCaducidad =Number($(this).find(".fecha").val()); // validar que este lleno la fecha de caducidad 
        if (fechaCaducidad == 0 & valor_p_caducidad != 0) {
            toastr.warning("Ingrese una fecha de caducidad en la linea: "+total);
            validar_fecha = 1;
        }
        if ( cantidades == 0 ) {
            //alert("Ingrese una cantidad en la linea: "+total); // ************ Aqui iria el mensaje que ingrese cantidad de producto
            toastr.error("Ingrese una cantidad en la linea: "+total);
            validar_cantidad = 1;
        }
    });

     if($('#autocompleteProveedor').is(':hidden') == false & $('#idProveedor').val() == "" ){
        toastr.error("¡Ingrese el proveedor!");
    }else if($('#descripcion').val() == ""){
        toastr.error('Descripción requerida!');
        ;
    }
    else if ( total != 0 & validar_cantidad == 0  & validar_fecha == 0) {
        document.getElementById("movimiento_form").submit(); 
    }
}
var estado= 0;
//borrar el producto si ya ha sido seleccionado alguno
$(document).ready(function(){
	$("#autocompleteProducto2").keydown(function(event){
        if (event.which==8) {
            $("#autocompleteProducto2").val("");
            $("#btn-agregar-abast").val("");
            estado = 0;
        }
        if (event.which==13 & estado==1) {
            document.getElementById("btn-agregar-abast").click(); 

            estado = 0;
        }
        //alert( String.fromCharCode(event.which) + " es: " + event.which);

    }); 
    
	$("#autocompleteProducto2").keydown(function(event){

    if (event.which==13 & $('#autocompleteProducto2').is(":focus") == true) {
            //document.getElementById("btn-agregar-abast").click();
            $.ajax({
                url: base_url+"movimientos/kardex/getProductos",
                type: "POST",
                dataType: "json",
                data:{ autocompleteProducto: $('#autocompleteProducto2').val()},
                success: function(data){  
                    presen = $('#id_movimiento').val().split('*');
                    if (data == "") {
                        $('#autocompleteProducto').val('');      
                        toastr.info('Código no existe');                          

                    }else{
                        if (data.length > 1 & presen[1]==2) {
                            toastr.info('Verificar presentación','Verifique la presentación del producto códigos iguales o diferentes lotes');                          
                        }
                        fecha_caducidad = "";
                        cantidad ="";
                            if (data[0].caducidad != null) {
                                fecha_caducidad = " - "+data[0].caducidad;
                                cantidad = data[0].cantidad;
                            }else{
                                cantidad = data[0].existencias;
                            }

                        $("#btn-agregar-abast").val( data[0].codigo+'*'+data[0].nombre+'*'+data[0].precio_compra+'*'+data[0].precio_venta+'*'+data[0].id_producto+'*'+data[0].id_presentacion+'*'+data[0].existencias+'*'+data[0].perecedero+'*'+cantidad+'*'+data[0].lote+"*"+data[0].id_presentacion_producto+"*"+data[0].lt_cantidad); 
                        document.getElementById("btn-agregar-abast").click();
                        $('#autocompleteProducto').val('');                    
                    }
                },
            
            });
        }
    }); 
});
function movimientoModal(){
    $("#tbCompras tbody tr").each(function(){
        $(this).remove();
    });
}

//autocomplete para productos entrada
$("#autocompleteProducto").autocomplete({
    source: function(request, response){
        $.ajax({
            url: base_url+"movimientos/kardex/getProductos",
            type: "POST",
            dataType: "json",
            data:{ autocompleteProducto: request.term},
            success: function(data){
                response($.map(data, function (item) {
                    return {
                        label: item.codigo+" - "+item.id_presentacion+" - "+item.nombre+' - '+ item.id_marca,
                        id: item.id_producto+"*"+item.codigo+"*"+item.nombre+'*'+ item.id_marca+'*'+item.id_presentacion_producto,
                    }
                }))
            },
        });
    }, //indica la informacion a mostrar al momento de comenzar a llenar el campo
    minLength:2, //caracteres que activan el autocomplete
    select: function(event, ui){
       data = ui.item.id;
       valor = data.split("*");
       $.ajax({
             url: base_url+"movimientos/kardex/getKardexBuscar",
            type: "POST",
            dataType: "json",
            data:{ id: valor[0],fecha_inicio: $("#fecha_inicio").val(), fecha_final: $("#fecha_fin").val()},
            success: function(data){
             //   $("#tabla_kardex tr").remove();
                saldoK = Number(0);
                cont = 0;
            for(var i = 0; i < data.length; i+=1){
                if(data[i].tipo_transaccion == 1){
                    saldoK += Number(data[i].cantidad);
                } else {
                    saldoK -= Number(data[i].cantidad);
                }
                cont++;

                html = "<tr>";
                html += "<td>"+cont+"</td>";//id del producto
                html += "<td>"+data[i].fecha+"</td>";//id del producto
                html += "<td>"+data[i].movimiento+"</td>";//id del producto
                html += "<td>"+data[i].descripcion+"</td>";//id del producto
                html += "<td>"+data[i].usuario+"</td>";//id del producto
                html += "<td>"+data[i].cantidad+"</td>";//id del producto
                html += "<td>"+saldoK+"</td>";//id del producto
                html += "</tr>";
                $("#tabla_kardex tbody").append(html);
            }
            $('#autocompleteProducto').val(null);
            $("#txtProd").val(valor[1] + " " + valor[2] + " " + valor[3]);
            },
        });
    },
  });
//autocomplete para productos entrada
$("#autocompleteProducto2").autocomplete({
    source: function(request, response){
        $.ajax({
            url: base_url+"movimientos/kardex/getProductos",
            type: "POST",
            dataType: "json",
            data:{ autocompleteProducto: request.term},
            success: function(data){
                response($.map(data, function (item) {
                    fecha_caducidad = "";
                    cantidad ="";
                        if (item.caducidad != null) {
                            fecha_caducidad = " - "+item.caducidad;
                            cantidad = item.cantidad;
                        }else{
                            cantidad = item.existencias;
                        }
                    return {
                        label: item.codigo + ' - ' + item.nombre+' - '+item.marca+' - '+ item.id_presentacion+fecha_caducidad,
                        id: item.codigo+'*'+item.nombre+'*'+item.precio_compra+'*'+item.precio_venta+'*'+item.id_producto+'*'+item.id_presentacion+'*'+item.existencias+'*'+item.perecedero+'*'+cantidad+'*'+item.lote+"*"+item.id_presentacion_producto+"*"+item.lt_cantidad,
                    }
                }))
            },
        });
    }, //indica la informacion a mostrar al momento de comenzar a llenar el campo
    minLength:2, //caracteres que activan el autocomplete
    select: function(event, ui){
       data = ui.item.id;
       estado =1;
       $("#btn-agregar-abast").val(data); 
    },
  });

  $("#autocompleteProducto3").autocomplete({
    source: function(request, response){
        $.ajax({
            url: base_url+"movimientos/kardex/getProductos",
            type: "POST",
            dataType: "json",
            data:{ autocompleteProducto: request.term},
            success: function(data){
                response($.map(data, function (item) {
                    return {
                        label: item.codigo+" - "+item.id_presentacion+" - "+item.nombre+' - '+ item.id_marca,
                        id: item.id_producto+"*"+item.id_presentacion_producto,
                    }
                }))
            },
        });
    }, //indica la informacion a mostrar al momento de comenzar a llenar el campo
    minLength:2, //caracteres que activan el autocomplete
    select: function(event, ui){
       data = ui.item.id;
       data = data.split('*');
       $("#txtProducto").val(data[0]);
       $("#txtPresenProducto").val(data[1]);

    },
  });
  
  $("#btn-agregar-abast").on("click", function(){
    data = $(this).val();
    if (data != 0){
        infoProducto = data.split("*");
        $.ajax({
            url: base_url+"movimientos/entradas/getTipoPresentacion", //buscamos todas las presentaciones de dicho producto
            type: "POST",
            dataType: "json",
            data: {id_producto:infoProducto[4]},
            success: function(data){
                entrasalida = $('#id_movimiento').val().split('*');
                data_informacion_producto=""; //guardaremos una cadena de identificación del producto para comparar si ya existe.
                irrepetible = 0; //si es un producto que existe aumentar la cantidad

                html = "<tr>";
               // html += "<td><input type='hidden' name='idProductos[]' value='"+infoProducto[4]+"'>"+infoProducto[0]+"</td>";//id y codigo
                html += "<td><input type='hidden' name='idProductos[]' class='id_producto' value='"+infoProducto[4]+"'><input type='hidden' name='codigos[]' class='cod_class'  value='"+infoProducto[0]+"'><p class='cod_class'>"+infoProducto[0]+"</p></td>";//id y codigo

                html += "<td><p>"+infoProducto[1]+" "+infoProducto[5]+"</p></td>"; //nombre
                html += "<td><select name='tipo_presentacion[]' id='tipo_presentacion' class='custom-select '>";//recordar recortar select y td
                for (let i = 0; i < data.length; i++) {
                    if (data[i].id_presentacion_producto == infoProducto[10]) {
                        data_informacion_producto = data[i].id_presentacion_producto+"*"+data[i].codigo+"*"+data[i].venta+"*"+data[i].valor+"*"+data[i].existencias+"*"+infoProducto[9];
                        html+= "<option selected name='presentacion[]' value='"+data_informacion_producto+"'>"+data[i].nombre_pre+"</option>";

                }else{
                        html+= "<option name='presentacion[]' value='"+data[i].id_presentacion_producto+"*"+data[i].codigo+"*"+data[i].venta+"*"+data[i].valor+"*"+data[i].existencias+"*"+infoProducto[9]+"'>"+data[i].nombre_pre+"</option>";                 
                    }             
                }
                html += "<td><input style='width:100px' step='0.01'  min='0.00' type='number' pattern='^\d*(\.\d{0,2})?$' name='precio[]' value='0' class='precio' ></td>"; //precios
                if (infoProducto[7]==1) { //saber si es perecedero
                    html += "<td><input type='number' style='width:100px' placeholder='Ingrese una cantidad' id='numCantidades' name='cantidades[]' value='1' min='1' pattern='^[0-9]+' class='cantidades'><input type='hidden' name='estados[]' value = '"+infoProducto[7]+"' ><input type='hidden' name='lotes[]' value = '"+infoProducto[9]+"' ></td>"; //cantidades
                }else{
                    html += "<td><input type='number' style='width:100px' placeholder='Ingrese una cantidad' id='numCantidades'name='cantidades[]' value='1' min='1' pattern='^[0-9]+' class='cantidades'><input type='hidden' name='estados[]' value = '"+infoProducto[7]+"' ><input type='hidden' name='lotes[]' value = '"+infoProducto[9]+"' ></td>"; //cantidades
                }
                html += "<td><input type='hidden' id='importes' name='importes[]' value='"+0+"'><p>"+0+"</p></td>"; //immportes
                if ( entrasalida[1] == 1) {
                    if (infoProducto[7]==1) {
                        html += "<td><input name='fechaCaducidad[]' type='date' required class='form-control fecha' ><input type='hidden' class='pedecedero' value='"+infoProducto[7]+"'> </td>";
                    }else{
                        html += "<td><input name='fechaCaducidad[]'  type='hidden' required class='form-control fecha '><input type='hidden' class='pedecedero' value='"+infoProducto[7]+"'><p>- - - - - - -</p></td>";
                    }
                }else{
                    html += "<td><input name='fechaCaducidad[]'  type='hidden' required class='form-contro fecha'><input type='hidden' class='pedecedero' value='"+infoProducto[7]+"'><p>- - - - - - -</p></td>";
                   
                }
                html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-times' style='color: #fff'></span></button></td>";
                html += "</tr>";

                $("#tbCompras tbody tr").each(function(){ //funcion para aumentar la cantidad dependiendo el producto leido
                    cadena_caracteres = $(this).closest("tr").find("#tipo_presentacion").val();
                    if ( cadena_caracteres === data_informacion_producto) {
                        irrepetible = 1;
                        cant = Number($(this).closest("tr").find("#numCantidades").val()); // obtenemos la cantidad actual
                        $(this).closest("tr").find("#numCantidades").val(cant+1); //aumentamos el valor
                        // evaluamos que la cantidad no exeda la capacidad máxima y actualizamos los valores
                        cantidad =cant + 1;
                      //  max =Number($(this).closest("tr").find("#numCantidades").prop('max'));
                      //  if (cantidad > max) {
                        //    toastr.warning('¡Cantidad maxima disponible ' + max + ' !');
                        //    $(this).closest("tr").find("td:eq(4)").children('input').val(max);
                      //  }else{
                            precio = $(this).closest("tr").find("td:eq(3)").children("input").val();
                            importe = cantidad * precio;
                            totalImporte = parseFloat(importe).toFixed(2);
                            $(this).closest("tr").find("td:eq(5)").children("p").text(totalImporte);
                            $(this).closest("tr").find("td:eq(5)").children("input").val(totalImporte);
                            sumarReabastecimiento();
                      //  }                   
                    }
                });
                if (irrepetible == 0) {
                    $("#tbCompras tbody").append(html);   
                }
                $('#btn-agregar-abast').val('');
                $('#autocompleteProducto').val(null);
                $('#autocompleteProducto2').val(null);
            
            },
        });
    } else {
        toastr.info('Seleccione un roducto','Agregar');
    }
});
  function evaluar(){
   if( $("#kardex_producto").val()){
    $("#kardex_producto").val("");
    $("#autocompleteProducto2").val("");
   }
  }

  $("#btn-generar-producto").on("click", function(){
    $.ajax({
        url: base_url+"movimientos/kardex/getKardexProducto",
        type: "POST",
        dataType: "json",
        data:{"id":$("#btn-generar-producto").val(),"inicio":$("#fecha_inicio").val(),"fin":$("#fecha_final").val() },
        success: function(data){
             alert("si entra aqui");
            alert("todo bien todo correcto y yo que me alegro.")
        },
    });
});

//eliminar articulo
$(document).on("click", ".btn-remove-producto", function(){
    $(this).closest("tr").remove();
    contador = contador - 1;
    f=0;
    sumar();
});

$(document).on("click", ".btn-view-moviiento", function(){
    valor_id = $(this).val();
    $.ajax({
        url: base_url+"movimientos/kardex/view",
        type:"POST",
        dataType: "html",
        data:{id_entr:valor_id},
        success: function(data){
            $("#Modalview .modal-body").html(data);
        }
    });
});
$("#id_movimiento").on("change", function(){
   $("#tbCompras tbody tr").each(function(){
        $(this).remove();
    });
    //$('#autocompleteProveedor').is('hidden');
    $('#autocompleteCliente').val('')
    $('#autocompleteProveedor').val('')
    $('#idProveedor').val("");
    $('#idCliente').val("");
    
    entrasalida = $('#id_movimiento').val().split('*');
    if (entrasalida[1] == 2) {
        $('#autocompleteCliente').prop('type','hidden')
        $('#autocompleteProveedor').prop('type','text')
    }else{
        $('#autocompleteCliente').prop('type','text')
        $('#autocompleteProveedor').prop('type','hidden')
    }
  
});
$("#btnResumen").on("click", function(){
    fecha1 = $("#fecha1").val();
    fecha2 = $("#fecha2").val();
    prod = $("#txtProducto").val();
    pres = $("#txtPresenProducto").val();

    window.open(base_url+"movimientos/kardex/getProductoKardex?fecha1="+fecha1+"&fecha2="+fecha2+"&pres="+pres+"&prod="+prod, "_blank");
});
function myRoundCero(num) {
    var exp = Math.pow(10, 0); // 2 decimales por defecto
    return parseInt(num * exp, 10) / exp;
  }
  function sumarReabastecimiento(){
    total = 0;
    $("#tbCompras tbody tr").each(function(){
        total = total +  Number($(this).find("#importes").val());
    });
    total2 = parseFloat(total).toFixed(2);
    $("#total").val(total2);
    document.getElementById("total_sub").innerHTML='$ '+total.toFixed(2);
    
}
$(document).on("input", "#tbCompras input.cantidades", function(){ // escuchamos cuando ingresen cantidades
    cantidad = $(this).val();
    precio = $(this).closest("tr").find(".precio").val();
    importe = cantidad * precio;
    totalImporte = parseFloat(importe).toFixed(2);
    $(this).closest("tr").find("#importes").val(totalImporte);
    $(this).closest("tr").find("td:eq(5)").children("p").text(totalImporte);
    sumarReabastecimiento();
});
$(document).on("input", "#tbCompras input.precio", function(){ // escuchamos cuando ingresen su precio
    precio = $(this).val();
    cantidad = $(this).closest("tr").find(".cantidades").val();
    importe = cantidad * precio;
    totalImporte = parseFloat(importe).toFixed(2);
    $(this).closest("tr").find("#importes").val(totalImporte);
    $(this).closest("tr").find("td:eq(5)").children("p").text(totalImporte);
    sumarReabastecimiento();
});

$("#autocompleteProveedor").autocomplete({
    source: function(request, response){
        $.ajax({
            url: base_url+"movimientos/entradas/getProveedores",
            type: "POST",
            dataType: "json",
            data:{ valorProveedor: request.term},
            success: function(data){
                response($.map(data, function(item){
                    return {
                        label: item.nombre + " - " + item.label,
                        id: item.id_proveedor,
                    }
                }));
            }
        });
    }, //indica la informacion a mostrar al momento de comenzar a llenar el campo
    minLength:2, //caracteres que activan el autocomplete
    select: function(event, ui){
        data = ui.item.id;
        $("#idProveedor").val(data);
    },
  });

  $("#autocompleteCliente").autocomplete({
    source: function(request, response){
        $.ajax({
            url: base_url+"movimientos/salidas/getClientes",
            type: "POST",
            dataType: "json",
            data:{ valorCliente: request.term},
            success: function(data){
                response($.map(data, function(item){
                    return {
                        label: item.label + " "+ item.apellido,
                        id: item.id_cliente,
                    }
                }));
            }
        });
    }, //indica la informacion a mostrar al momento de comenzar a llenar el campo
    minLength:2, //caracteres que activan el autocomplete
    select: function(event, ui){
        data = ui.item.id;
        $("#idCliente").val(data);
    },
  });