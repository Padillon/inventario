
//Validar formulario
$('#fecha').datepicker({}); //calendario mas chingon 
function validarFormulario(){
    total2 = 0;
    validar_cantidad = 0;
    $("#tbCompras tbody tr").each(function(){
        total2++;
        cantidades =Number($(this).find("td:eq(3)").children('input').val());
        if ( cantidades == 0 ) {
            alert("Ingrese una cantidad en la linea: "+total2);
            validar_cantidad = 1;
        }
    });
    if (total2 != 0 & validar_cantidad == 0) {

        document.getElementById("FormSalida").submit(); s
    }else if(validar_cantidad!=1){
        alert("¡Ingrese los dato necesarios!");
    }
}
var estado= 0;
//borrar el producto si ya ha sido seleccionado alguno
$(document).ready(function(){
	$("#autocompleteProducto").keydown(function(event){
        if (event.which==8) {
            $("#autocompleteProducto").val("");
            $("#btn-agregar-abast").val("");
            estado = 0;
        }
        if (event.which==13 & estado==1) {
            document.getElementById("btn-agregar-abast").click();     
            estado = 0;
        }
        //alert( String.fromCharCode(event.which) + " es: " + event.which);

	}); 
});
//numero de serie correlativo *************************************************************
//serie_numero();
function serie_numero(){
   //var x = document.getElementById("mySelect").value;
    var valor = document.getElementById('create_comprobante').value;
    alert(valor);
    var valores = valor.split('*');
    $('#serie').val(Number(valores[1])+1);
    $('#numero').val(Number(valores[2])+1);
    $('#id_conprobante').val(Number(valores[0]));
}


//autocomplete para productos entrada *************************************************************
$("#autocompleteProducto").autocomplete({
    source: function(request, response){
        //alert('ahora si');
        $.ajax({
            url: base_url+"movimientos/salidas/getProductos",
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
                        label: item.codigo + ' - ' + item.nombre+' - '+item.id_presentacion+fecha_caducidad+' - '+cantidad,
                        id: item.codigo+'*'+item.nombre+'*'+item.precio_compra+'*'+item.precio_venta+'*'+item.id_producto+'*'+item.id_presentacion+'*'+item.existencias+'*'+item.perecedero+'*'+cantidad+'*'+item.lote,
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


//agregar producto a vender *************************************************************
$("#btn-agregar-abast").on("click", function(){
    data = $(this).val();
    if (data != 0){
        infoProducto = data.split("*");
        html = "<tr>";
        html += "<td><input type='hidden' name='idProductos[]' value='"+infoProducto[4]+"'>"+infoProducto[0]+"</td>";//id y codigo
        html += "<td><p>"+infoProducto[1]+" "+infoProducto[5]+"</p></td>"; //nombre
        html += "<td><input style='width:100px' step='0.01'  min='0.00' type='number' pattern='^\d*(\.\d{0,2})?$' name='precioVenta[]' class='precio-salida' value='"+infoProducto[3]+"'></td>"; //precios
        if (infoProducto[7]==1) {
            html += "<td><input type='hidden' name='estados[]' value = '"+infoProducto[7]+"' ><input type='hidden' name='lotes[]' value = '"+infoProducto[9]+"' ><input type='number' style='width:100px' placeholder='Ingrese una cantidad' name='cantidades[]' values='0' min='1' max='"+infoProducto[8]+"' pattern='^[0-9]+' class='cantidades'></td>"; //cantidades
        }else{
            html += "<td><input type='hidden' name='estados[]' value = '"+infoProducto[7]+"' ><input type='hidden' name='lotes[]' value = '"+infoProducto[9]+"' ><input type='number' style='width:100px' placeholder='Ingrese una cantidad' name='cantidades[]' values='0' min='1' max='"+infoProducto[6]+"' pattern='^[0-9]+' class='cantidades'></td>"; //cantidades
        }
        html += "<td><input type='hidden'  name='importes[]' value='"+0+"'><p>"+0+"</p></td>"; //immportes
        html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-times' style='color: #fff'></span></button></td>";
        html += "</tr>";
        $("#tbCompras tbody").append(html);
        $('#btn-agregar-abast').val('');
        $('#autocompleteProducto').val(null);
    } else {
        alert("seleccione un producto");
    }
});

//procesamiento al ingresar otra cantidad de compra
$(document).on("input", "#tbCompras input.precio-salida", function(){
    pre_compra = $(this).val();
    cant = $(this).closest("tr").find("td:eq(3)").children("input").val();
    importe = pre_compra * cant;
    totalImporte = parseFloat(importe).toFixed(2);
    $(this).closest("tr").find("td:eq(4)").children("p").text(totalImporte);
    $(this).closest("tr").find("td:eq(4)").children("input").val(totalImporte);
    sumarReabastecimiento();
});
//procedimiento al ingresar cantidades
$(document).on("input", "#tbCompras input.cantidades", function(){
    cantidad = $(this).val();
    precio = $(this).closest("tr").find("td:eq(2)").children("input").val();
    importe = cantidad * precio;
    totalImporte = parseFloat(importe).toFixed(2);
    $(this).closest("tr").find("td:eq(4)").children("p").text(totalImporte);
    $(this).closest("tr").find("td:eq(4)").children("input").val(totalImporte);
    sumarReabastecimiento();
});
//eliminar articulo
$(document).on("click", ".btn-remove-producto", function(){
    $(this).closest("tr").remove();
    sumarReabastecimiento();
});
//anular venta
$(document).on('click', '.eliminar_data', function(){   
    var id = $(this).attr("id");
    document.getElementById("id-salida-delete").value=id;
});

$(document).on("click", ".btn-view-salida", function(){
    valor_id = $(this).val();
    $.ajax({
        url: base_url+"movimientos/salidas/view",
        type:"POST",
        dataType: "html",
        data:{id:valor_id},
        success: function(data){
            $("#modalView .modal-body").html(data);
        }
    });
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

  //funcion para sumar el costo total
function sumarReabastecimiento(){
    total = 0;
    $("#tbCompras tbody tr").each(function(){

        total = total +  Number($(this).find("td:eq(4)").text());
    });
    total2 = parseFloat(total).toFixed(2);
    $("#total").val(total2);
    document.getElementById("total_sub").innerHTML=total.toFixed(2);
}

$("#btnGenerarInactivos").click(function(){
    window.open(base_url+"movimientos/salidas/getReporteInactivos", "_blank");
});

$("#btnelegirFecha").on("click", function(){
    fecha1 = $("#fecha1").val();
    fecha2 = $("#fecha2").val();
    window.open(base_url+"movimientos/salidas/getReporteFecha?fecha1="+fecha1+"&fecha2="+fecha2, "_blank");
});

$("#btnelegirCliente").on("click", function(){
    fecha1 = $("#fecha1Cli").val();
    fecha2 = $("#fecha2Cli").val();
    cli = $("#txtElegirCliente").val();
    window.open(base_url+"movimientos/salidas/getReporteCliente?fecha1="+fecha1+"&fecha2="+fecha2+"&cli="+cli, "_blank");
});

$("#btnResumen").on("click", function(){
    fecha1 = $("#fecha1Res").val();
    fecha2 = $("#fecha2Res").val();
    window.open(base_url+"movimientos/salidas/getResumen?fecha1="+fecha1+"&fecha2="+fecha2, "_blank");
});