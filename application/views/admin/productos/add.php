            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Agregar producto</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>mantenimiento</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img src="<?php echo base_url()?>assets/images/ajuste/<?php echo $this->session->userdata('logo')?>" class="avatar user-thumb" alt="avatar">                                                               
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
                            <form id="formularioAgregar" class="form-control" action="<?php echo base_url();?>mantenimiento/productos/store" method='POST' enctype='multipart/form-data' >
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Producto</a>
                                    </li>
                                </ul>
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="input-group mt-4">                                  
                                        <div class="col-md-3">
                                                <label for="">Nombre del producto.</label>
                                                <input name='create_nombre' id='create_nombre' type='text' class='form-control' required placeholder='Ingrese nombre'>
                                        </div>  

                                         <div class="col-md-3 mt-1">
                                                <label for="create_marca">Marca.</label>         
                                                <select name='create_marca' id='create_marca' class='custom-select' required >
                                                    <?php foreach($marcas as $marca):?>
                                                    <option value='<?php echo $marca->id_marca;?>'><?php echo $marca->nombre;?></option>
                                                    <?php endforeach;?>
                                                </select>
                                        </div>

                                        <div class="col-md-3 mt-1">
                                                <label for="create_categoria">categoria.</label>         
                                                <select name='create_categoria' id='create_categoria' class='custom-select' required>
                                                    <?php foreach($categoria as $cat):?>
                                                    <option value='<?php echo $cat->id_categoria;?>'><?php echo $cat->nombre;?></option>
                                                    <?php endforeach;?>
                                                </select>
                                        </div>
                                        <div class="col-md-2 mt-1"> 
                                            <label>Producto perecedero.</label>                     
                                            <div class="s-swtich">                          
                                                <input type="checkbox" id="create_perecedero" name="create_perecedero" class="form-check-input">
                                                <label for="create_perecedero" class="form-check-label">Perecedero.</label>
                                            </div>
                                        </div>      
        
                                        <div class="col-md-12"> 
                                            <br>
                                        </div> 
                                      <!--  <div class="col-md-3">
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
                                        -->
                                        <div class="col-md-3">
                                            <label>Seleccione una imagen:</label>
                                            <input name='create_img' size="100" id='create_img' type='file' class='form-control' ><br>      
                                        </div> 
                                        <div class="col-md-3">
                                        <div id="lista_imagenes" > </div>
                                        </div> 
                                        <div class="col-md-6">
                                            <label for="create_descripcion">Descripción.</label>
                                            <input name='create_descripcion' id="create_descripcion" type='text' class='form-control' placeholder='Ingrese descripción'>
                                        </div>    
                                        <div class="col-md-12"> 
                                            <br>
                                        </div>   
                                                
                                </div>                             
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Presentación</a>
                                    </li>
                                </ul>
                                <div class="input-group">
                                    <div class="col  mt-1"> 
                                                <label>Utilizar el mismo código para todas las presentaciones.</label>                    
                                                <div class="s-swtich">                          
                                                    <input type="checkbox" id="activar_cod_manual" name="activar_cod_manual" class="form-check-input">
                                                    <label for="activar_cod_manual" class="form-check-label">Perecedero.</label>
                                                </div>
                                    </div>
                                    <div class="col">
                                                <label for="">Ingrese código.</label>
                                                <input  autofocus name='codigo_manual' id='codigo_manual' disabled type='text' class='form-control'>
                                    </div> 
                                    <div class="col">
                                        <input name='create_codigo' id="create_codigo" type='hidden' >
                                        <svg id="barcode"></svg>  
                                    </div>  
                                    </div>
                                    <div class="tab-content mt-3" id="myTabContent" name="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <label>Agregar</label>
                                        <table class="table-responsive-lg table-hover" width="100%" id="listaPresentaciones">
                                            <thead>

                                                <th>
                                                <div>
                                                <label for="create_presentacion">Unidad</label>      
                                                <select name='create_presentacion' id='create_presentacion' class='custom-select' required>
                                                    <?php foreach($presentacion as $cat):?>
                                                    <option value='<?php echo $cat->id_presentacion.'*'.$cat->nombre;?>'><?php echo $cat->nombre;?></option>
                                                    <?php endforeach;?>
                                                </select>
                                                </div>
                                                </th>
                                                <th>
                                                    <div class="col"><label>Codigo producto</label>
                                                    <input type="text" id="cod_barra_presentacion" name="cod_barra_presentacion" class="form-control"></div>
                                                </th>

                                                <th>
                                                    <div class="col">
                                                    <label>Equivalencia en unidad mínima</label>
                                                    <input  name="cantidad_presentacion"  id="cantidad_presentacion" type='number' min='0' pattern='^[0-9]+' class='form-control' placeholder='Ingrese cantidad.'></div>
                                                </th>
                                                <th>
                                                    <div class="col">
                                                    <label>Precio compra</label>
                                                    <input  name="precio_compra" value=0.00 id="precio_compra" step='0.01' min="0"  type='number' class='form-control' placeholder='$0.00' ></div>
                                                </th>
                                                <th>
                                                    <div class="col">
                                                    <label>Precio venta</label>
                                                    <input  name="precio_venta" value=0.00 id="precio_venta" step='0.01' min="0" type='number' class='form-control' placeholder='$0.00'></div>
                                                </th>
                                                <th> 
                                                    <div class=""><br>
                                                    <button type="button" class="btn btn-success " id="btnAgregar" > Agregar <span class="fa fa-plus"></span></button></div>  
                                                </th>
                                            </thead>
                                            <tbody >
                                                    
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Stock mínimo</a>
                                    </li>
                                </ul>
                                <br>
                                <div class="input-group">
                                    <div class="col-md-3 mt-1">
                                     <select name="presentaciones" id="presentaciones" class="custom-select "></select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                    <input name='create_stock_min' id="create_stock_min" value=0 type='number' min='0' pattern='^[0-9]+' class='form-control' placeholder='Cantidad mínima.'>                                    
                                    </div>
                                </div>
                                <br>
                                <button type="button" onclick="validarFormulario()" id="procesar" class="btn btn-success col-md-12" name="btn-create" >Guardar</button>                                 
                        </div>        
                    </form> 

                
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $this->load->view('layouts/alert');
    ?>

<script src="<?php echo base_url();?>assets/js/adminJS/productos.js">

</script>
<script>
        
    var marca = document.getElementById('create_marca');
    var categoria = document.getElementById('create_categoria');
    JsBarcode("#barcode", 0,{height:35});

    marca.addEventListener('change',
    function(){
        if ($("#activar_cod_manual").prop('checked')) {
            codigoBarra();
        }
    });
    categoria.addEventListener('change',
    function(){
        if ($("#activar_cod_manual").prop('checked')) {
            codigoBarra();
        }
      //  codigoBarra();
    });

    var cod_generado;
</script>
 <script>
              function archivo(evt) {
                  var files = evt.target.files; // FileList object

                  // Obtenemos la imagen del campo "file".
                  for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                    if (!f.type.match('image.*')) {
                        continue;
                    }

                    var reader = new FileReader();

                    reader.onload = (function(theFile) {
                        return function(e) {
                          // Insertamos la imagen
                         document.getElementById("lista_imagenes").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '" width="100" height="100"/>'].join('');
                        };
                    })(f);

                    reader.readAsDataURL(f);
                  }
              }

              document.getElementById('create_img').addEventListener('change', archivo, true);
      </script>