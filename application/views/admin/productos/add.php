
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
                            <h4 class="page-title pull-left">Agregar Productos</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Movimientos</span></li>
                            </ul>
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
                                                <input name='create_nombre' id='create_nombre' type='text' class='form-control' placeholder='Ingrese nombre'>
                                        </div>  

                                         <div class="col-md-3">
                                                <label for="create_categoria">Marca.</label>         
                                                <select name='create_marca' id='create_marca' class='custom-select' required >
                                                    <?php foreach($marcas as $marca):?>
                                                    <option value='<?php echo $marca->id_marca;?>'><?php echo $marca->nombre;?></option>
                                                    <?php endforeach;?>
                                                </select>
                                        </div>

                                        <div class="col-md-3">
                                                <label for="create_categoria">categoria.</label>         
                                                <select name='create_categoria' id='create_categoria' class='custom-select' required>
                                                    <?php foreach($categoria as $cat):?>
                                                    <option value='<?php echo $cat->id_categoria;?>'><?php echo $cat->nombre;?></option>
                                                    <?php endforeach;?>
                                                </select>
                                        </div>

                                    <!--    <div class="col-md-3">
                                            <label for="create_codigo">Codigo.</label>
                                            <input name='create_codigo' id="create_codigo" type='text' class='form-control' placeholder='Ingrese codigo'>
                                        </div> -->
                                        <div class="col-md-3">
                                             <svg id="barcode"></svg>  
                                        </div>            
                                        <div class="col-md-12"> 
                                            <br>
                                        </div> 
                                        <div class="col-md-3">
                                            <label for="create_stock_min">Stock mínimo.</label>
                                            <input name='create_stock_min' id="create_stock_min" type='number' min='0' pattern='^[0-9]+' class='form-control' placeholder='Ingrese cantidad.'>
                                        </div>


                                        <div class="col-md-5">
                                            <label for="create_descripcion">Descripción.</label>
                                            <input name='create_descripcion' id="create_descripcion" type='text' class='form-control' placeholder='Ingrese descripción'>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="create_precio_compra">Precio de compra.</label>
                                            <input name='create_precio_compra' id="create_precio_compra" step='0.01'  type='number' class='form-control' placeholder='$0.00'> 
                                        </div>

                                        <div class="col-md-2">
                                            <label for="create_precio_venta">Precio de venta.</label>
                                            <input name='create_precio_venta' id="create_precio_venta" step='0.01'  type='number' class='form-control' placeholder='$0.00'>
                                        </div>
                                        <div class="col-md-12"> 
                                            <br>
                                        </div> 
                                        <div class="col-md-3">
                                            <label for="create_presentacion">Presentacion.</label>         
                                            <select name='create_presentacion' id='create_presentacion' class='custom-select' required>
                                                <?php foreach($presentacion as $pre):?>
                                                    <option value='<?php echo $pre->id_presentacion;?>'><?php echo $pre->nombre;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>

                                        <div class="col-md-2"> 
                                            <label>Perecedero</label>                     
                                            <div class="s-swtich">                          
                                                <input type="checkbox" id="create_perecedero" name="create_perecedero" class="form-check-input">
                                                <label for="create_perecedero" class="form-check-label">Perecedero.</label>
                                            </div>
                                        </div>      

                                        <div class="col-md-3 ">
                                        <label>Imagen:</label>
                                            <label for="create_img" class="custom-file-label">Seleccione una imagen.</label><br>
                                            <input name='create_img' id='create_img' type='file' class='custom-file-input' ><br>      
                                        </div>      
                                        <div class="col-md-12"> 
                                            <br>
                                        </div>               
                                </div>
                               <button type="submit" class="btn btn-success" name="btn-create" >Guardar</button>                                 
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
<script>
 /* if(4<5){
        alert("jolas");
        $('#create_perecedero').val('1');
        $("#create_perecedero").prop('checked', true);
    }*/
</script>