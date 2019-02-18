
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
                            <h4 class="page-title pull-left">Agregar Compra</h4>
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
                            <form class="form-control">
                                <div class='form-group col-3'>
                                    <label>Fecha:</label>
                                    <input name='nombre' type="date" class='form-control' >
                                    <label>Proveedor: </label>
                                    <input name='apellido' type='select' class='form-control' >
                                </div>
                            
                    
                            <label class="col-form-control">Buscar Producto:</label>
                            <div class="input-group">
                                    <input class="form-control" type="text">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="button">Buscar</button>
                                </div>
                            </div>
                            <br>
                            <table id="tbCompras" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Precio Entrada</th>
                                        <th>Precio Salida</th>
                                        <th>Cantidad</th>
                                        <th>Importes</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>

                            <div class="form-group row" >
                             <div class="col-sm-6">
                                    <div class="input-group rigth">
                
                                    <div class="alert alert-primary" role="alert">
                                            <div class="input-group-append">
                                            <label class="input-group-text">Total: </label>
                                            <span class="input-group-text">$</span>
                                            <span class="input-group-text">0.00</span>
                                        </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-outline-primary mb-3">Procesar Compra</button>
                                </div>
                            </div>


                            </div>
                        </div>
                    </div>
                </div>
        </div>