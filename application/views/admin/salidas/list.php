
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
                            <h4 class="page-title pull-left">Ventas</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Movimientos</span></li>
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
$habilitado_edit = "disabled";

if ($permisos->update == 1) {
    $habilitado_update ="enabled";
}

if ($permisos->delete == 1) {
    $habilitado_delete = "enabled";
}
if ($permisos->insert == 1) {
    $habilitado_insert = "enabled";
}

if ($permisos->update == 1){
    $habilitado_edit = "enabled";
}

?>
<div class="main-content-inner">
                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Lista - Salidas</h4>
                            <div class="input-group">
                                        <div class="col-md-2">
                                            <a href="<?php echo base_url();?>movimientos/salidas/add"  <?php echo $habilitado_insert?> class="btn btn-outline-primary mb-3">Vender +</a>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="<?php echo base_url();?>movimientos/salidas/buscar" class="btn btn-outline-primary mb-3">Buscar</a>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="btn-group" role="group" style="text-align: right;">
                                                <button id="btnGroupDrop2" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Reporte
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                                    <button type="button" id="btnGenerarFecha" class="dropdown-item" data-toggle="modal" data-target="#PDFPorFecha">Por Fechas</button>
                                                    <button type="button" id="btnGenerarCliente" class="dropdown-item" data-toggle="modal" data-target="#PDFPorCliente">Por Cliente</button>
                                                    <button type="button" id="btnGenerarResumen" class="dropdown-item" data-toggle="modal" data-target="#PDFTotalResumen">Resumen</button>
                                                    <button type="button" id="btnGenerarInactivos" class="dropdown-item">Anuladas</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    <div class="data-tables">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">

                     <thead  >
                                <tr>
                                <th id="#">#</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Encargado</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $cont = 0;?>
                                <?php if(!empty($salidas)):?>
                                    <?php foreach($salidas as $sal):?>
                                    <?php $cont++;?>
                                        <tr>
                                            <td><?php echo $sal->id_salida;?></td>
                                            <td><?php echo $sal->fecha;?></td>
                                            <td><?php echo $sal->nombre." ".$sal->apellido;?></td>
                                            <td><?php echo $sal->usuario;?></td>
                                            <td><?php echo "$ ".$sal->total;?></td>
                                            <?php if($sal->estado == 1){?>
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
                                                <?php $data = $sal->id_salida; ?>
                                                <button value="<?php echo $sal->id_salida;?>" type="button" class="btn btn-info btn-view-salida" data-toggle="modal" data-target="#modalView">
                                                    <span span class="fa fa-search" style="color: #fff"></span>
                                                </button>
                                                <button name='eliminar' id="<?php echo $sal->id_salida;?>" type="button"  <?php echo $habilitado_delete?> class="btn btn-danger eliminar_data" data-toggle="modal" data-target="#eliminar" >
                                                        <span class="fa fa-times" style="color: #fff"></span>
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
        <?php
    $this->load->view('layouts/alert');
    ?>

<!-- Modal ver-->
<div class="modal fade" id="modalView">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form-control" id="formEditar">
                <div class='modal-header'>
                    <h5 class='modal-title'>Informacion</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                   
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>
                </div>
            </form>
        </div>
     </div>
</div>

<!-- Modal Delete-->
<div class="modal fade" id="eliminar">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ti-cabeza">Eliminar</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url();?>movimientos/salidas/eliminar" method="POST">
                    <h4 id="titulo">Está seguro de anular esta venta?</H4>
                    <input id="id-salida-delete" name="id-salida-delete" type="hidden" class="form-control" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="g-edit" name="g-edit"class="btn btn-primary">Aceptar</button>
                </form> 
            </div>
        </div>
    </div>
</div>

 <!-- Modal para elegir Fechas-->
<div class="modal fade" id="PDFPorFecha">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ti-cabeza">Reporte</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-auto">
                    <label for="elegirMarca">Del:</label>        
                    <input type="date" class="form-control" id="fecha1" required>
                </div>
                <div class="col-md-auto">
                    <label for="elegirMarca">Al:</label>        
                    <input type="date" class="form-control" id="fecha2" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnelegirFecha" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

 <!-- Modal para elegir Clientes-->
 <div class="modal fade" id="PDFPorCliente">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ti-cabeza">Reporte</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-auto">
                    <label>Del:</label>        
                    <input type="date" class="form-control" id="fecha1Cli" required>
                </div>
                <div class="col-md-auto">
                    <label>Al:</label>        
                    <input type="date" class="form-control" id="fecha2Cli" required>
                </div>
                <div class="col-md-auto">
                    <label>Elija el Cliente:</label>        
                    <select id='txtElegirCliente' class='custom-select' required>
                            <?php foreach($clientes as $cli):?>
                                <option value='<?php echo $cli->id_cliente;?>'><?php echo $cli->nombre." ".$cli->apellido;?></option>
                            <?php endforeach;?>
                </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnelegirCliente" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

 <!-- Modal para elegir Fechas para agrupar por dia-->
 <div class="modal fade" id="PDFTotalResumen">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ti-cabeza">Reporte</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-auto">
                    <label for="elegirMarca">Del:</label>        
                    <input type="date" class="form-control" id="fecha1Res" required>
                </div>
                <div class="col-md-auto">
                    <label for="elegirMarca">Al:</label>        
                    <input type="date" class="form-control" id="fecha2Res" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnResumen" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/js/adminJS/salidas.js">
</script>

<script>//Cargar de manera desc los datos de la tabla
$(window).load(function () {
    document.getElementById("#").click();     
});
</script>