
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
                                <li><span>Registros</span></li>
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
                                <h4 class="header-title">Lista - Clientes</h4>
                                <button type="button" id="btnAgregar" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#modalCliente"> Agregar+</button>
                                <div class="data-tables">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">

                     <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Direccion</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $cont = 0;?>
                                <?php if(!empty($clientes)):?>
                                    <?php foreach($clientes as $cli):?>
                                    <?php $cont++;?>
                                        <tr>
                                            <td><?php echo $cli->id_cliente;?></td>
                                            <td><?php echo $cli->nombre;?></td>
                                            <td><?php echo $cli->apellido;?></td>
                                            <td><?php echo $cli->direccion;?></td>
                                            <?php if($cli->estado == 1){?>
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
                                                <?php $data = $cli->id_cliente."*".$cli->nombre."*".$cli->apellido.
                                                    "*".$cli->nit."*".$cli->telefono."*".$cli->registro."*".$cli->direccion."*".$cli->estado; ?>
                                                <button id="view<?php echo $cont;?>" type="button" onclick="viewCliente(<?php echo $cont;?>)" class="btn btn-info" data-toggle="modal" data-target="#modalCliente" value="<?php echo $data;?>">
                                                    <span class="fa fa-search" style="color: #fff"></span>
                                                </button>
                                                <button id="edit<?php echo $cont;?>" type="button" onclick="editCliente(<?php echo $cont;?>)" class="btn btn-warning" data-toggle="modal" data-target="#modalCliente" value="<?php echo $data;?>">
                                                    <span span class="fa fa-pencil" style="color: #fff"></span>
                                                </button>
                                                <button id="delete<?php echo $cont; ?>" onclick="deleteCliente(<?php echo $cont; ?>)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalCliente" value="<?php echo $data;?>" >
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
    <!-- page container area end -->

    <!-- Modal Categorias-->
    <div class="modal fade" id="modalCliente">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">

        </div>
     </div>
    </div>

<script type="text/javascript">

function viewCliente(num){
    valores = $("#view"+num).val();
    datos = valores.split("*");

    var html = "";
    html = "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    $("#modalCliente .modal-content").html(html);

    $("#modalCliente .modal-title").html("Información del cliente");

    var html2 = "";
    html2 = "<div class='form-group'><label>Nombre:</label>";
    html2 += "<input name='nombre' type='text' class='form-control' value='"+datos[1]+"' disabled></div>";
    html2 += "<div class='form-group'><label>Apellidos: </label>";
    html2 += "<input name='apellido' type='text' class='form-control' value='"+datos[2]+"' disabled></div>";
    html2 += "<div class='form-group'><label>NIT:</label>";
    html2 += "<input name='nit' type='text' class='form-control' value='"+datos[3]+"' disabled></div>";
    html2 += "<div class='form-group'><label>Telefono:</label>";
    html2 += "<input name='telefono' type='text' class='form-control' value='"+datos[4]+"' disabled></div>";
    html2 += "<div class='form-group'><label>Registro</label>";
    html2 += "<input name='registro' type='text' class='form-control' value='"+datos[5]+"' disabled></div>";
    html2 += "<div class='form-group'><label>Dirección:</label>";
    html2 += "<input name='direccion' type='text' class='form-control' value='"+datos[6]+"' disabled></div>";
    html2 += "<div class='form-group'><label>Estado:</label>";
    if (datos[7] == 1){
        html2 += "<div class='alert alert-primary' role='alert'><strong>Activo</strong></div>";
    } else{
        html2 += "<div class='alert alert-danger' role='alert'><strong>Inactivo</strong></div>";
    }
    $("#modalCliente .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>";
    $("#modalCliente .modal-footer").html(html3);

};

function editCliente(num){
    valores = $("#edit"+num).val();
    datos = valores.split("*");

    var html = "";
    html = "<form action='<?php echo base_url();?>mantenimiento/clientes/update' method='POST'>";
    html += "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    html += "</form>";
    $("#modalCliente .modal-content").html(html);

    $("#modalCliente .modal-title").html("Editar");

    var html2 = "";
    html2 = "<div class='form-group'><label>Nombre:</label>";
    html2 += "<input name='idCliente' type='hidden' value='"+datos[0]+" class='form-control'>";
    html2 += "<input name='nombre' type='text' class='form-control' value='"+datos[1]+"'></div>";
    html2 += "<div class='form-group'><label>Apellidos: </label>";
    html2 += "<input name='apellido' type='text' class='form-control' value='"+datos[2]+"'></div>";
    html2 += "<div class='form-group'><label>NIT:</label>";
    html2 += "<input name='nit' type='text' class='form-control' value='"+datos[3]+"'></div>";
    html2 += "<div class='form-group'><label>Telefono:</label>";
    html2 += "<input name='telefono' type='text' class='form-control' value='"+datos[4]+"'></div>";
    html2 += "<div class='form-group'><label>Registro</label>";
    html2 += "<input name='registro' type='text' class='form-control' value='"+datos[5]+"'></div>";
    html2 += "<div class='form-group'><label>Dirección:</label>";
    html2 += "<input name='direccion' type='text' class='form-control' value='"+datos[6]+"'></div>";
    $("#modalCliente .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    html3 += "<button type='submit' class='btn btn-primary'>Actualizar</button>";
    $("#modalCliente .modal-footer").html(html3);

};


function deleteCliente(num){
    valores = $("#delete"+num).val();
    datos = valores.split("*");

    var html = "";
    html = "<form action='<?php echo base_url();?>mantenimiento/clientes/delete' method='POST'>";
    html += "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    html += "</form>";
    $("#modalCliente .modal-content").html(html);

    $("#modalCliente .modal-title").html("Eliminar");

    var html2 = "";
    html2 = "<div class='form-group'><label>Nombre:</label>";
    html2 += "<input name='idCliente' type='hidden' value='"+datos[0]+" class='form-control'>";
    html2 += "<input name='nombre' type='text' class='form-control' value='"+datos[1]+"'></div>";
    html2 += "<div class='form-group'><label>Apellidos: </label>";
    html2 += "<input name='apellido' type='text' class='form-control' value='"+datos[2]+"'></div>";
    $("#modalCliente .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    html3 += "<button type='submit' class='btn btn-danger'>Borrar</button>";
    $("#modalCliente .modal-footer").html(html3);

};

$("#btnAgregar").on("click", function(){
    var html = "";
    html = "<form action='<?php echo base_url();?>mantenimiento/clientes/store' method='POST'>";
    html += "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    html += "</form>";
    $("#modalCliente .modal-content").html(html);

    $("#modalCliente .modal-title").html("Agregar");

    var html2 = "";
    html2 = "<div class='form-group'><label>Nombre:</label>";
    html2 += "<input name='nombre' type='text' class='form-control' ></div>";
    html2 += "<div class='form-group'><label>Apellidos: </label>";
    html2 += "<input name='apellido' type='text' class='form-control' ></div>";
    html2 += "<div class='form-group'><label>NIT:</label>";
    html2 += "<input name='nit' type='text' class='form-control' ></div>";
    html2 += "<div class='form-group'><label>Telefono:</label>";
    html2 += "<input name='telefono' type='text' class='form-control' ></div>";
    html2 += "<div class='form-group'><label>Registro</label>";
    html2 += "<input name='registro' type='text' class='form-control' ></div>";
    html2 += "<div class='form-group'><label>Dirección:</label>";
    html2 += "<input name='direccion' type='text' class='form-control' ></div>";
    $("#modalCliente .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    html3 += "<button type='submit' class='btn btn-primary'>Guardar</button>";
    $("#modalCliente .modal-footer").html(html3);
});

</script>
