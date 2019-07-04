

function movimientoModal(){
    document.getElementById("movimiento_form").reset(); 
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
                        label: item.codigo+" - "+item.nombre+' - '+ item.id_marca,
                        id: item.id_producto,
                    }
                }))
            },
        });
    }, //indica la informacion a mostrar al momento de comenzar a llenar el campo
    minLength:2, //caracteres que activan el autocomplete
    select: function(event, ui){
       data = ui.item.id;
       $.ajax({
             url: base_url+"movimientos/kardex/getProductoKardex",
            type: "POST",
            dataType: "json",
            data:{ id: data,fecha_inicio: $("#fecha_inicio").val(), fecha_final: $("#fecha_fin").val()},
            success: function(data){
                $("#table_of_items tr").remove(); 
            for(var i = 0; i < data.length; i+=1){
            // AQUÍ IRIA LO DEL PDF KONNY ******************
                html = "<tr>";
                html += "<td>"+data[i].id_kardex+"</td>";//id del producto
                html += "<td>"+data[i].fecha+"</td>";//id del producto
                html += "<td>"+data[i].precio+"</td>";//id del producto
                html += "<td>"+data[i].cantidad+"</td>";//id del producto
                html += "<td>"+data[i].total+"</td>";//id del producto
                html += "</tr>";
                $("#tabla_kardex tbody").append(html);
            }
            $('#autocompleteProducto').val(null);
            },
        });
    },
  });
  
  $("#autocompleteProducto2").autocomplete({
    source: function(request, response){
        $.ajax({
            url: base_url+"movimientos/kardex/getProductos",
            type: "POST",
            dataType: "json",
            data:{ autocompleteProducto: request.term},
            success: function(data){
                response($.map(data, function (item) {
                    return {
                        label: item.codigo+" - "+item.nombre+' - '+ item.id_marca,
                        id:item.id_producto,
                    }
                }))
            },
        });
    }, //indica la informacion a mostrar al momento de comenzar a llenar el campo
    minLength:2, //caracteres que activan el autocomplete
    select: function(event, ui){
       data = ui.item.id;
       $("#btn-generar-producto").val(data); 
    },
  });

  
  $("#btn-agregar-abast").on("click", function(){
    data = $(this).val();
    if (data != 0){
        infoProducto = data.split("*");
        html = "<tr>";
        html += "<td><input type='hidden' name='idProductos[]' value='"+infoProducto[4]+"'>"+infoProducto[0]+"</td>";//id y codigo
        html += "<td><p>"+infoProducto[1]+" "+infoProducto[5]+"</p></td>"; //nombre
        if(infoProducto[6] == '0'){
            html += "<td><input type='number' style='width:100px' placeholder='Ingrese numero entero' name='cantidades2[]' values='0' min='1' pattern='^[0-9]+' class='cantidades' required></td>"; //cantidades
        } else{
            html += "<td><input type='number' style='width:100px' placeholder='Ingrese numero entero' name='cantidades[]' values='0' max='"+infoProducto[6]+"' min='1' pattern='^[0-9]+' class='cantidades' required></td>"; //cantidades
        }
        html += "<td><input style='width:100px' step='0.01'  min='0.00' type='number' pattern='^\d*(\.\d{0,2})?$' name='nuevoPrecio[]' class='precio-entrada ' value='"+infoProducto[2]+"'></td>"; //precios    
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
