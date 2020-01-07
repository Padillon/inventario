
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Ajustes de la empresa</h4>
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
<?php if ($permisos->read!=1) {
    # code...
    redirect(base_url(),"dashboard");
}?>
<div class="main-content-inner">
    <div class="card-area">
                <div class="row">
                    <!-- data table start -->
                     <div class="col-lg-8 col-md-6 mt-4">
                            <div class="card card-bordered">
                                <div class="card-body">
                                        <?php if(!empty($ajuste)):?>
                                            <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Nombre de la empresa:</td>
                                                    <td><?php echo $ajuste->nombre;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Dirección:</td>
                                                    <td><?php echo $ajuste->direccion;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Giro:</td>
                                                    <td><?php echo $ajuste->giro;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Registro:</td>
                                                    <td><?php echo $ajuste->registro;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Telefono:</td>
                                                    <td><?php echo $ajuste->telefono;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Correo:</td>
                                                    <td><?php if ($ajuste->correo!="") {
                                                        echo $ajuste->correo;
                                                        
                                                        # code...
                                                    }else{
                                                        echo "ejemplo@ejemplo";
                                                    }

                                                    ?>
                                                    

                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                    <?php $data = $ajuste->nombre."*".$ajuste->direccion."*".$ajuste->giro."*".$ajuste->telefono."*".$ajuste->correo."*".$ajuste->logo."*".$ajuste->id."*".$ajuste->registro ?>
                                    <?php if ($permisos->update == 1) { ?>
                                        <button href="#" class="btn btn-outline-primary mb-3" onclick="editAjuste()" type="button" data-toggle="modal" data-target="#modalAjuste" id="ajuste" value="<?php echo $data;?>"  >Editar</button>
                                    <?php }else{ ?>
                                        <button href="#" class="btn btn-primary" onclick="editAjuste()" disabled type="button" data-toggle="modal" data-target="#modalAjuste" id="ajuste" value="<?php echo $data;?>"  >Editar</button>
                                    <?php } ?>

                                </div>
                            </div>
                    </div>
                        <div class="col-md-4 mt-4">
                            <div class="card card-bordered">
                                <img class="card-img-top img-fluid" src="<?php echo base_url()?>assets/images/ajuste/<?=$ajuste->logo;?>" alt="image">                              
                            </div>
                        </div>
                                    <?php endif;?>
                </div>
    </div>
        

        <div class="modal fade" id="modalAjuste">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

            </div>
            </div>
        </div>
        </div>
        <div class="main-content-inner">
                <div class="row">
                 <!-- data table start -->
                    <div class="col-12 mt-4">
                    <div class="card-area">
                            <div class="card card-bordered">
                                <div class="card-body">
                                <form action="<?php echo base_url();?>ajustes/ajustes/impuestoEdit" method='POST'>
                                    <div class="col-md-3">
                                        <h4 class="page-title pull-left">Impuestos</h4>
                                    </div>
                                        <div class="input-group">                                       
                                            <div class="col-md-3 mt-5"> 
                                                <label>Mostrar código de barra.</label>                     
                                                    <div class="s-swtich">                          
                                                        <input type="checkbox" id="barra_on" name="barra_on"  value="<?php echo $ajuste->codigo;?>" class="form-check-input" >
                                                        <label for="barra_on" class="form-check-label">Activo.</label>
                                                    </div>
                                            </div>
                                           
                                        </div>    
                                        <div class="col-md-12 mt-5"> 
                                             <button type="submit" class="btn btn-outline-primary col mb-3" name="btn-create" >Guardar</button>                                 
                                        </div>   
                                </form>
                                         
                                 </div>
                            </div>
                    </div>
                    </div>
                </div>
        </div>  
                                     </div>
    <?php
    $this->load->view('layouts/alert');
    ?>

<script src="<?php echo base_url();?>assets/js/adminJS/ajustes.js"></script>