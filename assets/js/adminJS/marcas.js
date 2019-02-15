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