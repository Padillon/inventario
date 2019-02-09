

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
                            <h4 class="page-title pull-left">Categorias</h4>
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
                                <h4 class="header-title">Lista - Categorias</h4>
                                <button type="button" id="btnAgregar" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#modalAdd"> Agregar+</button>
                                <div class="data-tables">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                            
                     <thead  >
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody> 
                            <?php $cont = 0;?>
                                <?php if(!empty($categoria)):?>
                                    <?php foreach($categoria as $cat):?>
                                    <?php $cont++;?>
                                        <tr>
                                            <td><?php echo $cat->id_categoria;?></td>
                                            <td><?php echo $cat->nombre;?></td>
                                            <td>
                                                <div class="btn-group">
                                                <?php $data = $cat->id_categoria."*".$cat->nombre ?>
                                                <button id="edit<?php echo $cont;?>" type="button" onclick="cargarDatos(<?php echo $cont;?>)" class="btn btn-info btn-view-producto" data-toggle="modal" data-target="#modalEdit" value="<?php echo $data;?>">
                                                    <span span class="fa fa-pencil" style="color: #fff"></span>
                                                </button>                                               
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

    <!-- Modal add-->
    <div class="modal fade" id="modalAdd">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title">Agregar</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action='<?php echo base_url();?>mantenimiento/categorias/store' method='POST'>
                <div class="modal-body">
                    <label>Nombre de la categoria</label>
                    <input name='name' type='text' class='form-control' placeholder='Ingrese nombre'>
                </div>
                <div class="modal-footer">
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='submit' class='btn btn-primary'>Guardar</button>
                </div>
            </form>
        </div>
     </div>  
    </div>
    
    <!-- Modal edit-->
    <div class="modal fade" id="modalEdit">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title">Editar</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action='<?php echo base_url();?>mantenimiento/categorias/update' method='POST'>
            <div class="modal-body">
                <label>Nombre de la categoria</label>
                <input name='editName' id="editName" type='text' class='form-control'>
                <input name='idCategoria' id="idCartegoria" type='hidden' class='form-control'>
            </div>
             <div class="modal-footer">
             <button type='button' id='cerrarModal' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
             <button type='submit' id='editarCategoria' class='btn btn-primary'>Actualizar</button>
            </div>
            </form>
        </div>
     </div>  
    </div>

<script type="text/javascript">
var base = "<?php echo base_url();?>";

function cargarDatos(num){
    valores = $("#edit"+num).val();
    datos = valores.split("*");
   
    $("#editName").val(datos[1]);
    $("#idCategoria").val(num);
};    

// $("#editarCategoria").click(function(){
//     var id = $("#idCategoria").val();
//     var nombre = $("#editName").val();

//    $.post(base+"mantenimiento/categorias/update", {
//         idCategoria: id,
//         editName: nombre
//    }, 
//    function(data){
//         if (data == 1){
//             $("#cerrarModal").click();
//             location.reload();
//         }
//    });
//});

</script>