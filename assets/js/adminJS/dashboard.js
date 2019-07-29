
$(document).on('click','.ventas',function(){
    window.location=base_url+"movimientos/salidas";
});

$(document).on('click','.compras',function(){
    window.location =base_url+"movimientos/entradas";
});

$(document).on('click','.kardex',function(){
    window.location = base_url+"movimientos/kardex";
});

$(document).on('click','.configuracion',function(){
    window.location = base_url+"ajustes/ajustes"
});

$(document).on('click','.productos',function(){
    window.location = base_url+"mantenimiento/productos";
});