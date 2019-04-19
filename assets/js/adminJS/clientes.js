function viewCliente(num){
    valores = $("#view"+num).val();
    datos = valores.split("*");
    var html2 = ""; 
    html2 = "<div class='form-group'><label>Nombre:</label>"; 
    html2 += "<input name='nombre' type='text' class='form-control' value='"+datos[1]+"' disabled></div>"; 
    html2 += "<div class='form-group'><label>Apellidos: </label>"; 
    html2 += "<input name='apellido' type='text' class='form-control' value='"+datos[2]+"' disabled></div>"; 
    html2 += "<div class='form-group'><label>NIT:</label>"; 
    html2 += "<input name='nit' type='text' class='form-control' value='"+datos[3]+"' disabled></div>"; 
    html2 += "<div class='form-group'><label>Telefono:</label>"; 
    html2 += "<input name='telefono' type='text' class='form-control' value='"+datos[4]+"' disabled></div>"; 
    html2 += "<div class='form-group'><label>Registro</label>"; 
    html2 += "<input name='registro' type='text' class='form-control' value='"+datos[5]+"' disabled></div>"; 
    html2 += "<div class='form-group'><label>Dirección:</label>"; 
    html2 += "<input name='direccion' type='text' class='form-control' value='"+datos[6]+"' disabled></div>"; 
    html2 += "<div class='form-group'><label>Estado:</label>"; 
    if (datos[7] == 1){ 
        html2 += "<div class='alert alert-primary' role='alert'><strong>Activo</strong></div>"; 
    } else{ 
        html2 += "<div class='alert alert-danger' role='alert'><strong>Inactivo</strong></div>"; 
    } 
    $("#modalView .modal-body").html(html2); 
};

function editCliente(num){
    valores = $("#edit"+num).val();
    datos = valores.split("*");
    $("#idCliente").val(datos[0]);
    $("#nombre").val(datos[1]);
    $("#apellido").val(datos[2]);
    $("#nit").val(datos[3]);
    $("#telefono").val(datos[4]);
    $("#registro").val(datos[5]);
    $("#direccion").val(datos[6]);
};

function deleteCliente(num){
    valores = $("#delete"+num).val();
    datos = valores.split("*");
    $("#idClienteDelete").val(datos[0]);
    $("#nombreDelete").val(datos[1]);
    $("#apellidoDelete").val(datos[2]);
};

function activeCliente(num){
    valores = $("#active"+num).val();
    datos = valores.split("*");
    $("#idClienteActive").val(datos[0]);
    $("#nombreActive").val(datos[1]);
    $("#apellidoActive").val(datos[2]);
};


