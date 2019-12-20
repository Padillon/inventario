function validarFormulario(){
    total = 0;
    validar_cantidad = 0;
    validar_fecha = 0;
    $("#tbCompras tbody tr").each(function(){
        total++; // si total llega a ser mayor de 0 es porque hay datos en la tabla
        cantidades =Number($(this).find("td:eq(2)").children('input').val()); // revisamos en la columna que ningun valor sea 0
        valor_p_caducidad =Number($(this).find("td:eq(4)").children('p').val()); //saber si se agrego un un producto perecedero
        fechaCaducidad =Number($(this).find("td:eq(4)").children('input').val()); // validar que este lleno la fecha de caducidad   
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

    if ( total != 0 & validar_cantidad == 0  & validar_fecha == 0) {
        document.getElementById("movimiento_form").submit(); 
    }else if(validar_cantidad!=1){
        toastr.error("¡Ingrese los dato necesarios!");
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
});
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
                        label: item.codigo+" - "+item.id_presentacion+" - "+item.nombre+' - '+ item.id_marca,
                        id: item.id_producto+"*"+item.codigo+"*"+item.nombre+'*'+ item.id_marca,
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
                    return {
                        label: item.codigo+" - "+item.id_presentacion+" - "+item.nombre+' - '+ item.id_marca,
                        id: item.codigo+'*'+item.nombre+'*'+item.precio_compra+'*'+item.precio_venta+'*'+item.id_producto+'*'+item.id_presentacion+'*'+item.existencias+'*'+item.perecedero,
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
                        id: item.id_producto+"*"+item.pre_producto,
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
    $("#autocompleteProducto2").val(""); 
    $("#btn-agregar-abast").val("");
    if (data != 0){
        infoProducto = data.split("*");
        html = "<tr>";
        html += "<td><input type='hidden' name='idProductos[]' value='"+infoProducto[4]+"'>"+infoProducto[0]+"</td>";//id y codigo
        html += "<td><p>"+infoProducto[1]+" "+infoProducto[5]+"</p></td>"; //nombre
        html += "<td><input type='number' style='width:100px' placeholder='Ingrese numero entero' name='cantidades[]' values='0' max='"+infoProducto[6]+"' min='1' pattern='^[0-9]+' class='cantidades' required></td>"; //cantidades
        html += "<td><input style='width:100px' step='0.01'  min='0.00' type='number' pattern='^\d*(\.\d{0,2})?$' name='nuevoPrecio[]' class='precio-entrada ' value='"+infoProducto[2]+"'></td>"; //precios    
        if(infoProducto[7] == '1'){
            html += "<td><input name='fechaCaducidad[]' values='1' type='date' required class='form-control' ></td>";           
        } else{
            html += "<td><input name='fechaCaducidad[]'  type='hidden' required class='form-control' ><p value='1' >- - - - - - - - - - - - - -</p></td>";
           
        }
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

$("#btnResumen").on("click", function(){
    fecha1 = $("#fecha1").val();
    fecha2 = $("#fecha2").val();
    prod = $("#txtProducto").val();
    pres = $("#txtPresenProducto").val();

    window.open(base_url+"movimientos/kardex/getProductoKardex?fecha1="+fecha1+"&fecha2="+fecha2+"&pres="+pres+"&prod="+prod, "_blank");
});
