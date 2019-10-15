<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Whereis System - Dash</title>
            
        <link rel="shortcut icon" type="image/png" href="<?=base_url('assets/img/favicon.png')?>"/>
        <link href="<?php echo base_url() ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>/assets/css/sb-admin.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() ?>/assets/css/sb-admin.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>/assets/css/bootstrap-select.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/vendor/DataTables/datatables.min.css'?>"/> 	
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/vendor/DataTables/bootstrap_twitter.css'?>"/> 	
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/vendor/DataTables/dataTables.bootstrap4.min.css'?>"/> 	
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/vendor/DataTables/responsive.bootstrap4.min.css'?>"/> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/vendor/alertifyjs/css/alertify.min.css'?>"/> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/vendor/alertifyjs/css/themes/default.min.css'?>"/>
        <script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/vendor/alertifyjs/alertify.min.js'?>" defer></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/vendor/jQuery-Mask-Plugin-master/dist/jquery.mask.js'?>" defer></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/vendor/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js'?>" defer></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/js/main.js' ?>" defer></script>
        <?php $this->load->view($localPath.'style') ?>
    </head>
    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
        <link rel="stylesheet" href="<?=base_url('assets/css/auxiliar.css')?>">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <a class="navbar-brand" href="<?=base_url()?>">Whereis System</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <!--  -->
                <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                        <a class="nav-link" href="<?php echo base_url() ?>">
                            <span class="nav-link-text ml-1">Dashboard</span>
                        </a>
                    </li>
                    <li  class="nav-item" data-toggle="tooltip" data-placement="right" title="Clientes">                    
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseClientes" data-parent="#exampleAccordion">
                            <span class="nav-link-text ml-1">Clientes</span>
                        </a>                    
                        <ul class="sidenav-second-level collapse" id="collapseClientes">
                            <li><a href="<?=base_url('clientes/adicionar')?>">Adicionar</a></li>
                            <li><a href="<?=base_url('clientes/listar')?>">Listar</a></li>
                        </ul>
                    </li>
                    <li  class="nav-item" data-toggle="tooltip" data-placement="right" title="Equipamentos">                    
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseEquipamentos" data-parent="#exampleAccordion">
                            <span class="nav-link-text ml-1">Equipamentos</span>
                        </a>                    
                        <ul class="sidenav-second-level collapse" id="collapseEquipamentos">
                            <li><a href="<?=base_url('equipamentos/adicionar')?>">Adicionar</a></li>
                            <li><a href="<?=base_url('equipamentos/listar')?>">Listar</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="navbar-nav sidenav-toggler">
                    <li class="nav-item">
                        <a class="nav-link text-center" id="sidenavToggler">
                            <i class="fa fa-fw fa-angle-left"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-fw fa-sign-out"></i><span class="ml-1">Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="content-wrapper">
            <div class="container-fluid">