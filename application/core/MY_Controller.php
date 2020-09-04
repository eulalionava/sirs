<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        /*if(!$this->session->has_userdata('id') || !$this->session->id){
            redirect(base_url(), 'refresh', 401);
        }*/       
     }
}
