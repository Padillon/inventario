$('#passwordU').keyup(function(){
    pasword();
});

$('#cfmPassword').keyup(function(){
    pasword();
});
function pasword(){
    var pass_1 = $('#passwordU').val();
    var pass_2 = $('#cfmPassword').val();
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
        password: { 
          required: true,
             minlength: 6,


        } , 

            cfmPassword: { 
              equalTo: "#passwordU",
              minlength: 6,
        },
        correo: {
            required: true,
            email: true
          }
      


    },
messages:{
  password: { 
          required:"Password Requerido",
          minlength: "Minimo 6 caracteres",
          maxlength: "Maximo 10 caracteres"
        },
cfmPassword: { 
  equalTo: "El password debe ser igual al anterior",
  minlength: "Minimo 6 caracteres",
  maxlength: "Maximo 10 caracteres"
},
correo: {
    required:"Correo requerido!",
}
}

});

function resete(){
    $('#usuario').val('');
    $('#correo').val('');
    $('#passwordU').val('');
    $('#uscPassword').val('');
}
