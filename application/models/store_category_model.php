<?php

class Store_Category_Model extends CI_Model {

    //put your code here

    public function save_category_info($data) {
        $this->db->insert('tbl_category', $data);
    }
    
    public function view_all_category($perpage, $offset) {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $query_result = $this->db->get('',$perpage, $offset);
        $result = $query_result->result();
        return $result;
    }
    
    

    
    
  ////  customer   
    
    public function save_customer_info($data) {
        $this->db->insert('tbl_customer', $data);
    }

    
    public function view_all_customer($perpage, $offset) {
        $offset = (int)$offset;
        $this->db->select('*');
        $this->db->from('tbl_customer');
        $this->db->order_by("designation", "asc");
        $query_result = $this->db->get('',$perpage, $offset);
        $result = $query_result->result();
        return $result;
        
    }
    
    // Search Customer
    public function search_customer_by_customer_id($customer_id, $perpage, $offset) {
        $offset = (int)$offset;
        $this->db->select('*');
        $this->db->from('tbl_customer');
        $this->db->like('customer_name', $customer_id);
        $this->db->order_by("designation", "asc");
        $query_result = $this->db->get('',$perpage, $offset);
        $result = $query_result->result();
        return $result;
    }


    // Search Customer By ID
    public function isCustomerExists($customer_id) {
        $this->db->select('*');
        $this->db->from('tbl_customer');
        $this->db->where('customer_id', "$customer_id");
        $query_result=  $this->db->get();
        $result = $query_result->result_array();
        return $result;
    }

    // Search Product By product_ID
    public function isProductExists($product_id) {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('product_id', "$product_id");
        $this->db->group_by("product_id");
        $query_result=  $this->db->get();
        $result = $query_result->result_array();
        return $result;
    }
    
    /// store product
    
    //for test
    public function save_store_product_info_check($data, $key){
       $this->db->select('product_id');
       $this->db->from('tbl_category'); 
       
      // for($i=0; $i<=$key; $i++ ){
        $this->db->where('product_id', $product_id);
        
     // }
       $query_result= $this->db->get();
       $result= $query_result->row();
       return $result;
    }




    public function save_store_product_info($data) {
        $this->db->select('product_id');
        $this->db->from('tbl_category');
        //$this->db->where('product_id', $data['product_id']);

        //if ($this->db->count_all_results() != 0) {
        $this->db->insert_batch('tbl_store', $data); //insert data
       // } else {
       // return false; //update with the condition where title exist
       // }
    }
    
    
     public function view_all_product($perpage,$offset){
        $offset = (int)$offset;
        $this->db->select('ct.product_id, ct.product_name, ct.brand, ct.weight, st.quantity, st.source,st.date');
        $this->db->from('tbl_category ct');
        $this->db->join('tbl_store st', 'ct.product_id=st.product_id', 'left');
        $this->db->order_by("st.date", "desc"); 
        $query_result = $this->db->get('',$perpage, $offset);
        
        $result = $query_result->result();
        return $result;
     }
    
     
     
  ///  sales product
     
     public function save_sales_product_info($data) {
         //foreach ($product_id as $key=>$values){
        $this->db->select('product_id');
        $this->db->from('tbl_category');
        //$this->db->where('product_id', $product_id[$key]);
        //$this->db->where('customer_id', $customer_id[$key]);

        if ($this->db->count_all_results() != 0) {
        $this->db->insert('tbl_sales', $data); //insert data
        return $this->db->insert_id();
        } else {
        return false; //update with the condition where title exist
        }
    }


    public function salesProdDetail($implode_sale_ids) {
        $query = "Select t1.*, t2.product_name, t2.brand, t2.weight, t3.customer_name 
                            From (SELECT * FROM `tbl_sales` Where sales_id in ($implode_sale_ids)) as t1
                            Inner join
                            `tbl_category` as t2 On t1.product_id=t2.product_id
                            Inner join
                            `tbl_customer` as t3 On t1.customer_id=t3.customer_id";
        $result = $this->db->query( $query )->result_array();
        return $result;
    }

     public function view_all_sales($perpage,$offset){
        $offset = (int)$offset;
        
        $this->db->select('ct.product_id, ct.product_name, ct.brand, ct.weight, sl.customer_id, sl.quantity, sl.unit_price, sl.total_price, sl.date');
            $this->db->from('tbl_sales sl'); 
            $this->db->join('tbl_category ct', 'sl.product_id=ct.product_id', 'left');
            $this->db->order_by('sl.date desc');
            $query = $this->db->get('',$perpage, $offset); 
            $result=$query->result();
            return $result;
     }
     
     
     //Deposit
     
