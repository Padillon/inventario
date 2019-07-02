
// ****************************** VALIDACIONES PROVEEDOR Y ENVIAR FORMULARIO VACÍO Y CATIDADES 0 ******************************

function validarFormulario(){
    total = 0;
    validar_cantidad = 0;
    $("#tbCompras tbody tr").each(function(){
        total++; // si total llega a ser mayor de 0 es porque hay datos en la tabla
        cantidades =Number($(this).find("td:eq(4)").children('input').val()); // revisamos en la columna que ningun valor sea 0
        if ( cantidades == 0 ) {
            alert("Ingrese una cantidad en la linea: "+total); // ************ Aqui iria el mensaje que ingrese cantidad de producto
            validar_cantidad = 1;
        }
    });
    if ($("#idProveedor").val() != "" & total != 0 & validar_cantidad == 0 ) {
        document.getElementById("FormCompra").submit(); s
    }else if(validar_cantidad!=1){
        alert("¡Ingrese los dato necesarios!"); // ************ Aqui iria tu modal konny
    }
}

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
//borrar proveedor si hay alguno seleccionado
$(document).ready(function(){
	$("#autocompleteProveedor").keydown(function(event){
        if (event.which==8) {
            $("#autocompleteProveedor").val("");
            $("#idProveedor").val(null);
        }
	}); 
});

// ****************************** PARTE LÓGICA ******************************

//Autocomplete proveedores
var estado= 0;
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

//autocomplete para productos entrada
$("#autocompleteProducto").autocomplete({
  source: function(request, response){
      $.ajax({
          url: base_url+"movimientos/entradas/getProductos",
          type: "POST",
          dataType: "json",
          data:{ autocompleteProducto: request.term},
          success: function(data){
              response($.map(data, function (item) {
                  return {
                      label: item.codigo+" - "+item.nombre+' - '+ item.id_marca,
                      id: item.codigo+'*'+item.nombre+'*'+item.precio_compra+'*'+item.precio_venta+'*'+item.id_producto+'*'+item.id_presentacion,
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

//funcion para agregar el producto a comprar.
$("#btn-agregar-abast").on("click", function(){
    data = $(this).val();
    if (data != 0){
        infoProducto = data.split("*");
        html = "<tr>";
        html += "<td><input type='hidden' name='idProductos[]' value='"+infoProducto[4]+"'>"+infoProducto[0]+"</td>";//id y codigo
        html += "<td><p>"+infoProducto[1]+" "+infoProducto[5]+"</p></td>"; //nombre
        html += "<td><input style='width:100px' step='0.01'  min='0.00' type='number' pattern='^\d*(\.\d{0,2})?$' name='nuevoPrecio[]' class='precio-entrada' value='"+infoProducto[2]+"' required></td>"; //precios
        html += "<td><input style='width:100px' step='0.01'  min='0.00' type='number' pattern='^\d*(\.\d{0,2})?$' name='precioSalida[]' value='"+infoProducto[3]+"' required'></td>";//precio salida
        html += "<td><input type='number' style='width:100px' placeholder='Ingrese una cantidad' name='cantidades[]' values='0' min='1' pattern='^[0-9]+' class='cantidades' required></td>"; //cantidades
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
$(document).on("input", "#tbCompras input.precio-entrada", function(){
    pre_compra = $(this).val();
    cant = $(this).closest("tr").find("td:eq(4)").children("input").val();
    importe = pre_compra * cant;
    totalImporte = parseFloat(importe).toFixed(2);
    $(this).closest("tr").find("td:eq(5)").children("p").text(totalImporte);
    $(this).closest("tr").find("td:eq(5)").children("input").val(totalImporte);
    sumarReabastecimiento();
});
//procedimiento al ingresar cantidades
$(document).on("input", "#tbCompras input.cantidades", function(){
    cantidad = $(this).val();
    precio = $(this).closest("tr").find("td:eq(2)").children("input").val();
    importe = cantidad * precio;
    totalImporte = parseFloat(importe).toFixed(2);
    $(this).closest("tr").find("td:eq(5)").children("p").text(totalImporte);
    $(this).closest("tr").find("td:eq(5)").children("input").val(totalImporte);
    sumarReabastecimiento();
});
//eliminar articulo
$(document).on("click", ".btn-remove-producto", function(){
   $(this).closest("tr").remove();
    sumarReabastecimiento();
});
//anular compra
$(document).on('click', '.eliminar_data', function(){   
    var id = $(this).attr("id");
    document.getElementById("id-entrada-delete").value=id;
});

$(document).on("click", ".btn-view-entrada", function(){
    valor_id = $(this).val();
    $.ajax({
        url: base_url+"movimientos/entradas/view",
        type:"POST",
        dataType: "html",
        data:{id_entr:valor_id},
        success: function(data){
            $("#Modalview .modal-body").html(data);
        }
    });
});

//funcion para sumar el costo total
function sumarReabastecimiento(){
    total = 0;
    $("#tbCompras tbody tr").each(function(){

        total = total +  Number($(this).find("td:eq(5)").text());
        
    });
    total2 = parseFloat(total).toFixed(2);
    $("#total").val(total2);
    document.getElementById("total_sub").innerHTML=total.toFixed(2);
    
}