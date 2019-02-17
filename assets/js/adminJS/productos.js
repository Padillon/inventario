function resete(){
    $('#create_nombre').val('');
    $('#create_categoria').val('');
    $('#create_codigo').val('');
    $('#create_descripcion').val('');
    $('#create_precio_compra').val('');
    $('#create_precio_venta').val('');
    $('#create_img').val('');
    $('#create_inventariable').val('');
    $('#create_presentacion').val('');
    $('#data_id').val('');
    $('#btn-create').val("update");
    $("#create_perecedero").prop('checked', false);
    $("#create_perecedero").val('0');

}
$(document).ready(function(){
$('input[type="checkbox"]').on('change', function(e){

var val = $(this).attr("value"); 
if(val!=0){
$('#create_perecedero').val('0');
}else{
$('#create_perecedero').val('1');
}
});
$(document).on('click','.btn-active',function(){
var id = $(this).attr("id");
var data= $(this).attr("value");
var data2 = data.split('*');
if (data2[2]==1) {
document.getElementById("ti-cabeza").innerHTML="Eliminar";
document.getElementById("g-active").innerHTML="Eliminar";
document.getElementById("titulo").innerHTML = "Está seguro de eliminar el producto?"
document.getElementById("id-pro-active").value=data2[0];
document.getElementById("estado-pro-active").value=data2[2];
}else{
document.getElementById("ti-cabeza").innerHTML="Activar";
document.getElementById("g-active").innerHTML="Activar";
document.getElementById("titulo").innerHTML = "Está seguro activar el producto?"
document.getElementById("id-pro-active").value=data2[0];
document.getElementById("estado-pro-active").value=data2[2];
}        

});

$(document).on('click', '.edit_data', function(){
var id = $(this).attr("id");
$.ajax({
url:"<?php echo base_url() ?>mantenimiento/productos/get",
method:"POST",
data:{id:id},
dataType:"json",
success:function(data){
    alert(data);
   $('#create_nombre').val(data.nombre);
    $('#create_categoria').val(data.id_categoria);
    $('#create_codigo').val(data.codigo);
    $('#create_descripcion').val(data.descripcion);
    $('#create_precio_compra').val(data.precio_compra);
    $('#create_precio_venta').val(data.precio_venta);
    $('#create_img').val(data.imagen);
    $('#create_perecedero').val(data.inventariable);
    $('#create_presentacion').val(data.id_presentacion);
    $('#data_id').val(data.id_producto);
    if (data.perecedero==1) {
        $('#create_perecedero').val('1');
        $("#create_perecedero").prop('checked', true);
    }
    $('#btn-create').val("update");
    
}
});
});


$('#btn-create').on('click',function(){
// var data = $('#frm-create').serialize();
$.ajax({
url:"<?php echo base_url() ?>mantenimiento/productos/store",
type: "POST",
data: $('#frm-create').serialize(),
dataType: 'json',
success: function(data){
        
        if (data.status) {
            alert("Guardado exitosamente.");
        }
        location.reload();
        
},
error: function(){
    alert("Error");
}
});
});
});
