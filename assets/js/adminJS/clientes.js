function viewCliente(num){
    valores = $("#view"+num).val();
    datos = valores.split("*");

    var html = "";
    html = "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    $("#modalCliente .modal-content").html(html);

    $("#modalCliente .modal-title").html("Información del cliente");

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
    $("#modalCliente .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>";
    $("#modalCliente .modal-footer").html(html3);

};

function editCliente(num){
    valores = $("#edit"+num).val();
    datos = valores.split("*");

    var html = "";
    html = "<form action='<?php echo base_url();?>mantenimiento/clientes/update' method='POST'>";
    html += "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    html += "</form>";
    $("#modalCliente .modal-content").html(html);

    $("#modalCliente .modal-title").html("Editar");

    var html2 = "";
    html2 = "<div class='form-group'><label>Nombre:</label>";
    html2 += "<input name='idCliente' type='hidden' value='"+datos[0]+" class='form-control'>";
    html2 += "<input name='nombre' type='text' class='form-control' value='"+datos[1]+"'></div>";
    html2 += "<div class='form-group'><label>Apellidos: </label>";
    html2 += "<input name='apellido' type='text' class='form-control' value='"+datos[2]+"'></div>";
    html2 += "<div class='form-group'><label>NIT:</label>";
    html2 += "<input name='nit' type='text' class='form-control' value='"+datos[3]+"'></div>";
    html2 += "<div class='form-group'><label>Telefono:</label>";
    html2 += "<input name='telefono' type='text' class='form-control' value='"+datos[4]+"'></div>";
    html2 += "<div class='form-group'><label>Registro</label>";
    html2 += "<input name='registro' type='text' class='form-control' value='"+datos[5]+"'></div>";
    html2 += "<div class='form-group'><label>Dirección:</label>";
    html2 += "<input name='direccion' type='text' class='form-control' value='"+datos[6]+"'></div>";
    $("#modalCliente .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    html3 += "<button type='submit' class='btn btn-primary'>Actualizar</button>";
    $("#modalCliente .modal-footer").html(html3);

};


function deleteCliente(num){
    valores = $("#delete"+num).val();
    datos = valores.split("*");

    var html = "";
    html = "<form action='<?php echo base_url();?>mantenimiento/clientes/delete' method='POST'>";
    html += "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    html += "</form>";
    $("#modalCliente .modal-content").html(html);

    $("#modalCliente .modal-title").html("Eliminar");

    var html2 = "";
    html2 = "<div class='form-group'><label>Nombre:</label>";
    html2 += "<input name='idCliente' type='hidden' value='"+datos[0]+" class='form-control'>";
    html2 += "<input name='nombre' type='text' class='form-control' value='"+datos[1]+"'></div>";
    html2 += "<div class='form-group'><label>Apellidos: </label>";
    html2 += "<input name='apellido' type='text' class='form-control' value='"+datos[2]+"'></div>";
    $("#modalCliente .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    html3 += "<button type='submit' class='btn btn-danger'>Borrar</button>";
    $("#modalCliente .modal-footer").html(html3);

};

function activeCliente(num){
    valores = $("#active"+num).val();
    datos = valores.split("*");

    var html = "";
    html = "<form action='<?php echo base_url();?>mantenimiento/clientes/active' method='POST'>";
    html += "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    html += "</form>";
    $("#modalCliente .modal-content").html(html);

    $("#modalCliente .modal-title").html("¿Desea activar el cliente?");

    var html2 = "";
    html2 = "<div class='form-group'><label>Nombre:</label>";
    html2 += "<input name='idCliente' type='hidden' value='"+datos[0]+" class='form-control'>";
    html2 += "<input name='nombre' type='text' class='form-control' value='"+datos[1]+"'></div>";
    html2 += "<div class='form-group'><label>Apellidos: </label>";
    html2 += "<input name='apellido' type='text' class='form-control' value='"+datos[2]+"'></div>";
    $("#modalCliente .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    html3 += "<button type='submit' class='btn btn-success'>Activar</button>";
    $("#modalCliente .modal-footer").html(html3);

};

$("#btnAgregar").on("click", function(){
    var html = "";
    html = "<form action='<?php echo base_url();?>mantenimiento/clientes/store' method='POST'>";
    html += "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    html += "</form>";
    $("#modalCliente .modal-content").html(html);

    $("#modalCliente .modal-title").html("Agregar");

    var html2 = "";
    html2 = "<div class='form-group'><label>Nombre:</label>";
    html2 += "<input name='nombre' type='text' class='form-control' ></div>";
    html2 += "<div class='form-group'><label>Apellidos: </label>";
    html2 += "<input name='apellido' type='text' class='form-control' ></div>";
    html2 += "<div class='form-group'><label>NIT:</label>";
    html2 += "<input name='nit' type='text' class='form-control' ></div>";
    html2 += "<div class='form-group'><label>Telefono:</label>";
    html2 += "<input name='telefono' type='text' class='form-control' ></div>";
    html2 += "<div class='form-group'><label>Registro</label>";
    html2 += "<input name='registro' type='text' class='form-control' ></div>";
    html2 += "<div class='form-group'><label>Dirección:</label>";
    html2 += "<input name='direccion' type='text' class='form-control' ></div>";
    $("#modalCliente .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    html3 += "<button type='submit' class='btn btn-primary'>Guardar</button>";
    $("#modalCliente .modal-footer").html(html3);
});
