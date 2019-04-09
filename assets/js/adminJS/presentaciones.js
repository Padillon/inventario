function presentacionDelete($num){
    var marc = $('#del_presentacion'+$num).val();
    var data = marc.split('*');
    document.getElementById("id_presentacion_delete").value= parseInt(data[0]);
    }  

    function presentacionUpdate($num){
    var marc = $("#up_presentacion"+$num).val();
    var data = marc.split('*');
    document.getElementById("id_presentacion_update").value= parseInt(data[0]);
    document.getElementById("nombre_presentacion_update").value= data[1];
    }

    function presentacionActive($num){
        var marc = $("#activepresentacion"+$num).val();
        var data = marc.split('*');
        document.getElementById("id_presentacion_active").value= parseInt(data[0]);
        }