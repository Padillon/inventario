function marcaDelete($num){
    var marc = $('#del_marca'+$num).val();
    var data = marc.split('*');
    document.getElementById("id_marca_delete").value= parseInt(data[0]);
    }  

    function marcaUpdate($num){
    var marc = $("#up_marca"+$num).val();
    var data = marc.split('*');
    document.getElementById("id_marca_update").value= parseInt(data[0]);
    document.getElementById("nombre_marca_update").value= data[1];
    }

$("#form1").validate({
    rules:{
        name: "required",
    },
    messages:{
        name: "Ingrese nombre de la marca",
    },
    submitHandler: function(form){
        form.submit();
    }
});

$("#btnGenerarActivos").click(function(){
    window.open(base_url+"mantenimiento/marcas/getReporteActivos", "_blank");
});

$("#btnGenerarInactivos").click(function(){
    window.open(base_url+"mantenimiento/marcas/getReporteInactivos", "_blank");
});