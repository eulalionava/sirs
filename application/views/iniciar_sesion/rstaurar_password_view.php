<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="wrapper-page">
    <div class="panel panel-color panel-primary panel-pages" style="background-color: rgba(255,255,255, 0.8) !important;">
        <div class="panel-heading bg-img text-center" style="text-align: center !important; padding: 10px !important"> 
            <div class="bg-overlay"></div>
            <h3 class="text-center m-t-10 text-white">
                <img src="<?php echo base_url(); ?>dist/images/NACHlogotipo.png" class="img-responsive">
            </h3>
        </div> 

        <div class="panel-body">
            <form class="form-horizontal" action="#">
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control input-lg " type="text" id="email" required="" placeholder="Correo electrónico" autofocus="">
                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg w-lg waves-effect waves-light" type="button">Recuperar contraseña</button>
                    </div>
                </div>

                <div class="form-group m-t-30">
                    <div class="col-sm-7">
                        <a href="<?php echo base_url(); ?>"><i class="fa fa-lock m-r-5"></i> Iniciar sesión</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>