      public function save_deposit_info($data) {
        $this->db->select('customer_id');
        $this->db->from('tbl_customer');
        $this->db->where('customer_id', $data['customer_id']);

        if ($this->db->count_all_results() != 0) {
        $this->db->insert('tbl_accounts', $data); //insert data
        } else {
        return false; //update with the condition where title exist
        }
    }
	
	
	
	
	
// Start of Added by Liza
    // Student ID List for to put in Data list of view_deposit_history1.php page. 
      public function datalist_all_student() {
        $this->db->select('*');
        $this->db->from('tbl_customer');
        $this->db->where('status', '1');
		$query = $this->db->get(); 
		$result=$query->result();
		return $result;
    }
	// End of Student ID List for to put in Data list

	
public function search_depositor_by_student_id($student_id){

        $sql="SELECT customer_id, customer_name, designation FROM tbl_customer WHERE customer_id = '$student_id'";
		
		$query_result=$this->db->query($sql);
        $result=$query_result->result();
        return $result;
    }
	
	
		
public function getDepositors(){
		
		$sql="Select A.*,B.*, (B.total_deposit-C.total_prices) as balance 
			From 
			
			(SELECT customer_id, customer_name, designation FROM tbl_customer) as A
			
			Left Join
			
			(SELECT customer_id, SUM(deposit_amount) as total_deposit FROM tbl_accounts group by customer_id) as B On A.customer_id=B.customer_id
			
			inner Join
			
			(SELECT customer_id,SUM(total_price) as total_prices FROM `tbl_sales` group by customer_id) as C
			
			On B.customer_id=C.customer_id
			
			order by balance";
		$query_result=$this->db->query($sql);
        $result=$query_result->result();
        return $result;
    }
	


public function search_deposit_by_student_id($student_id,$per_page,$offset ){
        $offset = (int)$offset;
        
        $sql="SELECT date AS 'DepositDate', deposit_amount FROM tbl_accounts WHERE customer_id = '$student_id' ORDER BY ac_id DESC lIMIT $per_page OFFSET $offset";
		$query_result=$this->db->query($sql);
        $result=$query_result->result();
        return $result;
    }
	
	// End of Added by Liza

	
     
     public function view_all_deposit($per_page,$offset){
        $offset = (int)$offset;
        
        $sql="select cu.customer_id, cu.customer_name, cu.designation,
                IFNULL(ac.total_deposit,0) as total_deposit,IFNULL(sl.total_spend,0) as total_spend,
                IFNULL(ac.total_deposit,0)-IFNULL(sl.total_spend,0) as current_deposit
                from tbl_customer as cu
                left join
                (
                select date, customer_id, sum(deposit_amount) as total_deposit from tbl_accounts group by customer_id
                ) as ac on cu.customer_id=ac.customer_id left outer join
                (
                select  customer_id, product_id, sum(total_price) as total_spend from tbl_sales Group by customer_id
                ) as sl on cu.customer_id=sl.customer_id 
                ORDER BY cu.customer_name ASC  lIMIT $per_page OFFSET $offset";
        $query_result=$this->db->query($sql);
        $result=$query_result->result();
        return $result;
    }
     
	 
	 
     // View Deposit History
     public function view_deposit_history($per_page,$offset){
        $offset = (int)$offset;
        
        $sql="select cu.customer_id, cu.customer_name, cu.designation,
                IFNULL(ac.total_deposit,0) as total_deposit,IFNULL(sl.total_spend,0) as total_spend,
                IFNULL(ac.total_deposit,0)-IFNULL(sl.total_spend,0) as current_deposit
                from tbl_customer as cu
                left join
                (
                select date, customer_id, sum(deposit_amount) as total_deposit from tbl_accounts group by customer_id
                ) as ac on cu.customer_id=ac.customer_id left outer join
                (
                select  customer_id, product_id, sum(total_price) as total_spend from tbl_sales Group by customer_id
                ) as sl on cu.customer_id=sl.customer_id 
                ORDER BY cu.customer_name ASC  lIMIT $per_page OFFSET $offset";
        $query_result=$this->db->query($sql);
        $result=$query_result->result();
        return $result;
    }
        
	 
	    
