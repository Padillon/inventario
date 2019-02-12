<script type="text/javascript">

function editCategoria(num){
    valores = $("#delete"+num).val();
    datos = valores.split("*");

    var html = "";
    html = "<form action='<?php echo base_url();?>mantenimiento/categorias/update' method='POST'>";
    html += "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    html += "</form>";
    $("#modalCategoria .modal-content").html(html);

    $("#modalCategoria .modal-title").html("Editar");

    var html2 = "";
    html2 = "<label>Nombre de la categoria</label>";
    html2 += "<input name='editName' id='name' type='text' class='form-control' value='"+datos[1]+"'>";
    html2 += "<input name='idCategoria' id='idCategoria' type='hidden' value='"+datos[0]+" class='form-control'>";
    $("#modalCategoria .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    html3 += "<button type='submit' class='btn btn-primary'>Actualizar</button>";
    $("#modalCategoria .modal-footer").html(html3);

};

function deleteCategoria(num){
    valores = $("#delete"+num).val();
    datos = valores.split("*");

    var html = "";
    html = "<form action='<?php echo base_url();?>mantenimiento/categorias/delete' method='POST'>";
    html += "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    html += "</form>";
    $("#modalCategoria .modal-content").html(html);

    $("#modalCategoria .modal-title").html("Eliminar");

    var html2 = "";
    html2 = "<label>Nombre de la categoria</label>";
    html2 += "<input name='nombre' id='name' type='text' class='form-control' value='"+datos[1]+"'>";
    html2 += "<input name='idCategoriaDelete' id='idCategoria' type='hidden' value='"+datos[0]+" class='form-control'>";
    $("#modalCategoria .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    html3 += "<button type='submit' class='btn btn-primary'>Borrar</button>";
    $("#modalCategoria .modal-footer").html(html3);

};

function activeCategoria(num){
    valores = $("#active"+num).val();
    datos = valores.split("*");

    var html = "";
    html = "<form action='<?php echo base_url();?>mantenimiento/categorias/active' method='POST'>";
    html += "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    html += "</form>";
    $("#modalCategoria .modal-content").html(html);

    $("#modalCategoria .modal-title").html("Activar");

    var html2 = "";
    html2 = "<label>Nombre de la categoria</label>";
    html2 += "<input name='nombre' id='name' type='text' class='form-control' value='"+datos[1]+"'>";
    html2 += "<input name='idCategoria' id='idCategoria' type='hidden' value='"+datos[0]+" class='form-control'>";
    $("#modalCategoria .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    html3 += "<button type='submit' class='btn btn-primary'>Activar</button>";
    $("#modalCategoria .modal-footer").html(html3);

};

$("#btnAgregar").on("click", function(){
    var html = "";
    html = "<form action='<?php echo base_url();?>mantenimiento/productos/store' method='POST'>";
    html += "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    html += "</form>";
    $("#modalProducto .modal-content").html(html);

    $("#modalProducto .modal-title").html("Agregar producto");

    var html2 = "";
    html2 = "<label>Nombre del producto.</label>";
    html2 += "<input name='name' type='text' class='form-control' placeholder='Ingrese nombre'>";
    html2 += "<label>categoria.</label>";
    html2 += "<select name='categoria' id='categoria' class='form-control' required>";
    html2 += "<?php foreach($categoria as $cat):?>";
    html2 += "<option value='<php echo $cat->id?>'><?php echo $cat->nombre;?></option>";
    html2 += "<?php endforeach;?>";
    html2 += "</select>"
    html2 += "<label>Codigo.</label>";
    html2 += "<input name='codigo' type='text' class='form-control' placeholder='Ingrese codigo'>";
    html2 += "<label>Descripción.</label>";
    html2 += "<input name='descripcion' type='text' class='form-control' placeholder='Ingrese descripción'>";
    html2 += "<label>Precio de compra.</label>";
    html2 += "<input name='precio_compra' step='0.01' type='number'class='form-control' placeholder='Ingrese descripción'>";
    html2 += "<label>Precio de compra.</label>";
    html2 += "<input name='precio_venta' step='0.01' type='number'class='form-control' placeholder='Ingrese descripción'>";
    html2 += "<label>Imagen.</label><br>";
    html2 += "<input type='file' name='img' accept='image/png, image/jpeg'><br>";
    html2 += "<label>Inventariable.</label><br>";
    html2 += "<input name='codigo' type='int'><br>";
    html2 += "<label>Presentación.</label>";
    html2 += "<select name='categoria' id='categoria' class='form-control' required>";
    html2 += "<?php foreach($ as $categoria):?>";
    html2 += "<option value='<?php echo $categoria->id?>'><?php echo $categoria->nombre;?></option>";
    html2 += "<?php endforeach;?>";
    html2 += "</select>"

    $("#modalProducto .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    html3 += "<button type='submit' class='btn btn-primary'>Guardar</button>";
    $("#modalCategoria .modal-footer").html(html3);
});



</script>