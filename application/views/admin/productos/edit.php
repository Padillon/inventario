            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Editar producto</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>mantenimiento</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                         
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"> <?php echo $this->session->userdata("usuario_log")?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo base_url();?>ajustes/ajustes/index">Ajustes</a>
                                <a class="dropdown-item" href="<?php echo base_url();?>Auth/logout">Cerrar Sesion</a>
                              </div>
                        </div>
                    </div>
                </div>
           </div>


        <div class="main-content-inner">
            <div class="row">
                <!-- busqueda de producto -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">                      
                            <form class="form-control" action="<?php echo base_url();?>mantenimiento/productos/store" method='POST' enctype='multipart/form-data'>
                                <div class="input-group">

                                
                                <div class="col-md-3">
                                    <label for="">Nombre del producto.</label>
                                    <input type="hidden" name="data_id" value="<?php echo $producto->id_producto;?>">
                                    <input name='create_nombre' id='create_nombre' type='text' class='form-control'  value="<?php echo $producto->nombre;?>">
                                </div>

                                <div class="col-md-3">
                                    <label for="create_categoria">Marca.</label>         
                                    <select name='create_marca' id='create_marca' class='form-control' required >
                                        <?php foreach($marcas as $marca):?>
                                            <?php if($marca->id_marca == $producto->id_marca){ ?>
                                                <option value='<?php echo $marca->id_marca;?>' selected ><?php echo $marca->nombre;?></option>
                                            <?php   
                                                }else{
                                            ?>
                                            <option value='<?php echo $marca->id_marca;?>'><?php echo $marca->nombre;?></option>
                                            <?php }?>
                                        <?php endforeach;?>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="create_categoria">Categoria.</label>         
                                    <select name='create_categoria' id='create_categoria' class='form-control' required >
                                        <?php foreach($categoria as $cat):?>
                                            <?php if($cat->id_categoria == $producto->id_categoria){ ?>
                                                <option value='<?php echo $cat->id_categoria;?>' selected ><?php echo $cat->nombre;?></option>
                                            <?php   
                                                }else{
                                            ?>
                                            <option value='<?php echo $cat->id_categoria;?>'><?php echo $cat->nombre;?></option>
                                            <?php }?>
                                        <?php endforeach;?>
                                    </select>
                                </div>

                                    <div class="col-md-3">
                                    <label for="create_codigo">Codigo.</label>
                                    <input name='create_codigo' id="create_codigo" type='text' class='form-control' placeholder='Ingrese codigo' value="<?php echo $producto->codigo;?>">
                                    </div>
                                    <input type="hidden"value="<?php echo $id_stock;?>" name="id_stock">
                                    <div class="col-md-12"> 
                                        <br>
                                    </div> 
                                    <div class="col-md-3">
                                    <label for="create_stock_min">Stock mínimo.</label>
                                    <input name='create_stock_min' id="create_stock_min" type='number' class='form-control' placeholder='Ingrese cantidad.' value="<?php echo $stock_minimo;?>">
                                    </div>

                                    <div class="col-md-5">
                                    <label for="create_descripcion">Descripción.</label>
                                    <input name='create_descripcion' id="create_descripcion" type='text' class='form-control' placeholder='Ingrese descripción' value="<?php echo $producto->descripcion;?>">
                                    </div>

                                    <div class="col-md-2">
                                    <label for="create_precio_compra">Precio de compra.</label>
                                    <input name='create_precio_compra' id="create_precio_compra" step='0.01' type='number' class='form-control' placeholder='$0.00' value="<?php echo $producto->precio_compra;?>"> 
                                    </div>

                                    <div class="col-md-2">
                                    <label for="create_precio_venta">Precio de venta.</label>
                                    <input name='create_precio_venta' id="create_precio_venta" step='0.01' type='number' class='form-control' placeholder='$0.00'  value="<?php echo $producto->precio_venta;?>">
                                    </div>
                                    <div class="col-md-12"> 
                                                    <br>
                                                </div>        
                                    <div class="col-md-3">
                                    <label for="create_presentacion">Presentacion.</label>         
                                    <select name='create_presentacion' id='create_presentacion' class='custom-select' required>
                                    <?php foreach($presentacion as $pre):?>
                                    <?php if($pre->id_presentacion == $producto->id_presentacion){ ?>
                                    <option value='<?php echo $pre->id_presentacion;?>' selected><?php echo $pre->nombre;?></option>
                                    <?php } else{?>
                                        <option value='<?php echo $pre->id_presentacion;?>'><?php echo $pre->nombre;?></option>   
                                    <?php } ?>
                                    <?php endforeach;?>
                                    </select>
                                    </div>
                                    <div class="col-md-2"> 
                                    <label>Perecedero</label>                     
                                    <div class="s-swtich">                          
                                    <input type="checkbox" id="create_perecedero" name="create_perecedero" class="form-check-input" value="<?php echo $producto->perecedero;?>">
                                    <label for="create_perecedero" class="form-check-label">Perecedero.</label>
                                    </div>
                                    </div>  


                                    
                                    <div class="col-md-3 ">
                                    <label for="create_img" class="custom-file-label">Seleccione una imagen.</label><br>
                                    <input name='create_img' id='edit_img' type='file' class='custom-file-input' ><br>      
                                    </div> 
                                    <div class="col-md-12"> 
                                                    <br>
                                                </div> 

                                

                                    </div>
                                    <button type="submit" class="btn btn-success" name="btn-create" >Guardar</button>
                                    </div>                                  
                            </form> 
                        </div>                    
                     </div>

                </div>
            </div>
        </div>
    </div>
    <?php
    $this->load->view('layouts/alert');
    ?>

<script src="<?php echo base_url();?>assets/js/adminJS/productos.js"></script>
