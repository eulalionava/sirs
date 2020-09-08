<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html style="background-color: #f8f9fc;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema de control y selección de candidatos">
        <meta name="author" content="Grupo NACH">

        <link rel="shortcut icon" href="<?php echo base_url(); ?>dist/images/favicon.png">

        <title><?php echo $title; ?> - SIRS::.. Grupo NACH</title>

        <!-- Base Css Files -->
        <link href="<?php echo base_url(); ?>dist/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Font Icons -->
        <link href="<?php echo base_url(); ?>dist/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>dist/assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>dist/css/material-design-iconic-font.min.css" rel="stylesheet">

        <!-- animate css -->
        <link href="<?php echo base_url(); ?>dist/css/animate.css" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="<?php echo base_url(); ?>dist/css/waves-effect.css" rel="stylesheet">

        <!-- Custom Files -->
        <link href="<?php echo base_url(); ?>dist/css/helper.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>dist/css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url(); ?>dist/js/modernizr.min.js"></script>
        
    </head>



    <body class="fixed-left" style="background-color: #FFF;">
        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="<?php base_url(); ?>" class="logo">
                            <img src="<?php base_url(); ?>dist/images/min_logo.png">
                        </a>
                    </div>
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>
                            <form class="navbar-form pull-left" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control search-bar" placeholder="Buscar aplicativo...">
                                </div>
                                <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                            </form>

                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown hidden-xs">
                                    <a title="Notificaciones" href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                        <i class="md md-notifications"></i> <span class="badge badge-xs badge-danger">0</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="text-center notifi-title">Notificaciones</li>
                                        <li class="list-group">
                                           <!-- list item-->
                                            <li class="text-center notifi-title">
                                                <small>Sin novedad</small>
                                            </li>
                                           <!-- last list item -->
                                            <a href="javascript:void(0);" class="list-group-item">
                                              <small>Ver todas</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" title="Pantalla completa" id="btn-fullscreen" class="waves-effect waves-light">
                                        <i class="md md-crop-free"></i>
                                    </a>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" title="Mis candidato" class="right-bar-toggle waves-effect waves-light">
                                        <i class="md md-assignment-ind"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div class="user-details">
                        <div class="pull-left">
                            <img src="<?php echo base_url($this->session->userdata['ruta_foto']); ?>" alt="" class="thumb-md img-circle">
                        </div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $this->session->userdata['usuario']; ?><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Perfil<div class="ripple-wrapper"></div></a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-settings"></i> Configuraciones</a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-lock"></i> Bloquear</a></li>
                                    <li><a href="<?php echo base_url(); ?>finalizar-sesion"><i class="md md-settings-power"></i> Cerrar sesión</a></li>
                                </ul>
                            </div>
                            
                            <p class="text-muted m-0"><?php echo $this->session->userdata['tipo_persona_desc']; ?></p>
                        </div>
                    </div>
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                            <li>
                                <a href="<?php echo base_url(); ?>panel-principal" class="waves-effect"><i class="md md-home"></i><span> Principal </span></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <?php echo $content; ?>