    // Inventory ........
     public function view_all_inventory($per_page,$offset){
        $offset = (int)$offset;
        
        $sql="select ca.product_id, ca.product_name, ca.brand, ca.weight,
                IFNULL(st.total_store,0) as total_store,IFNULL(sl.total_sales,0) as total_sales,
                IFNULL(st.total_store,0)-IFNULL(sl.total_sales,0) as current_stock
                from tbl_category as ca
                left join
                (
                select product_id, sum(quantity) as total_store from tbl_store group by product_id
                ) as st on ca.product_id=st.product_id left outer join
                (
                select  product_id, sum(quantity) as total_sales from tbl_sales Group by  product_id
                ) as sl on ca.product_id=sl.product_id 
                ORDER BY ca.product_name ASC  lIMIT $per_page OFFSET $offset";
        $query_result=$this->db->query($sql);
        $result=$query_result->result();
        return $result;
    }
    
    
    //search inventory ..........
    public function search_inventory_by_name($product_name,$per_page,$offset){
        $offset = (int)$offset;
        
        $sql="select ca.product_id, ca.product_name, ca.brand, ca.weight,
                IFNULL(st.total_store,0) as total_store,IFNULL(sl.total_sales,0) as total_sales,
                IFNULL(st.total_store,0)-IFNULL(sl.total_sales,0) as current_stock
                from tbl_category as ca
                left join
                (
                select product_id, sum(quantity) as total_store from tbl_store group by product_id
                ) as st on ca.product_id=st.product_id left outer join
                (
                select  product_id, sum(quantity) as total_sales from tbl_sales Group by  product_id
                ) as sl on ca.product_id=sl.product_id 
                WHERE ca.product_name LIKE '%$product_name%' ORDER BY ca.product_name ASC  lIMIT $per_page OFFSET $offset";
        $query_result=$this->db->query($sql);
        $result=$query_result->result();
        return $result;
    }
    
    
    
    
           
        //depositer Search ---
    
     public function search_deposit_by_product_id($customer_id,$per_page,$offset ){
        $offset = (int)$offset;
        
        $sql="select cu.customer_id, cu.customer_name, cu.designation,
                IFNULL(ac.total_deposit,0) as total_deposit,IFNULL(sl.total_spend,0) as total_spend,
                IFNULL(ac.total_deposit,0)-IFNULL(sl.total_spend,0) as current_deposit
                from tbl_customer as cu
                left join
                (
                select date, customer_id, sum(deposit_amount) as total_deposit from tbl_accounts group by customer_id
                ) as ac on cu.customer_id=ac.customer_id left outer join
                (
                select  customer_id, product_id, sum(total_price) as total_spend from tbl_sales Group by customer_id
                ) as sl on cu.customer_id=sl.customer_id 
                WHERE cu.customer_id LIKE '%$customer_id%' ORDER BY cu.customer_name ASC LIMIT $per_page OFFSET $offset";
        $query_result=$this->db->query($sql);
        $result=$query_result->result();
        return $result;
    }
    
    
     public function search_deposit_by_product_id_ss($customer_id) {
        $this->db->select('ct.product_id, ct.product_name, ct.brand, ct.weight, sl.customer_id, sl.quantity, sl.unit_price, sl.total_price, sl.date');
        $this->db->from('tbl_category ct');
        $this->db->join('tbl_sales sl', 'ct.product_id=sl.product_id', 'left');
        $this->db->like('ct.product_name', $product_name);
        $this->db->order_by('sl.date desc');
        $query = $this->db->get(); 
        $result=$query->result();
        
            //echo '<pre>';
            //print_r($result);
            //exit();
            
            if($query->num_rows() != 0)
            {
                return ($result);
            }
            else
            {
                return false;
            }
        
        
    }
    
//  Search ..........





    public function search_by_product_name_sales($product_name) {
        $this->db->select('ct.product_id, ct.product_name, ct.brand, ct.weight, sl.customer_id, sl.quantity, sl.unit_price, sl.total_price, sl.date');
        $this->db->from('tbl_category ct');
        $this->db->join('tbl_sales sl', 'ct.product_id=sl.product_id', 'left');
        $this->db->like('ct.product_name', $product_name);
        $this->db->order_by('sl.date desc');
        $query = $this->db->get(); 
        $result=$query->result();
        
            //echo '<pre>';
            //print_r($result);
            //exit();
            
            if($query->num_rows() != 0)
            {
                return ($result);
            }
            else
            {
                return false;
            }
        
        
    }
    
