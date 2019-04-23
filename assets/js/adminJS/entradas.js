//Autocomplete proveedores
$("#autocompleteProveedor").autocomplete({
  source: function(request, response){
      $.ajax({
          url: base_url+"movimientos/entradas/getProveedores",
          type: "POST",
          dataType: "json",
          data:{ valorProveedor: request.term},
          success: function(data){
              response(data);
          }
      });
  }, //indica la informacion a mostrar al momento de comenzar a llenar el campo
  minLength:2, //caracteres que activan el autocomplete
  select: function(event, ui){
      data = ui.item.id_proveedor + "*" + ui.item.label;
      infoProveedor = data.split("*");
      $("#idProveedor").val(infoProveedor[0]);
  },
});

//autocomplete para productos entrada
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
                      label: item.nombre+' '+item.id_categoria,
                      id: item.codigo+'*'+item.nombre+'*'+item.precio_compra+'*'+item.precio_venta+'*'+item.id_producto+'*'+item.id_categoria,
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
//funcion para agregar el producto a comprar.
$("#btn-agregar-abast").on("click", function(){
    data = $(this).val();
    if (data != 0){
        infoProducto = data.split("*");
        html = "<tr>";
        html += "<td><input type='hidden' name='idProductos[]' value='"+infoProducto[4]+"'>"+infoProducto[0]+"</td>";//id y codigo
        html += "<td><p>"+infoProducto[1]+" "+infoProducto[5]+"</p></td>"; //nombre
        html += "<td><input style='width:100px' step='0.01'  min='0.00' type='number' pattern='^\d*(\.\d{0,2})?$' name='nuevoPrecio[]' class='precio-entrada ' value='"+infoProducto[2]+"'></td>"; //precios
        html += "<td><input style='width:100px' step='0.01'  min='0.00' type='number' pattern='^\d*(\.\d{0,2})?$' name='precioSalida[]' value='"+infoProducto[3]+"'> </td>";//precio salida
        html += "<td><input type='number' style='width:100px' placeholder='Ingrese numero entero' name='cantidades[]' values='0' min='1' pattern='^[0-9]+' class='cantidades'></td>"; //cantidades
        html += "<td><input type='hidden' align='center' name='importes[]' value='"+0+"'><p>"+0+"</p></td>"; //immportes
        html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-times' style='color: #fff'></span></button></td>";
        html += "</tr>";
        $("#tbCompras tbody").append(html);
        $('#btn-agregar-abast').val('');
        $('#autocompleteProducto').val('');
        $('#autocompleteProducto').prop('id','');

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
//funcion para sumar
function sumarReabastecimiento(){
    total = 0;
    $("tbTotal tbody tr").each(function(){
        total = total + Number($(this).find("td:eq(5)").text());
    });
    $("#total-reabastecer").val(total.toFixed(2));
}
//eliminar comprado
$(document).on("click", ".btn-remove-producto", function(){
    $(this).closest("tr").remove();
    contador = contador - 1;
    f=0;
    sumar();
});