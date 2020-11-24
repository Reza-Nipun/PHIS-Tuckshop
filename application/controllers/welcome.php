<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        
         $this->load->model('admin_login_model');
         
         
         $admin_id = $this->session->userdata('admin_id');

        //echo '----'.$admin_id;
        //exit();
        if ($admin_id == NULL) {
            redirect('admin_login', 'refresh');
        }
        
         
         
    }
    
   

	public function index()
	{
            
            redirect('admin_login');
	}
        
        


        
     public function store_menu() {
        $data = array();
        $data['title'] = 'store';
        $data['main_content'] = $this->load->view('store_menu','', true);
        $this->load->view('home', $data);
    }
        
       
    


    
    
    
        

}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */


