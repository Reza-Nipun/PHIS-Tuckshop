<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Admin_Logout extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
    }


    public function index(){
        redirect('admin_login');
    }


    public function logout(){
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('admin_name');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('login_status');
        session_destroy();

        $sdata=array();
        $sdata['message']='You are successfully Logout';
        $this->session->set_userdata($sdata);
        redirect('admin_login','refresh');
    }
    
    
        
        
    }
    
    ?>