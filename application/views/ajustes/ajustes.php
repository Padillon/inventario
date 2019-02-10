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
                            <h4 class="page-title pull-left">Ajustes de la Empresa</h4>
                            
                        </div>
                    </div>

                </div>
            </div>
</div>
<div class="main-content-inner">
    <div class="card-area">
                <div class="row">
                    <!-- data table start -->
                     <div class="col-lg-8 col-md-6 mt-4">
                            <div class="card card-bordered">
                                <div class="card-body">
                                    <?php if(!empty($usuario)):?>
                                    <?php foreach($usuario as $usuarios):?>
                                    <h5 class="title">Bienvenido/a <?php echo $usuarios->usuario;?></h5>
                                    <?php if(!empty($ajuste)):?>
                                    <?php foreach($ajuste as $ajus):?>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Nombre de la empresa:</td>
                                                <td><?php echo $usuarios->nombre_empresa;?></td>
                                            </tr>
                                            <tr>
                                                <td>Dirección:</td>
                                                <td><?php echo $ajus->direccion;?></td>
                                            </tr>
                                            <tr>
                                                <td>Giro::</td>
                                                <td><?php echo $ajus->giro;?></td>
                                            </tr>
                                            <tr>
                                                <td>Telefono:</td>
                                                <td><?php echo $ajus->telefono;?></td>
                                            </tr>
                                            <tr>
                                                <td>Correo:</td>
                                                <td><?php if ($ajus->correo!="") {
                                                    echo $ajus->correo;
                                                    
                                                    # code...
                                                }else{
                                                    echo "ejemplo@ejemplo";
                                                }



                                                ?>
                                                    

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <a href="#" class="btn btn-primary">Editar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="card card-bordered">
                 <img class="card-img-top img-fluid" src="<?php echo base_url()?>assets/images/ajuste/<?=$ajus->logo;?>" alt="image">
                                
                            </div>
                        </div>
                         <?php endforeach;?>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                    <?php endif;?>
                </div>
            </div>
        </div>

         <div class="modal fade" id="modalAjuste">
        <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">

        </div>
     </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/adminJS/ajuste.js"></script>