<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html style="background: url(<?php echo base_url(); ?>dist/images/bg_home<?php echo rand(1,4); ?>.jpg) no-repeat center center fixed; ">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema de control y selección de candidatos">
        <meta name="author" content="Grupo NACH">

        <link rel="shortcut icon" href="<?php echo base_url(); ?>dist/images/favicon.png">

        <title>Grupo NACH::.. SIRS - <?php echo $title; ?></title>

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
        
        <?php $ls_rand = rand(); ?>
    	<script src="<?php echo base_url(); ?>dist/js/jquery.min.js<?php echo '?v='.$ls_rand; ?>"></script>
        <script src="<?php echo base_url(); ?>dist/js/bootstrap.min.js<?php echo '?v='.$ls_rand; ?>"></script>
        <script src="<?php echo base_url(); ?>dist/js/waves.js<?php echo '?v='.$ls_rand; ?>"></script>
        <script src="<?php echo base_url(); ?>dist/js/wow.min.js<?php echo '?v='.$ls_rand; ?>"></script>
        <script src="<?php echo base_url(); ?>dist/js/jquery.nicescroll.js<?php echo '?v='.$ls_rand; ?>" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dist/js/jquery.scrollTo.min.js<?php echo '?v='.$ls_rand; ?>"></script>
        <script src="<?php echo base_url(); ?>dist/assets/jquery-detectmobile/detect.js<?php echo '?v='.$ls_rand; ?>"></script>
        <script src="<?php echo base_url(); ?>dist/assets/fastclick/fastclick.js<?php echo '?v='.$ls_rand; ?>"></script>
        <script src="<?php echo base_url(); ?>dist/assets/jquery-slimscroll/jquery.slimscroll.js<?php echo '?v='.$ls_rand; ?>"></script>
        <script src="<?php echo base_url(); ?>dist/assets/jquery-blockui/jquery.blockUI.js<?php echo '?v='.$ls_rand; ?>"></script>
        <script>
            var BASE_URL = '<?php echo base_url(); ?>';
        </script>
        
        <script src="<?php echo base_url(); ?>dist/js/funciones.generales.min.js" type="text/javascript"></script>
 
        
    </head>
    
    <body>