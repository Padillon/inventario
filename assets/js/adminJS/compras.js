$("#keyupProveedor").autocomplete({ //autocomplete del proveedor
    source: function(request, response){
        $.ajax({
            url: base_url+"movimientos/compras/getProveedores",
            type: "POST",
            dataType: "json",
            data:{ empresa: request.term},
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

$("#producto-reabastecer").autocomplete({ //autocomplete del producto
    source: function(request, response){
        $.ajax({
            url: base_url+"movimientos/compras/getProductos",
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
