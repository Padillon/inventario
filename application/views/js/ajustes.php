<script type="text/javascript">

function editAjuste(num){
    valores = $("#ajuste").val();
    datos = valores.split("*");

    var html = "";
    html = "<form action='<?php echo base_url();?>ajustes/ajustes/upload' method='POST' enctype='multipart/form-data'>";
    html += "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    html += "</form>";
    $("#modalAjuste .modal-content").html(html);

    $("#modalAjuste .modal-title").html("Editar");

    var html2 = "";
    html2 += " <img src='../../assets/images/ajuste/"+datos[5]+"' alt='image'>";
    html2 += "<br><br>";
    html2 += "<input name='uploaded' id='name' type='file' class='form-control' >";
    html2 += "<label>Nombre de la Empresa</label>";
    html2 += "<input name='nempresa' id='name' type='text' class='form-control' value='"+datos[0]+"'>";
    html2 += "<label>Dirección</label>";
    html2 += "<input name='direccion' id='name' type='text' class='form-control' value='"+datos[1]+"'>";
    html2 += "<label>Giro</label>";
    html2 += "<input name='giro' id='name' type='text' class='form-control' value='"+datos[2]+"'>";
    html2 += "<label>Telefono</label>";
    html2 += "<input name='tel' id='name' type='text' class='form-control' value='"+datos[3]+"'>";
    html2 += "<label>Correo</label>";
    html2 += "<input name='correo' id='name' type='text' class='form-control' value='"+datos[4]+"'>";
    html2 += "<input name='idCategoria' id='idCategoria' type='hidden' value='"+datos[6]+" class='form-control'>";
    $("#modalAjuste .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    html3 += "<button type='submit' class='btn btn-primary'>Actualizar</button>";
    $("#modalAjuste .modal-footer").html(html3);

};


</script>