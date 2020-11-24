<?php

session_start();

class Store_Category extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('store_category_model');
        
        
        
        $admin_id = $this->session->userdata('admin_id');

        //echo '----'.$admin_id;
        //exit();
        if ($admin_id == NULL) {
            redirect('admin_login', 'refresh');
        }
        
        
    }

    public function index() {
        $data = array();
        //$data['all_catecory'] = $this->store_category_model->select_all_category();

        $data['title'] = 'Home';
        $data['main_content'] = $this->load->view('home_menu', '', true);
        $this->load->view('home', $data);
    }

    
    // Category Add/ Save / Edit / Delete /  ....................
    
    public function add_category_form(){
        $data=array();
        $data['title']='Add Category';
        $data['main_content'] = $this->load->view('add_category_form', '', true);
        $this->load->view('home', $data);
    }
    
    public function save_category() {
        $data = array();
        $data['product_id'] = $this->input->post('product_id', true);
        $data['product_name'] = $this->input->post('product_name', true);
        $data['brand'] = $this->input->post('brand', true);
        $data['weight'] = $this->input->post('weight', true);

        $this->store_category_model->save_category_info($data);

        $sdata = array();
        $sdata['message'] = 'Category information saved successfully !';
        $this->session->set_userdata($sdata);
        redirect('store_category/add_category_form');
    }
    
    
    public function view_category() {
        
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'store_category/view_category';
        $config['total_rows'] = $this->db->count_all('tbl_category');
        $config['per_page'] = '20';
        $config['page_tag_open'] = '<p>';
        $config['page_tag_close'] = '</p>';
        $this->pagination->initialize($config);
        
        $data = array();
        $data['title'] = 'Category Preview';
        $data['category'] = $this->store_category_model->view_all_category($config['per_page'], $this->uri->segment(3));
        $data['main_content'] = $this->load->view('view_category', $data, TRUE);
        $this->load->view('home', $data);
    }
    
    // Customer Add/ Save / Edit / Delete /  ....................
    
    public function add_customer_form(){
        $data=array();
        $data['title']='Add Customer';
        $data['main_content'] = $this->load->view('add_customer_form', '', true);
        $this->load->view('home', $data);
    }
    
    public function isCustomerExists() {
        $customer_id = $this->input->post('customer_id', true);

        $isCustomerExist = $this->store_category_model->isCustomerExists($customer_id);

        if(!empty($isCustomerExist)){
            echo 'Exist!';
        }else{
            echo 'Not Exists!';
        }
    }

    public function isProductExists() {
        $product_id = $this->input->post('product_id', true);

        $isProductExists = $this->store_category_model->isProductExists($product_id);

        if(!empty($isProductExists)){
            echo 'Exist!';
        }else{
            echo 'Not Exists!';
        }
    }

    public function save_customer() {
        $data = array();
        $data['customer_id'] = $this->input->post('customer_id', true);
        $data['customer_name'] = $this->input->post('customer_name', true);
        $data['email'] = $this->input->post('email', true);
        $data['designation'] = $this->input->post('designation', true);
        $data['status'] = $this->input->post('status', true);

        $this->store_category_model->save_customer_info($data);

        $sdata = array();
        $sdata['message'] = 'Category information saved successfully !';
        $this->session->set_userdata($sdata);
        redirect('store_category/add_customer_form');
    }
    
    public function view_customer(){
        
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'store_category/view_customer';
        $config['total_rows'] = $this->db->count_all('tbl_customer');
        $config['per_page'] = '20';
        $config['page_tag_open'] = '<p>';
        $config['page_tag_close'] = '</p>';
        $this->pagination->initialize($config);
        
        $data=array();
        $data['title']='View Employee';
        $data['customer_info']=$this->store_category_model->view_all_customer($config['per_page'], $this->uri->segment(3));
        $data['main_content'] = $this->load->view('view_customer', $data, true);
        $this->load->view('home', $data);
    }
    
    //Search customer  
        public function search_customer() {
        
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'store_category/search_customer';
        $config['total_rows'] = $this->db->count_all('tbl_customer');
        $config['per_page'] = '10';
        $config['page_tag_open'] = '<p>';
        $config['page_tag_close'] = '</p>';
        $this->pagination->initialize($config);

        $data = array();
        $data['title'] = 'Search Customer';
        $customer_id = $this->input->post('customer_id');
        $data['customer_info'] = $this->store_category_model->search_customer_by_customer_id($customer_id,$config['per_page'], $this->uri->segment(3));
        $data['main_content'] = $this->load->view('view_customer', $data, true);
        $this->load->view('home', $data);
    }
    
    
    
    
    public function add_product_form() {
        $data = array();
        $data['title'] = 'Add Product';
        $data['main_content'] = $this->load->view('add_product_form', $data, true);
        $this->load->view('home', $data);
    }
    
    public function Save_store_product() {
       
        $date = $this->input->post('date', true);
        $product_id = $this->input->post('product_id', true);
        $quantity = $this->input->post('quantity', true);
        $source = $this->input->post('source', true);
        
         foreach ($product_id as $key => $value) {
            $data[] = array(
                'date' => $date['0'],
                'product_id' => $product_id[$key],
                'quantity' => $quantity[$key],
                'source'=> $source['0']
            );
        }
        $this->store_category_model->save_store_product_info($data);
        
        $sdata=array();
        $sdata['message']='Your Item Successfully Added to Store';
        $this->session->set_userdata($sdata);
       
        redirect('store_category/add_product_form');
        
        
        
        /*
        
        $this->store_category_model->save_store_product_info_check($data, $key);
        
        echo '<pre>';
        print_r($result);
        exit();
        
        if (TRUE) {
            $sdata = array();
            $sdata['message'] = 'valid id';
            
            $this->session->set_userdata($sdata);
            redirect('store_category/add_product_form');
        } else {
            $sdata = array();
            $sdata['message'] = 'Invalide Product ID';
            $this->session->set_userdata($sdata);
            redirect('store_category/add_product_form');
        }
        */
        
       
        
    }
    
    public function product_preview() {
        $data = array();
        $data['title'] = 'Product Preview';

        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'store_category/product_preview/';
        $config['total_rows'] = $this->db->count_all('tbl_store');
        $config['per_page'] = '20';
        $config['page_tag_open'] = '<p>';
        $config['page_tag_close'] = '</p>';
        $this->pagination->initialize($config);

        $data['item_info'] = $this->store_category_model->view_all_product($config['per_page'], $this->uri->segment(3));

        $data['main_content'] = $this->load->view('view_all_product', $data, true);
        $this->load->view('home', $data);
    }
    
	
 	public function sales_form(){
        $data = array();
        $data['title'] = 'Sales Product';
        $data['student_list'] = $this->store_category_model->datalist_all_student();
	    $data['main_content'] = $this->load->view('add_sales_form', $data, true);
        $this->load->view('home', $data);
    }

    public function sales_invoice_print($sale_ids){

        $implode_sale_ids = implode(", ",$sale_ids);
        $data['title'] = 'Sales Product';
        $data['sales_detail'] = $this->store_category_model->salesProdDetail($implode_sale_ids);
        $this->load->view('print_sales_invoice', $data);
    }
    
    public function save_sales_product(){
        $sales_ids = array();

        $date = $this->input->post('date');
        $customer_id = $this->input->post('customer_id');
        $product_id = $this->input->post('product_id');
        $quantity = $this->input->post('quantity');
        $unit_price = $this->input->post('unit_price');
        
        
         foreach ($product_id as $key => $value) {
            $data = array(
                'date' => $date['0'],
                'customer_id' => $customer_id['0'],
                'product_id' => $product_id[$key],
                'quantity' => $quantity[$key],
                'unit_price' => $unit_price[$key],
                'total_price'=> $unit_price[$key]*$quantity[$key]
            );

             $sales_id = $this->store_category_model->save_sales_product_info($data);
             array_push($sales_ids, $sales_id);
        }

//        $sdata=array();
//        $sdata['message']='Your product Successfully sales';
//        $this->session->set_userdata($sdata);
//
//        redirect('store_category/sales_form');

        $this->sales_invoice_print($sales_ids);


    }
    
    public function sales_preview(){
        $data = array();
        $data['title'] = 'Sales Preview';

        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'store_category/sales_preview/';
        $config['total_rows'] = $this->db->count_all('tbl_sales');
        $config['per_page'] = '15';
        $config['page_tag_open'] = '<p>';
        $config['page_tag_close'] = '</p>';
        $this->pagination->initialize($config);

        $data['item_info'] = $this->store_category_model->view_all_sales($config['per_page'], $this->uri->segment(3));

        $data['main_content'] = $this->load->view('view_all_sales', $data, true);
        $this->load->view('home', $data);
    }
    
    /// deposit
    
    public function add_deposit_form(){
        $data = array();
        $data['title'] = 'Deposit Product';
        $data['main_content'] = $this->load->view('add_deposit_form', $data, true);
        $this->load->view('home', $data);
    }
    
    public function save_deposit(){
       $data = array();
        $data['date'] = $this->input->post('date', true);
        $data['customer_id'] = $this->input->post('customer_id', true);
        $data['deposit_amount'] = $this->input->post('deposit_amount', true);
        
        $this->store_category_model->save_deposit_info($data);
        
        $sdata=array();
        $sdata['message']='Your Deposit Successfully Saved';
        $this->session->set_userdata($sdata);
       
        redirect('store_category/add_deposit_form'); 
    }
    
    public function deposit_preview(){
        $data = array();
        $data['title'] = 'Deposit Preview';

        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'store_category/deposit_preview/';
        $config['total_rows'] = $this->db->count_all('tbl_customer');
        $config['per_page'] = '20';
        $config['page_tag_open'] = '<p>';
        $config['page_tag_close'] = '</p>';
        $this->pagination->initialize($config);

        $data['item_info'] = $this->store_category_model->view_all_deposit($config['per_page'], $this->uri->segment(3));

        $data['main_content'] = $this->load->view('view_deposit', $data, true);
        $this->load->view('home', $data);
    }
    
	
  
  // Added by Liza for to serach Deposit History of a particular Student.  
    public function deposit_history_search_entry(){
	   $data = array();
	   $data['title'] = 'Search Deposit History';
       $data['student_list'] = $this->store_category_model->datalist_all_student();
       $data['main_content'] = $this->load->view('view_deposit_history1', $data, true);
       $this->load->view('home', $data);
    }
	
	public function deposit_balance_history(){
	   $data = array();
	   $data['title'] = 'Search Deposit History';
       $data['student_list'] = $this->store_category_model->datalist_all_student();
	   $data['students_info'] = $this->store_category_model->getDepositors();
       $data['main_content'] = $this->load->view('view_deposit_history3', $data, true);
       $this->load->view('home', $data);
    }
	
	
    public function deposit_history_search() {
        
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'store_category/deposit_history_search/';
        //$config['total_rows'] = $this->db->count_all('tbl_distribute');
        $config['per_page'] = '10';
        $config['page_tag_open'] = '<p>';
        $config['page_tag_close'] = '</p>';
        $this->pagination->initialize($config);

        $data = array();
	    $data['title'] = 'Search Deposit History';
        $student_idm = $this->input->post('student_id');
		
		
		$student_idm = explode("~", $student_idm);
		$student_id = $student_idm[0];
		
        $data['student_id'] = $student_idm;
        $data['student_list'] = $this->store_category_model->datalist_all_student();
	    $data['student_info'] = $this->store_category_model->search_depositor_by_student_id($student_id);
	    $data['item_info'] = $this->store_category_model->search_deposit_by_student_id($student_id,$config['per_page'], $this->uri->segment(3));
		
      $data['main_content'] = $this->load->view('view_deposit_history2', $data, true);
      $this->load->view('home', $data);
    }
	
		
    
  // End of serach Deposit History of a particular Student.


    public function search_depositer() {
        
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'store_category/search_depositer/';
        //$config['total_rows'] = $this->db->count_all('tbl_distribute');
        $config['per_page'] = '10';
        $config['page_tag_open'] = '<p>';
        $config['page_tag_close'] = '</p>';
        $this->pagination->initialize($config);

        $data = array();
        $data['title'] = 'Deposit Preview';
        $customer_id = $this->input->post('customer_id');
        $data['item_info'] = $this->store_category_model->search_deposit_by_product_id($customer_id,$config['per_page'], $this->uri->segment(3));
        $data['main_content'] = $this->load->view('view_deposit', $data, true);
        $this->load->view('home', $data);
    }
    
    
    // Inventory Details ..............
    public function inventory_preview(){
        $data = array();
        $data['title'] = 'Inventory Preview';

        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'store_category/inventory_preview/';
        $config['total_rows'] = $this->db->count_all('tbl_category');
        $config['per_page'] = '20';
        $config['page_tag_open'] = '<p>';
        $config['page_tag_close'] = '</p>';
        $this->pagination->initialize($config);

        $data['item_info'] = $this->store_category_model->view_all_inventory($config['per_page'], $this->uri->segment(3));

        $data['main_content'] = $this->load->view('view_inventory', $data, true);
        $this->load->view('home', $data);
    }
    
    // search inventory
    public function search_inventory(){
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'store_category/search_inventory/';
        //$config['total_rows'] = $this->db->count_all('tbl_distribute');
        $config['per_page'] = '15';
        $config['page_tag_open'] = '<p>';
        $config['page_tag_close'] = '</p>';
        $this->pagination->initialize($config);

        $data = array();
        $data['title'] = 'Received Item Preview';
        $product_name = $this->input->post('product_name');
        $data['item_info'] = $this->store_category_model->search_inventory_by_name($product_name,$config['per_page'], $this->uri->segment(3));
        $data['main_content'] = $this->load->view('view_inventory', $data, true);
        $this->load->view('home', $data);
    }







    // Search ...........
    
 
       
    
    
    
    public function search_by_product_name_sales_preview() {
        
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'store_category/search_by_product_name_sales_preview/';
        //$config['total_rows'] = $this->db->count_all('tbl_distribute');
        $config['per_page'] = '15';
        $config['page_tag_open'] = '<p>';
        $config['page_tag_close'] = '</p>';
        $this->pagination->initialize($config);

        $data = array();
        $data['title'] = 'Received Item Preview';
        $product_name = $this->input->post('product_name');
        $data['item_info'] = $this->store_category_model->search_by_product_name_sales($product_name);
        $data['main_content'] = $this->load->view('view_all_sales', $data, true);
        $this->load->view('home', $data);
    }
    
    
    public function search_by_date_sales_item_preview(){
       $this->load->library('pagination');
        $config['base_url'] = base_url() . 'store_category/search_by_date_sales_item_preview/';
        //$config['total_rows'] = $this->db->count_all('tbl_distribute');
        $config['per_page'] = '15';
        $config['page_tag_open'] = '<p>';
        $config['page_tag_close'] = '</p>';
        $this->pagination->initialize($config);

        $data = array();
        $data['title'] = 'Received Item Preview';
        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');
        $data['item_info'] = $this->store_category_model->search_by_date_sales_info($date1, $date2);
        $data['main_content'] = $this->load->view('view_all_sales', $data, true);
        $this->load->view('home', $data); 
    }
    
    
    public function search_name_with_date_sales_preview(){
        
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'store_category/search_name_with_date_sales_preview/';
        //$config['total_rows'] = $this->db->count_all('tbl_distribute');
        $config['per_page'] = '15';
        $config['page_tag_open'] = '<p>';
        $config['page_tag_close'] = '</p>';
        $this->pagination->initialize($config);
        
        $data=array();
        $data['title'] = 'Sales Item Preview';
        $data['product_name']=$this->input->post('product_name');
        $data['date1']=$this->input->post('date1');
        $data['date2'] = $this->input->post('date2');

        $data['item_info'] = $this->store_category_model->search_Product_name_and_date($data);
        $data['main_content'] = $this->load->view('view_all_sales', $data, true);
        $this->load->view('home', $data);
    }
    
    
    public function search_id_with_date_sales_preview(){
        
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'store_category/search_id_with_date_sales_preview';
        //$config['total_rows'] = $this->db->count_all('tbl_distribute');
        $config['per_page'] = '15';
        $config['page_tag_open'] = '<p>';
        $config['page_tag_close'] = '</p>';
        $this->pagination->initialize($config);
        
        $data=array();
        $data['title'] = 'Sales Item Preview';
        $data['customer_id']=$this->input->post('customer_id');
        $data['date1']=$this->input->post('date1');
        $data['date2'] = $this->input->post('date2');

        $data['item_info'] = $this->store_category_model->search_customer_id_and_date($data);
        $data['main_content'] = $this->load->view('view_all_sales', $data, true);
        $this->load->view('home', $data);
    }
    
     
    
    
    
    
    
}