 
// ****************************** VALIDACIONES PROVEEDOR Y ENVIAR FORMULARIO VACÍO Y CATIDADES 0 ******************************
/*$('#fecha').datepicker({

});*/
$('#fecha').datepicker({});
function validarFormulario(){
    total = 0;
    validar_cantidad = 0;
    validar_fecha = 0;
    $("#tbCompras tbody tr").each(function(){
        total++; // si total llega a ser mayor de 0 es porque hay datos en la tabla
        cantidades =Number($(this).find("td:eq(4)").children('input').val()); // revisamos en la columna que ningun valor sea 0
        valor_p_caducidad = $(this).closest("tr").find(".pedecedero").val(); //saber si se agrego un un producto perecedero
        fechaCaducidad =Number($(this).find("td:eq(4)").children('input').val()); // validar que este lleno la fecha de caducidad   
       
        if (fechaCaducidad == 0 & valor_p_caducidad != 0) {
            toastr.warning("Ingrese una fecha de caducidad en la linea: "+total);
            validar_fecha = 1;
        }

        if ( cantidades == 0 ) {    
            toastr.warning("Ingrese una cantidad en la linea: "+total); // ************ Aqui iria el mensaje que ingrese cantidad de producto
            validar_cantidad = 1;
        }
    });
    if ($("#idProveedor").val() != "" & total != 0 & validar_cantidad == 0 & validar_fecha == 0) {
        document.getElementById("FormCompra").submit(); 
    }else if(validar_fecha == 1){

    }else if(validar_cantidad!=1){
        toastr.warning('!Ingrese los datos necesario¡');
    }
}

