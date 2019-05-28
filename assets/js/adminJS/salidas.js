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
            url: base_url+"movimientos/entradas/getProductos",
            type: "POST",
            dataType: "json",
            data:{ autocompleteProducto: request.term},
            success: function(data){
                response($.map(data, function (item) {
                    return {
                        label: item.codigo + ' - ' + item.nombre+' - '+item.id_presentacion,
                        id: item.codigo+'*'+item.nombre+'*'+item.precio_compra+'*'+item.precio_venta+'*'+item.id_producto+'*'+item.id_presentacion+'*'+item.existencias,
                    }
                }))
            },
        });
    }, //indica la informacion a mostrar al momento de comenzar a llenar el campo
    minLength:2, //caracteres que activan el autocomplete
    select: function(event, ui){
       data = ui.item.id;
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
        html += "<td><input type='number' style='width:100px' placeholder='Ingrese numero entero' name='cantidades[]' values='0' min='1' max='"+inforProducto[6]+"' pattern='^[0-9]+' class='cantidades'></td>"; //cantidades
        html += "<td><input type='hidden'  name='importes[]' value='"+0+"'><p>"+0+"</p></td>"; //immportes
        html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-times' style='color: #fff'></span></button></td>";
        html += "</tr>";
        $("#tbCompras tbody").append(html);
        $('#btn-agregar-abast').val('');
        $('#autocompleteProducto').val(null);
        $('#procesar').prop('disabled',false);
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
//funcion para sumar el costo total
function sumarReabastecimiento(){
    total = 0;
    $("#tbCompras tbody tr").each(function(){

        total = total +  Number($(this).find("td:eq(4)").text());
    });
    total2 = parseFloat(total).toFixed(2);
    $("#total").val(total2);
    document.getElementById("sub_total").innerHTML=total.toFixed(2);
    document.getElementById("total_sub").innerHTML=total.toFixed(2);
    
}
//eliminar articulo
$(document).on("click", ".btn-remove-producto", function(){
    $(this).closest("tr").remove();
    contador = contador - 1;
    f=0;
    sumar();
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