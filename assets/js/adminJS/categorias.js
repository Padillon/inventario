
function editCategoria(num){ //carga datos del modal Editar Categoria
    valores = $("#edit"+num).val();
    datos = valores.split("*");
    $("#idCategoria").val(datos[0]); 
    $("#editName").val(datos[1]);
};

function deleteCategoria(num){ //carga datos del modal borrar Categoria
    valores = $("#delete"+num).val();
    datos = valores.split("*");
    $("#idCategoriaDelete").val(datos[0]); 
    $("#nombre").val(datos[1]);
};

