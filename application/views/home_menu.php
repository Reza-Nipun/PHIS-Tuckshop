
<?php
echo '<h4 style="margin-left: 200px"> Welcome'.' '.'Mr.'.' '.$this->session->userdata('admin_name').'</h4>';

?>

 <?php if($this->session->userdata('role') == 1||$this->session->userdata('role') == 2 ||$this->session->userdata('role') == 3||$this->session->userdata('role') == 4): ?>

<?php if($this->session->userdata('role') == 1): ?>
<div class="home_menu"><a href="<?php echo base_url(); ?>store_category/add_category_form">Add Product Category</a></div>
<?php endif;?>
<div class="home_menu"><a href="<?php echo base_url(); ?>store_category/view_category">View Category</a></div>

<?php if($this->session->userdata('role') == 1||$this->session->userdata('role') == 2): ?>
<div class="home_menu"><a href="<?php echo base_url(); ?>store_category/add_customer_form">Add Customer</a></div>
<?php endif;?>


<div class="home_menu"><a href="<?php echo base_url(); ?>store_category/view_customer">View Customer </a></div>
<div class="home_menu"><a href="<?php echo base_url(); ?>store_category/add_product_form">Add Store Product</a></div>
<div class="home_menu"><a href="<?php echo base_url(); ?>store_category/product_preview">View Store Product</a></div>

<?php if($this->session->userdata('role') == 1||$this->session->userdata('role') == 3): ?>
<div class="home_menu"><a href="<?php echo base_url(); ?>store_category/sales_form">Sales Product</a></div>
<?php endif;?>

<div class="home_menu"><a href="<?php echo base_url(); ?>store_category/sales_preview">View Sales Product</a></div>

<?php if($this->session->userdata('role') == 1||$this->session->userdata('role') == 2): ?>
<div class="home_menu"><a href="<?php echo base_url(); ?>store_category/add_deposit_form">Add Deposit</a></div>
<?php endif;?>

<div class="home_menu"><a href="<?php echo base_url(); ?>store_category/deposit_preview">View Deposit</a></div>

<div class="home_menu"><a href="<?php echo base_url(); ?>store_category/deposit_history_search_entry">Search Deposit History</a></div>

<div class="home_menu"><a href="<?php echo base_url(); ?>store_category/deposit_balance_history">Deposite Balance</a></div>

<div class="home_menu"><a href="<?php echo base_url(); ?>store_category/inventory_preview">Check Inventory</a></div>
    
<?php endif;?>