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
$("#producto-reabastecer").autocomplete({
  source: function(request, response){
      $.ajax({
          url: base_url+"movimientos/entradas/getProductos",
          type: "POST",
          dataType: "json",
          data:{ valor: request.term},
          success: function(data){
              response($.map(data, function (item) {
                  return {
                      label: item.nombre + " " + item.tipo_presentacion,
                      id: item.id +"*" + item.codigo + "*" + item.nombre + "*" + item.precio_entrada + 
                              "*" + item.stock+ "*"+item.tipo_presentacion
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