//borrar el producto si ya ha sido seleccionado alguno
$(document).ready(function(){
    /*$("#autocompleteProducto").keydown(function(event){
        alert('m');
    });*/
   
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
        if (event.which==13) {
           alert('interesante');
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
                      label: item.codigo+" - "+item.nombre+' - '+ item.id_marca+' - '+item.nombre_pre,
                      id: item.codigo+'*'+item.nombre+'*'+item.precio_compra+'*'+item.precio_venta+'*'+item.id_producto+'*'+item.nombre_pre+'*'+item.perecedero+"*"+item.id_presentacion_producto,
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
  //  document.getElementById("autocompleteProducto").focus(); 
    data = $(this).val();
    if (data != 0){
        infoProducto = data.split("*");
        $.ajax({
            url: base_url+"movimientos/entradas/getTipoPresentacion",
            type: "POST",
            dataType: "json",
            data: {id_producto:infoProducto[4]},
            success: function(data){
            cantidadMaxima = 0;
            html = "<tr>";
            html += "<td><input type='hidden' name='idProductos[]' class='id_producto' value='"+infoProducto[4]+"'><input type='hidden' name='codigos[]'  value='"+infoProducto[0]+"'><p >"+infoProducto[0]+"</p></td>";//id y codigo
            html += "<td><p>"+infoProducto[1]+"</p></td>"; //nombre      
            html += "<td><select name='tipo_presentacion' id='tipo_presentacion' class='custom-select '>";//recordar recortar select y td
                for (let i = 0; i < data.length; i++) {
                    if (data[i].id_presentacion_producto == infoProducto[7]) {
                    html+= "<option selected name='presentacion[]' value='"+data[i].id_presentacion_producto+"*"+data[i].codigo+"*"+data[i].compra+"*"+data[i].valor+"'>"+data[i].nombre_pre+"</option>";
                    /*if (data[i].existencias >= data[i].valor ) {
                        cantidadMaxima = data[i].existencias / data[i].valor;
                        cantidadMaxima = myRoundCero(cantidadMaxima);
                    }else{
                        cantidadMaxima = 0;
                    }*/
                  
                }else{
                        html+= "<option name='presentacion[]' value='"+data[i].id_presentacion_producto+"*"+data[i].codigo+"*"+data[i].compra+"*"+data[i].valor+"'>"+data[i].nombre_pre+"</option>";                 
                    }             
                }
            html+= "</select></td>"        
            html += "<td><input style='width:100px' step='0.01'  min='0.00' type='number' pattern='^\d*(\.\d{0,2})?$' name='nuevoPrecio[]' class='precio-entrada' value='"+infoProducto[2]+"' required></td>"; //precios
            //html += "<td><input style='width:100px' step='0.01'  min='0.00' type='number' pattern='^\d*(\.\d{0,2})?$' name='precioSalida[]' value='"+infoProducto[3]+"' required'></td>";//precio salida
            html += "<td><input type='number' style='width:100px' placeholder='Ingrese una cantidad' id='numCantidades' name='cantidades[]' value='0' min='0' pattern='^[0-9]+' class='cantidades' required></td>"; //cantidades
            html += "<td><input type='hidden' id=importes  name='importes[]' value='"+0+"'><p id='importePresentado'>"+0+"</p></td>"; //immportes
            if (infoProducto[6]==1) {
                html += "<td><input name='fechaCaducidad[]' type='date' required class='form-control' ><input type='hidden' class='pedecedero' value='"+infoProducto[6]+"'> </td>";
            }else{
                html += "<td><input name='fechaCaducidad[]'  type='hidden' required class='form-control'><input type='hidden' class='pedecedero' value='"+infoProducto[6]+"'><p>- - - - - - - - - - - - - -</p></td>";
            }

            html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-times' style='color: #fff'></span></button></td>";
            html += "</tr>";
            $("#tbCompras tbody").append(html);
            $('#btn-agregar-abast').val('');
            $('#autocompleteProducto').val(null);
            },
        });
    } else {
        toastr.info('Seleccione un producto.','Agregar');
    }
});

//procesamiento al ingresar otra cantidad de compra
$(document).on("input", "#tbCompras input.precio-entrada", function(){
    pre_compra = $(this).val();
    cant = $(this).closest("tr").find("#numCantidades").val();
    $(this).closest("tr").find("#importes").val('9');
    importe = pre_compra * cant;
    totalImporte = parseFloat(importe).toFixed(2);
    $(this).closest("tr").find("#importes").val(totalImporte);
    $(this).closest("tr").find("td:eq(5)").children("p").text(totalImporte);
    sumarReabastecimiento();
});
//es cucharemosa cuando cambien el tipo de presentacion
$(document).on("change", "#tbCompras #tipo_presentacion", function(){
    data  =  $(this).val().split('*');
    $(this).closest("tr").find(".precio-entrada").val(data[2]);
    //$(this).closest("tr").find("td:eq(0)").children("p").text($data[1]); primera manera de hacerlo 
    $(this).closest("tr").find(".cod_class").text(data[1]); //segunda manera de hacerlo
    cant = $(this).closest("tr").find("#numCantidades").val();
    precio = $(this).closest("tr").find(".precio-entrada").val();
    importe = cant * precio;
    totalImporte = parseFloat(importe).toFixed(2);
    cantidadMaxima=0;
    //alert(data[4]+'  '+data[3]);
    if (data[4] >= data[3] ) {
        cantidadMaxima = data[3] / data[4];
        cantidadMaxima = myRoundCero(cantidadMaxima);

    }else{
        cantidadMaxima = 0;
    }
    $(this).closest("tr").find("#importes").val(totalImporte);
    $(this).closest("tr").find(".cantidades").prop('max',cantidadMaxima);
    $(this).closest("tr").find("td:eq(5)").children("p").text(totalImporte);
    sumarReabastecimiento();
});
//procedimiento al ingresar cantidades
$(document).on("input", "#tbCompras input.cantidades", function(){
    cantidad = $(this).val();
    precio = $(this).closest("tr").find(".precio-entrada").val();
    importe = cantidad * precio;
    totalImporte = parseFloat(importe).toFixed(2);
    $(this).closest("tr").find("#importes").val(totalImporte);
    $(this).closest("tr").find("td:eq(5)").children("p").text(totalImporte);
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
    document.getElementById("total_sub").innerHTML='$ '+total.toFixed(2);
    
}

$("#btnGenerarInactivos").click(function(){
    window.open(base_url+"movimientos/entradas/getReporteInactivos", "_blank");
});

$("#btnelegirFecha").on("click", function(){
    fecha1 = $("#fecha1").val();
    fecha2 = $("#fecha2").val();
    if (fecha1 == "" || fecha2 =="") {
        toastr.warning('Ingrese las fechas.');
    }else{
        if (fecha1<fecha2 || fecha1 == fecha) {
            window.open(base_url+"movimientos/entradas/getReporteFecha?fecha1="+fecha1+"&fecha2="+fecha2, "_blank");
        }else{
            toastr.warning('La primera fecha tiene que ser menor a la segunda.');
        }
    }
});

$("#btnelegirProveedor").on("click", function(){
    fecha1 = $("#fecha1Prov").val();
    fecha2 = $("#fecha2Prov").val();
    fecha1 = $("#fecha1").val();
    fecha2 = $("#fecha2").val();
    if (fecha1 == "" || fecha2 =="") {
        toastr.warning('Ingrese las fechas.');
    }else{
        if (fecha1<fecha2 || fecha1 == fecha) {
            prov = $("#elegirProveedor").val();
            window.open(base_url+"movimientos/entradas/getReporteProveedor?fecha1="+fecha1+"&fecha2="+fecha2+"&prov="+prov, "_blank");
        }else{
            toastr.warning('La primera fecha tiene que ser menor a la segunda.');
        }
    }
});

$(document).on("click", ".btnIr", function(){
    fecha1 = $("#fecha_inicio").val();
    fecha2 = $("#fecha_fin").val();
    if (fecha1 == "" || fecha2 =="") {
        toastr.warning('Ingrese las fechas.');
    }else{
        if (fecha2 >= fecha1 || fecha1 === fecha2) {
            $("#formFechas").submit();
        }else{
            toastr.warning('La primera fecha tiene que ser menor a la segunda.');
        }
    }    
});

$("#btnResumen").on("click", function(){
    fecha1 = $("#fecha1Res").val();
    fecha2 = $("#fecha2Res").val();
    if (fecha1 == "" || fecha2 =="") {
        toastr.warning('Ingrese las fechas.');
    }else{
        if (fecha1<fecha2 || fecha1 == fecha) {
            prov = $("#elegirProveedor").val();
            window.open(base_url+"movimientos/entradas/getResumen?fecha1="+fecha1+"&fecha2="+fecha2, "_blank");
        }else{
            toastr.warning('La primera fecha tiene que ser menor a la segunda.');
        }
    }
   
});

function myRoundCero(num) {
    var exp = Math.pow(10, 0); // 2 decimales por defecto
    return parseInt(num * exp, 10) / exp;
  }