<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>pricing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url();?>assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/metisMenu.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/typography.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/default-css.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/dataTables/css/dataTables.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.css">
   <!-- CSS file -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/easy-autocomplete.min.css"> 

    
    
   
    <!-- modernizr css -->
    <script src="<?php echo base_url();?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
     <!-- jquery latest version -->
     <script src="<?php echo base_url();?>assets/js/vendor/jquery-2.2.4.min.js"></script>
     <script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>
     
     <script type="text/javascript"> 
         var base_url = "http://localhost/inventario/"; //carga la baseurl de todos los js que se cargan de los modulos 
    </script>
</head>

<body>
 <div class="page-container">
            <!-- header area start -->
     <div class="header-area">
        <div class="row align-items-center">
                    <!-- nav and search button -->
                     <div class="col-md-10 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                     </div>
                    <div>
                        <img class="avatar user-thumb" src="<?php echo base_url();?>assets/images/author/avatar.png" alt="avatar">
                    </div>
                    <div class="clearfix">
                        <ul class="notification-area pull-right">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown" style=" color: #000000;">
                                <?php echo $this->session->userdata("nombre")?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Message</a>
                                <a class="dropdown-item" href="<?php echo base_url();?>ajustes/ajustes/index">Ajustes</a>
                                <a class="dropdown-item" href="<?php echo base_url();?>Auth/logout">Cerrar Sesion</a>
                            </div>
                        </div>
        </div>
                    <!-- profile info & task notification -->              
     </div>
 
            <!-- header area end -->

