
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Kardex</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Movimientos</span></li>
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
                                        <div class='input-group'> 
                                            <div class='col-md-3'>
                                                <label>Del:</label>
                                                <input name='fecha_inicio' id='fecha_inicio' type="date" value="<?php echo date("Y-m-d");?>" class='form-control' >
                                            </div>
                                            <div class='col-md-3'>
                                                <label>Al:</label>
                                                <input name='fecha_fin' id='fecha_fin' type="date" value="<?php echo date("Y-m-d");?>" class='form-control' >
                                            </div>
                                            <div class='col-md-6'>
                                                <label class="col-form-control">Buscar Producto:</label>
                                                <input name="autocompleteProducto" class="form-control" type="text" id="autocompleteProducto">
                                            </div>           
                                        </div>                       
                                        <br>
                                        <div class='col-md-6'>
                                                <label class="col-form-control">Producto:</label>
                                                <input class="form-control" type="text" id="txtProd" disabled>
                                            </div>
                                        <div class="col-md-12">                
                                            <br>
                                            <table id="tabla_kardex"   class="table table-bordered table-striped table-hover table-responsive" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class='col-md-2'>#</th>
                                                        <th class='col-md-2'>Fecha</th>
                                                        <th class='col-md-2'>Tipo</th>
                                                        <th class='col-md-2'>Descripcion</th>
                                                        <th class='col-md-2'>Encargado</th>
                                                        <th class='col-md-2'>Cantidad</th>
                                                        <th class='col-md-2'>Saldo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                                               
                                                </tbody>
                                            </table>
                                        </div>             
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/js/adminJS/kardex.js"></script>
