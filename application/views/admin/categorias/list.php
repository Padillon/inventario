

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
<div class="main-content-inner">
                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Lista - Categorias</h4>
                                <button type="button" id="btnAgregar" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#modalCategoria"> Agregar+</button>
                                <div class="data-tables">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">

                     <thead  >
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $cont = 0;?>
                                <?php if(!empty($categoria)):?>
                                    <?php foreach($categoria as $cat):?>
                                    <?php $cont++;?>
                                        <tr>
                                            <td><?php echo $cat->id_categoria;?></td>
                                            <td><?php echo $cat->nombre;?></td>
                                            <td>
                                                <div class="btn-group">
                                                <?php $data = $cat->id_categoria."*".$cat->nombre ?>
                                                <button id="edit<?php echo $cont;?>" type="button" onclick="editCategoria(<?php echo $cont;?>)" class="btn btn-info" data-toggle="modal" data-target="#modalCategoria" value="<?php echo $data;?>">
                                                    <span span class="fa fa-pencil" style="color: #fff"></span>
                                                </button>
                                                <button id="delete<?php echo $cont; ?>" onclick="deleteCategoria(<?php echo $cont; ?>)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalCategoria" value="<?php echo $data;?>" >
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
    <div class="modal fade" id="modalCategoria">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">

        </div>
     </div>
    </div>

<script type="text/javascript">

function editCategoria(num){
    valores = $("#delete"+num).val();
    datos = valores.split("*");

    var html = "";
    html = "<form action='<?php echo base_url();?>mantenimiento/categorias/update' method='POST'>";
    html += "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    html += "</form>";
    $("#modalCategoria .modal-content").html(html);

    $("#modalCategoria .modal-title").html("Editar");

    var html2 = "";
    html2 = "<label>Nombre de la categoria</label>";
    html2 += "<input name='editName' id='name' type='text' class='form-control' value='"+datos[1]+"'>";
    html2 += "<input name='idCategoria' id='idCategoria' type='hidden' value='"+datos[0]+" class='form-control'>";
    $("#modalCategoria .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    html3 += "<button type='submit' class='btn btn-primary'>Actualizar</button>";
    $("#modalCategoria .modal-footer").html(html3);

};

function deleteCategoria(num){
    valores = $("#delete"+num).val();
    datos = valores.split("*");

    var html = "";
    html = "<form action='<?php echo base_url();?>mantenimiento/categorias/delete' method='POST'>";
    html += "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    html += "</form>";
    $("#modalCategoria .modal-content").html(html);

    $("#modalCategoria .modal-title").html("Eliminar");

    var html2 = "";
    html2 = "<label>Nombre de la categoria</label>";
    html2 += "<input name='nombre' id='name' type='text' class='form-control' value='"+datos[1]+"'>";
    html2 += "<input name='idCategoriaDelete' id='idCategoria' type='hidden' value='"+datos[0]+" class='form-control'>";
    $("#modalCategoria .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    html3 += "<button type='submit' class='btn btn-primary'>Borrar</button>";
    $("#modalCategoria .modal-footer").html(html3);

};

$("#btnAgregar").on("click", function(){
    var html = "";
    html = "<form action='<?php echo base_url();?>mantenimiento/categorias/store' method='POST'>";
    html += "<div class='modal-header'>";
    html += "<h5 class='modal-title'></h5>";
    html += "<button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>";
    html += "</div>";
    html += "<div class='modal-body'>";
    html += "</div>";
    html += "<div class='modal-footer'>";
    html += "</div>";
    html += "</form>";
    $("#modalCategoria .modal-content").html(html);

    $("#modalCategoria .modal-title").html("Agregar");

    var html2 = "";
    html2 = "<label>Nombre de la categoria</label>";
    html2 += "<input name='name' type='text' class='form-control' placeholder='Ingrese nombre'>";
    $("#modalCategoria .modal-body").html(html2);

    var html3 = "";
    html3 = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    html3 += "<button type='submit' class='btn btn-primary'>Guardar</button>";
    $("#modalCategoria .modal-footer").html(html3);
});

</script>
