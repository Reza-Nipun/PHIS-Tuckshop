<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Admin_Login extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();

        $this->load->model('admin_login_model');

        $admin_id = $this->session->userdata('admin_id');

        //echo '----'.$admin_id;
        //exit();
        if ($admin_id != NULL) {
            redirect('store_category', 'refresh');
        }
    }

    public function index() {
        $this->load->view('login');
    }

    public function check_administrator() {

        $email = $this->input->post('admin_email_address', true);
        $password = $this->input->post('admin_password', true);

        //echo $admin_email_address ." ".$admin_password ;
        //exit();
        $result = $this->admin_login_model->check_admin_login_info($email, $password);

        //echo '<pre>';
        //print_r($result);
        //exit();

        if ($result) {
            $sdata = array();
            $sdata['admin_id'] = $result->admin_id;
            $sdata['admin_name'] = $result->name;
            $sdata['role']=$result->role;
            $sdata['login_status'] = TRUE;
            $this->session->set_userdata($sdata);
            redirect('store_category', 'refresh');
        } else {
            $sdata = array();
            $sdata['exception'] = 'User Id/ password Invalide';
            $this->session->set_userdata($sdata);

            //redirect('store_category','refresh');
            redirect('admin_login');
        }
    }

}

?>