    public function search_by_date_sales_info($date1, $date2){
       $this->db->select('ct.product_id, ct.product_name, ct.brand, ct.weight, sl.customer_id, sl.quantity, sl.unit_price, sl.total_price, sl.date');
        $this->db->from('tbl_category ct');
        $this->db->join('tbl_sales sl', 'ct.product_id=sl.product_id', 'left');
        $this->db->where('sl.date >=', $date1 );
        $this->db->where('sl.date <=', $date2 );
        $this->db->order_by('sl.date desc');
        $query = $this->db->get(); 
        $result=$query->result();
        
            //echo '<pre>';
            //print_r($result);
            //exit();
            
            if($query->num_rows() != 0)
            {
                return ($result);
            }
            else
            {
                return false;
            }
         
    }

    public function search_Product_name_and_date($data){
        $this->db->select('ct.product_id, ct.product_name, ct.brand, ct.weight, sl.customer_id, sl.quantity, sl.unit_price, sl.total_price, sl.date');
        $this->db->from('tbl_category ct');
        $this->db->join('tbl_sales sl', 'ct.product_id=sl.product_id', 'left');
        $this->db->like('ct.product_name', $data['product_name'] );
        $this->db->where('sl.date >=', $data['date1'] );
        $this->db->where('sl.date <=', $data['date2'] );
        $this->db->order_by('sl.date');
        $query = $this->db->get(); 
        $result=$query->result();
        
            //echo '<pre>';
            //print_r($result);
            //exit();
            
            if($query->num_rows() != 0)
            {
                return ($result);
            }
            else
            {
                return false;
            }
    }

    
    public function search_customer_id_and_date($data){
        $this->db->select('ct.product_id, ct.product_name, ct.brand, ct.weight, sl.customer_id, sl.quantity, sl.unit_price, sl.total_price, sl.date');
        $this->db->from('tbl_category ct');
        $this->db->join('tbl_sales sl', 'ct.product_id=sl.product_id', 'left');
        $this->db->where('sl.customer_id', $data['customer_id'] );
        $this->db->where('sl.date >=', $data['date1'] );
        $this->db->where('sl.date <=', $data['date2'] );
        $this->db->order_by('sl.date');
        $query = $this->db->get(); 
        $result=$query->result();
        
            //echo '<pre>';
            //print_r($result);
            //exit();
            
            if($query->num_rows() != 0)
            {
                return ($result);
            }
            else
            {
                return false;
            }
    }
    

    
   
    
    
    
    
    
    
    
    
    
 

    public function search_net_stock_by_item_name($item_name){
        $sql = "select p.st_category_id, p.st_category_name,
               IFNULL(st.t_st_qty, 0) as t_st_qty,
               IFNULL(sl.t_sl_qty, 0) as t_sl_qty,
               IFNULL(df.t_df_qty, 0) as t_df_qty,
               IFNULL(rt.t_rt_qty, 0) as t_rt_qty,
               IFNULL(sl.t_sl_qty, 0)-IFNULL(rt.t_rt_qty, 0) as t_distribute,
               IFNULL(st.t_st_qty, 0)-IFNULL(sl.t_sl_qty, 0)+IFNULL(rt.t_rt_qty, 0)-IFNULL(df.t_df_qty, 0) as net_stock
               from tbl_store_category as p
                left join 
               (
               select category_id,sum(item_quantity) as t_st_qty from tbl_store_item Group by category_id 
               ) as st on p.st_category_id=st.category_id
               left outer join
               (
               select item_id, sum(item_quantity) as t_sl_qty from tbl_distribute Group by item_id
               ) as sl on p.st_category_id=sl.item_id
               left outer join
               (
               select item_id, sum(item_quantity) as t_rt_qty from tbl_return Group by item_id
               ) as rt on p.st_category_id=rt.item_id
               left outer join
               (
               select item_id, sum(item_quantity) as t_df_qty from tbl_defect_item Group by item_id
               ) as df on p.st_category_id=df.item_id where p.st_category_name LIKE '%$item_name%' ";
          

       
        $query_result=$this->db->query($sql);
        $result=$query_result->result();
        return $result; 
    }
    
    
    
    
    
    
    public function save_distribute_item_info_test($data) {
        $this->db->insert_batch('tbl_test_disribute', $data);
    }

}


