function viewProveedor(num){
    valores = $("#view"+num).val();
    datos = valores.split("*");
    var html2 = ""; 
    html2 = "<div class='form-group'><label>Nombre:</label>"; 
    html2 += "<input name='nombre' type='text' class='form-control' value='"+datos[1]+"' disabled></div>"; 
    html2 += "<div class='form-group'><label>Apellidos: </label>"; 
    html2 += "<input name='empresa' type='text' class='form-control' value='"+datos[2]+"' disabled></div>";
    html2 += "<div class='form-group'><label>Telefono:</label>"; 
    html2 += "<input name='telefono' type='text' class='form-control' value='"+datos[3]+"' disabled></div>"; 
    html2 += "<div class='form-group'><label>Estado:</label>"; 
    if (datos[4] == 1){ 
        html2 += "<div class='alert alert-success' role='alert'><strong>Activo</strong></div>"; 
    } else{ 
        html2 += "<div class='alert alert-danger' role='alert'><strong>Inactivo</strong></div>"; 
    } 
    $("#modalView .modal-body").html(html2); 
};

function editProveedor(num){
    valores = $("#edit"+num).val();
    datos = valores.split("*");
    $("#idProveedor").val(datos[0]);
    $("#nombre").val(datos[1]);
    $("#empresa").val(datos[2]);
    $("#telefono").val(datos[3]);
};

function deleteProveedor(num){
    valores = $("#delete"+num).val();
    datos = valores.split("*");
    $("#idProveedorDelete").val(datos[0]);
    $("#nombreDelete").val(datos[1]);
    $("#empresaDelete").val(datos[2]);
};

function activeProveedor(num){
    valores = $("#active"+num).val();
    datos = valores.split("*");
    $("#idProveedorActive").val(datos[0]);
    $("#nombreActive").val(datos[1]);
    $("#empresaActive").val(datos[2]);
};

$("#btnGuardar").on("click", function(){
    $.ajax({
        url: base_url+"mantenimiento/proveedores/store",
        type: "POST",
        data: $("#formAgregar").serialize(),
        dataType: "json",
        success: function(data){
           if(data.status){
               alert("guardado");
               location.reload();
           }
        },
        error: function(){
            alert("error");
        }
    });
});

$("#btnEditar").on("click", function(){
    $.ajax({
        url: base_url+"mantenimiento/proveedores/update",
        type: "POST",
        data: $("#formEditar").serialize(),
        dataType: "json",
        success: function(data){
           if(data.status){
               alert("guardado");
               location.reload();
           }
        },
        error: function(){
            alert("error");
        }
    });
});

$("#btnDelete").on("click", function(){
    $.ajax({
        url: base_url+"mantenimiento/proveedores/delete",
        type: "POST",
        data: $("#formDelete").serialize(),
        dataType: "json",
        success: function(data){
           if(data.status){
               alert("guardado");
               location.reload();
           }
        },
        error: function(){
            alert("error");
        }
    });
});

$("#btnActive").on("click", function(){
    $.ajax({
        url: base_url+"mantenimiento/proveedores/active",
        type: "POST",
        data: $("#formActive").serialize(),
        dataType: "json",
        success: function(data){
           if(data.status){
               alert("guardado");
               location.reload();
           }
        },
        error: function(){
            alert("error");
        }
    });
});