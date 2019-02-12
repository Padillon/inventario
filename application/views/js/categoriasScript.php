<script type="text/javascript">

function editCategoria(num){
    valores = $("#edit"+num).val();
    datos = valores.split("*");
    $("#idCategoria").val(datos[0]); 
    $("#editName").val(datos[1]);
};

function deleteCategoria(num){
    valores = $("#delete"+num).val();
    datos = valores.split("*");
    $("#idCategoriaDelete").val(datos[0]); 
    $("#nombre").val(datos[1]);
};

function activeCategoria(num){
    valores = $("#active"+num).val();
    datos = valores.split("*");
    $("#idCategoriaActive").val(datos[0]); 
    $("#nombreActive").val(datos[1]);
};

$("#btnGuardar").on("click", function(){
    $.ajax({
        url: "<?php echo base_url();?>mantenimiento/categorias/store",
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
        url: "<?php echo base_url();?>mantenimiento/categorias/update",
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
        url: "<?php echo base_url();?>mantenimiento/categorias/Delete",
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
        url: "<?php echo base_url();?>mantenimiento/categorias/active",
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

</script>