

    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->

       <!-- main content area start -->
        <div class="main-content">
        <div class="header-area">
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Productos</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Mantenimiento</span></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
</div>
<div class="main-content-inner">
                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Lista - Productos</h4>
                                <button type="button" class="btn btn-outline-primary mb-3" onclick=resete() data-toggle="modal" data-target="#modalProductoAdd"> Agregar+</button>
                                <div class="data-tables">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">

                     <thead  >
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $cont = 0;?>
                                <?php if(!empty($producto)):?>
                                    <?php foreach($producto as $pro):?>
                                    <?php $cont++;?>
                                        <tr>
                                            <td><?php echo $pro->id_producto;?></td>
                                            <td><?php echo $pro->nombre;?></td>
                                            <?php if($pro->estado == 1){?>
                                                <td>
                                                    <div class="alert alert-primary" role="alert">
                                                    <strong>Activo</strong>
                                                    </div>
                                                </td>
                                            <?php }else{?>
                                                <td>
                                                    <div class="alert alert-danger" role="alert">
                                                    <strong>Inactivo</strong>
                                                    </div>
                                                </td>
                                            <?php }?>
                                            <td>
                                                <div class="btn-group">
                                                <?php $data = $pro->id_categoria."*".$pro->nombre ?>
                                                <button name="edit" id="<?php echo $pro->id_producto;?>" type="button" class="btn btn-info edit_data" data-toggle="modal" data-target="#modalProductoAdd">
                                                    <span span class="fa fa-pencil" style="color: #fff"></span>
                                                </button>
                                                <?php $data = $pro->id_producto."*".$pro->nombre."*".$pro->estado ?>
                                                <?php if($pro->estado == 1){?>
                                                    <button id="<?php echo $pro->id_producto;?>" type="button" class="btn btn-danger btn-active" data-toggle="modal" data-target="#active" value="<?php echo $data;?>" >
                                                        <span class="fa fa-times" style="color: #fff"></span>
                                                    </button>
                                                <?php }else{?>
                                                    <button id="active<?php echo $cont; ?>"  type="button" class="btn btn-success btn-active" data-toggle="modal" data-target="#active" value="<?php echo $data;?>" >
                                                        <span class="fa fa-check" style="color: #fff"></span>
                                                    </button>
                                                <?php }?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
</div>
</div>

                       </div>
                     </div>
                </div>
            </div>


            </div>
        </div>
        <!-- main content area end -->
    <!-- page container area end -->

      <!-- Modal active-->
     <div class="modal fade" id="active">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ti-cabeza">Eliminar</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                               <form action="<?php echo base_url();?>mantenimiento/productos/active" method="POST">
                                               <h4 id="titulo"></H4>
                                               <input id="id-pro-active" name="id-pro-active" type="hidden" class="form-control" >
                                               <input id="estado-pro-active" name="estado-pro-active" type="hidden" class="form-control" >
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" id="g-active" name="g-active"class="btn btn-primary"></button>
                                           </form> </div>
                                        </div>
                                    </div>
                                </div>

    <!-- Modal agregar producto-->
    <div class="modal fade" id="modalProductoAdd" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Producto.</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="frm-create" >
                                                <input name='data_id' id='data_id' type='hidden'>
                                                <input name='id_stock' id='id_stock' type='hidden'>
                                                <label for="">Nombre del producto.</label>
                                                <input name='create_nombre' id='create_nombre' type='text' class='form-control' placeholder='Ingrese nombre'>
                                                <label for="create_categoria">categoria.</label>         
                                                <select name='create_categoria' id='create_categoria' class='form-control' required>
                                                <?php foreach($categoria as $cat):?>
                                                <option value='<?php echo $cat->id_categoria;?>'><?php echo $cat->nombre;?></option>
                                                <?php endforeach;?>
                                                </select>
                                                <label for="create_codigo">Codigo.</label>
                                                <input name='create_codigo' id="create_codigo" type='text' class='form-control' placeholder='Ingrese codigo'>
                                                <label for="create_descripcion">Descripción.</label>
                                                <input name='create_descripcion' id="create_descripcion"type='text' class='form-control' placeholder='Ingrese descripción'>
                                                <label for="create_stock_min">Stock mínimo.</label>
                                                <input name='create_stock_min' id="create_stock_min" type='number'class='form-control' placeholder='Ingrese cantidad.'>
                                                <label for="create_precio_compra">Precio de compra.</label>
                                                <input name='create_precio_compra' id="create_precio_compra" step='0.01' type='number'class='form-control' placeholder='Ingrese descripción'>
                                                <label for="create_precio_venta">Precio de venta.</label>
                                                <input name='create_precio_venta' id="create_precio_venta" step='0.01' type='number'class='form-control' placeholder='Ingrese descripción'>
                                                <label for="create_img">Imagen.</label><br>
                                                <input name="create_img" id="create_img" type='file' ><br>
                                                <label for="create_perecedero">Perecedero.</label><br>  
                                                <div class="s-sw-title">
                                                    <div class="s-swtich">
                                                        <input type="checkbox" id="create_perecedero" name="create_perecedero" >
                                                        <label for="create_perecedero" ></label>
                                                    </div>
                                                </div>    
                                                <label for="create_presentacion">Presentacion.</label>         
                                                <select name='create_presentacion' id='create_presentacion' class='form-control' required>
                                                <?php foreach($presentacion as $pre):?>
                                                <option value='<?php echo $pre->id_presentacion;?>'><?php echo $pre->nombre;?></option>
                                                <?php endforeach;?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" name="btn-create" id="btn-create">Guardar cambio</button>
                                           </form> </div>
                                        </div>
                                    </div>
                                </div>

                                
<script>
    function resete(){
        $('#create_nombre').val('');
        $('#create_categoria').val('');
        $('#create_codigo').val('');
        $('#create_descripcion').val('');
        $('#create_precio_compra').val('');
        $('#create_precio_venta').val('');
        $('#create_stock_min').val('');
        $('#id_stock').val('');
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
    success:function data(data){
    $('#create_nombre').val(data.nombre);
        $('#create_categoria').val(data.id_categoria);
        $('#create_codigo').val(data.codigo);
        $('#create_descripcion').val(data.descripcion);
        $('#create_precio_compra').val(data.precio_compra);
        $('#create_precio_venta').val(data.precio_venta);
        $('#create_img').val(data.imagen);
        $('#create_perecedero').val(data.inventariable);
        $('#create_stock_min').val(data.stock_minimo);
        $('#create_presentacion').val(data.id_presentacion);
        $('#data_id').val(data.id_producto);
        if (data.perecedero==1) {
            $('#create_perecedero').val('1');
            $("#create_perecedero").prop('checked', true);
        }
        var stock= data.id_stock;
        var data2 = stock.split('*');
        $('#create_stock_min').val(data2[1]);
        $('#id_stock').val(data2[0]);
    }
    });
    });
    
    $('#btn-create').on('click',function(){
        $.ajax({
            url:"<?php echo base_url() ?>mantenimiento/productos/store",
            type: "POST",
            enctype:"multipart/form-data",
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
</script>

