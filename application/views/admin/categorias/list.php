

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
            <!-- page title area end -->
            <div class="main-content-inner">
                
            <div class="col-md-12">
                        <div class="panel panel-default">
                          <div class="panel-body">
                            <table id="example1" class="table table-striped table-bordered" >
                            
                     <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Precio</th>
                                    <th>Mayoreo</th>
                                    <th>Stock</th>
                                    <th>Categoria</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php if(!empty($categoria)):?>
                                    <?php foreach($categoria as $cat):?>
                                        <tr>
                                            <td><?php echo $cat->id_categoria;?></td>
                                            <td><?php echo $cat->nombre;?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-view-producto" data-toggle="modal" data-target="#modal-default" value="<?php echo $dataproducto;?>">
                                                        <span class="fa fa-search"></span>
                                                    </button>

                                                   

                                                    
                                                   
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                        <a href="<?php echo base_url();?>pdfcontroller/productos" target="_blank">
                            <button type="button" class="btn btn-success"><i class="fa fa-check"></i>Generrar Reporte</button>
                        </a>
                       </div>
                     </div>
                </div>
            </div>              
                    
            
            </div>
        </div>
        <!-- main content area end -->
       
    
    <!-- page container area end -->

    
