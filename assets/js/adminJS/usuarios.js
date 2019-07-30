$('#pass').keyup(function(){
    pasword();
});

$('#pass2').keyup(function(){
    pasword();
});

function pasword(){
    var pass_1 = $('#pass').val();
    var pass_2 = $('#pass2').val();
    if(pass_1 != "" & pass_2 != ""){
        if(pass_1 != pass_2){
            $('#btnGuardar').prop('disabled',true);
        }
        if(pass_1 === pass_2){
            $('#btnGuardar').prop('disabled',false);
        }
    }
}
$("#formAgregar").validate({
    rules: {
        pass: { 
          required: true,
             minlength: 6,
        } , 
         pass2: { 
         equalTo: "#pass",
         minlength: 6,
        },
        correo: {
            required: true,
            email: true
          }
      


    },
messages:{
    pass: { 
          required:"Password Requerido",
          minlength: "Minimo 6 caracteres",
          maxlength: "Maximo 10 caracteres"
        },
    pass2: { 
    equalTo: "No coinciden las contraseñas",
},
correo: {
    required:"Correo requerido!",
}
}

});

function resete(){
    $('#nombre').val('');
    $('#correo').val('');
    $('#pass').val('');
  //  $('#uscPassword').val('');
}
function viewCliente(num){
    valores = $("#view"+num).val();
    datos = valores.split("*");
    var html2 = ""; 
    html2 = "<div class='form-group'><label>Usuario:</label>";
    html2 += "<input name='nombre' type='text' class='form-control' value='"+datos[2]+"' disabled></div>";
    html2 += "<div class='form-group'><label>Correo: </label>"; 
    html2 += "<input name='correo' type='text' class='form-control' value='"+datos[3]+"' disabled></div>";
    html2 += "<div class='form-group'><label>Cargo: </label>"; 
    html2 += "<input name='cargo' type='text' class='form-control' value='"+datos[1]+"' disabled></div>";
    if (datos[4 ] == 1){ 
        html2 += "<div class='alert badge-success' role='alert'><strong>Activo</strong></div>"; 
    } else{ 
        html2 += "<div class='alert alert-danger' role='alert'><strong>Inactivo</strong></div>"; 
    } 
    $("#modalView .modal-body").html(html2); 

};

function editCliente(num){
    valores = $("#edit"+num).val();
    datos = valores.split("*");
    $("#id_usuarioE").val(datos[0]);
    $("#nombreE").val(datos[2]);
    $("#correoE").val(datos[3]);
    
};
function usuarioDelete($num){
    var marc = $('#delete'+$num).val();
    var data = marc.split('*');
    document.getElementById("id_usuario_delete").value= parseInt(data[0]);
    }  

    function usuarioActive($num){
        var marc = $("#active"+$num).val();
        var data = marc.split('*');
        document.getElementById("id_usuario_active").value= parseInt(data[0]);
        }
