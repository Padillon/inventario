
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

<!--permisos ***************************************** -->
<?php if ($permisos->read!=1) {
    # code...
    redirect(base_url(),"dashboard");
}
$habilitado_insert ="disabled";

$habilitado_update="disabled";

$habilitado_delete="disabled";

if ($permisos->update == 1) {
    $habilitado_update ="enabled";
}

if ($permisos->delete == 1) {
    $habilitado_delete = "enabled";
}
if ($permisos->insert == 1) {
    $habilitado_insert = "enabled";
}

?>

<div class="main-content-inner">
                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Lista - Productos bajos en stock</h4>                              
                     
                                <div class="input-group">
                                    <div class="col-md-2">
                                    <a href="<?php echo base_url();?>movimientos/entradas/add" class="btn btn-outline-primary mb-3">Comprar +</a>
                                    </div>           
                                </div>  
                                <div class="data-tables">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">

                                 <thead  >
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Marca</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $cont = 0;?>
                                <?php if(!empty($producto)):?>
                                    <?php foreach($producto as $pro):?>
                                    <?php if($pro->stock_actual <= $pro->stock_minimo) { ?>
                                    <?php $cont++;?>
                                        <tr>
                                            <td><?php echo $pro->codigo;?></td>
                                            <td><?php echo $pro->nombre;?></td>
                                            <td><?php echo $pro->marca;?></td>
                                            <td><span class="badge badge-danger"><?php echo $pro->stock_actual;?></span></td>
                                            <?php if($pro->estado == 1){?>
                                                <td>
                                                <span class="badge badge-success">Activo</span>
                                                </td>
                                            <?php }else{?>
                                                <td>
                                                <span class="badge badge-danger">Inactivo</span>
                                                </td>
                                            <?php }?>
                                            <td>
                                                <div class="btn-group">
                                                <?php $data = $pro->id_producto?>
                                                <button name="edit" id="<?php echo $pro->id_producto;?>" <?php echo $habilitado_update ?> type="button" class="btn btn-warning edit_data" data-toggle="modal" data-target="#edit">
                                                    <span span class="fa fa-pencil" style="color: #fff"></span>
                                                </button>
                                                <?php $data = $pro->id_producto."*".$pro->nombre."*".$pro->estado."*".$pro->categoria."*".$pro->codigo."*".$pro->stock_minimo."*".$pro->descripcion."*".$pro->precio_compra."*". 
                                                $pro->precio_venta."*".$pro->imagen."*".$pro->inventariable."*".$pro->presentacion."*".$pro->perecedero."*" 
                                                .$pro->marca."*".$pro->stock_actual; ?> 
                                                <?php if($pro->estado == 1){?>
                                                    <button id="viewPro<?php echo $cont;?>" type="button" onclick="viewProducto(<?php echo $cont;?>)" class="btn btn-info" data-toggle="modal" data-target="#modalView" value="<?php echo $data;?>">
                                                    <span class="fa fa-search" style="color: #fff"></span>
                                                    </button>
                                                    <button id="<?php echo $pro->id_producto;?>" <?php echo $habilitado_delete ?> type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#delete" value="<?php echo $data;?>" >
                                                        <span class="fa fa-times" style="color: #fff"></span>
                                                    </button>
                                                <?php }?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
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
    <?php
    $this->load->view('layouts/alert');
    ?>

    <!-- Large modal -->

<div id='modalView' class="modal fade bd-example-modal-lg" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="ti-cabeza">Informacion del Producto</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    </div>
    <div class='modal-body'>
    <div class='row'>  
        <div class="col-md-3 mt-4">
            <label for="create_categoria">Imagen:</label>
            <br>
                <div class="card card-bordered">
                    <img id="viewImagen" class="card-img-top img-fluid" alt="image">                              
                </div>
            <br>
            <div class="">
                <label for="">Nombre:</label>
                <input id='viewNombre' type='text' class='form-control' disabled>
            </div>
        </div>
        <div class="col-md-9 mt-4">
            <div class="input-group">
                <div class="col-md-5">
                    <label for="create_codigo">Codigo:</label>
                    <input id="viewCodigo" type='text' class='form-control' disabled>
                </div>  
                <div class="col-md-4">
                    <label for="create_categoria">Marca:</label>
                    <input id='viewMarca' type='text' class='form-control' disabled>
                </div>
                <div class="col-md-3">
                    <label for="create_categoria">Categoria:</label>         
                    <input id='viewCategoria' type='text' class='form-control' disabled>
                </div>
                <div class="col-md-12"> 
                    <br>
                </div> 
                <div class="col-md-2">
                    <label for="create_stock_min">Stock mínimo:</label>
                    <input id="viewStock" type='text'class='form-control' disabled>
                </div>
                <div class="col-md-2">
                    <label for="create_stock_act">Stock actual:</label>
                    <input id="viewStock_actual" type='text'class='form-control' disabled>
                </div>
                <div class="col-md-4">
                    <br>
                    <label for="create_presentacion">Presentacion.</label>
                    <input id="viewPresentacion" type='text' class='form-control' disabled>
                </div>
                <div class="col-md-2">
                    <label for="create_precio_compra">Precio compra:</label>
                    <input id="viewCompra"  type='text' class='form-control' disabled> 
                </div>
                <div class="col-md-2">
                    <label for="create_precio_venta">Precio venta:</label>
                    <input id="viewVenta" type='text' class='form-control' disabled>
                </div>
                <div class="col-md-12"> 
                    <br>
                </div> 
                <div class="col-md-4">
                <label for="create_descripcion">Descripción:</label>
                    <input id="viewDescripcion" type='text' class='form-control' disabled>       
                    </div>
                <div class="col-md-3">
                    <label>Estado.</label>
                    <input id='viewEstado' role='alert'><strong></strong>     
                    </div>     
                <div class="col-md-2"> 
                    <label>Perecedero</label>                     
                    <div class="s-swtich">                          
                        <input type="checkbox" id="create_perecedero"  class="form-check-input" disabled>
                        <label for="create_perecedero" class="form-check-label">Perecedero.</label>
                    </div>
                </div>           
            </div> 
            </div>
            </div>
            </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
            <button type='button' data-dismiss='modal' class='btn btn-primary'>Aceptar</button>
        </div>
    </div>
    </div>
  </div>
</div>

<!-- Modal delete-->
<div class="modal fade" id="delete">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ti-cabeza">Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url();?>mantenimiento/productos/delete" method="POST">
                    <h4 id="titulo"></H4>
                    <input id="id-pro-delete" name="id-pro-delete" type="hidden" class="form-control" >
                    <input id="estado-pro-delete" name="estado-pro-delete" type="hidden" class="form-control" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="g-delete" name="g-delete" class="btn btn-primary">Aceptar</button>
                </form> 
            </div>
        </div>
    </div>
</div>

    <!-- Modal para asegurar la edicion-->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ti-cabeza">Editar</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url();?>mantenimiento/productos/edit_get" method="POST">
                    <h4 id="titulo">Está seguro de editar este producto?</H4>
                    <input id="id-pro-edit" name="id-pro-edit" type="hidden" class="form-control" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="g-edit" name="g-edit"class="btn btn-primary">Aceptar</button>
                </form> 
            </div>
        </div>
    </div>
</div>


 <!-- Modal para elegir la marca-->
 <div class="modal fade" id="PDFPorMarca">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ti-cabeza">Reporte</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <label for="elegirMarca">Elija la marca:</label>        
                <select name='elegirMarca' id='elegirMarca' class='custom-select' required>
                    <?php foreach($marcas as $marca):?>
                        <option value='<?php echo $marca->id_marca;?>'><?php echo $marca->nombre;?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnElegirMarca" name="btnElegirMarca" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

 <!-- Modal para elegir la categoria-->
 <div class="modal fade" id="PDFPorCategoria">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ti-cabeza">Reporte</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <label for="elegirCategoria">Elija la Categoria:</label>        
                <select name='elegirCategoria' id='elegirCategoria' class='custom-select' required>
                    <?php foreach($categoria as $cat):?>
                        <option value='<?php echo $cat->id_categoria;?>'><?php echo $cat->nombre;?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnElegirCategoria" name="btnElegirCategoria" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

 <!-- Modal para elegir Stock-->
 <div class="modal fade" id="PDFPorStock">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ti-cabeza">Reporte</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-auto">
                <label for="elegirMarca">Elija la marca:</label>        
                <select id='elegirMarcaStock' class='custom-select' required>
                    <option value="b">Todos</option>
                    <?php foreach($marcas as $marca):?>
                        <option value='<?php echo $marca->id_marca;?>'><?php echo $marca->nombre;?></option>
                    <?php endforeach;?>
                </select>
                </div>
                <div class="col-md-auto">
                <br>
                <label for="elegirCategoria">Elija la Categoria:</label>        
                <select id='elegirCategoriaStock' class='custom-select' required>
                    <option value="a">Todos</option>
                    <?php foreach($categoria as $cat):?>
                        <option value='<?php echo $cat->id_categoria;?>'><?php echo $cat->nombre;?></option>
                    <?php endforeach;?>
                </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnelegirStock" name="btnelegirStock" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>
   
<script src="<?php echo base_url();?>assets/js/adminJS/productos.js"></script>
