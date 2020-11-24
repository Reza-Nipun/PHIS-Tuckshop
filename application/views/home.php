
<html>
    <head>
        <title><?php echo $title; ?></title>


        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
        
        <link type="text/javascript" href="<?php echo base_url(); ?>js/jquery-1.8.1.min.js">
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
        

        <script type="text/javascript">
            function CheckDelete()
            {
                chk = confirm("Are you want to delete this item ?");
                if (chk)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        </script>


    </head>

    <body>


        <div id="wrapper">
            <div class="header_top">
                <div class="admin">
                    <?php
                    $admin = $this->session->userdata('admin_name');
                    if (isset($admin)) {
                        echo $admin;
                    }
                    ?>
                </div>
                <div class="logout">
                    <a href="<?php echo base_url(); ?>admin_logout/logout">Logout</a>
                </div>
            </div>
            <div id="header">

                <img src="<?php echo base_url();?>images/phsa_store.jpg">
            </div>

            <div class="clr"></div>

            <div id="container">

                <div class="content_left">
                    <?php if($this->session->userdata('role') == 1||$this->session->userdata('role') == 2||$this->session->userdata('role') == 3): ?>
                    <table border="1">
                        <tr>
                            <td><a href="<?php echo base_url(); ?>store_category.jsp">Home</a> </td>
                        </tr>
                        <?php if($this->session->userdata('role') == 1): ?>
                        <tr>
                            <td> <a href="<?php echo base_url(); ?>store_category/add_category_form">Add Product Category</a></td>
                        </tr>
                        <?php endif;?>
                        
                        <tr>
                            <td> <a href="<?php echo base_url(); ?>store_category/view_category">View Category</a></td>
                        </tr>
                        <?php if($this->session->userdata('role') == 1||$this->session->userdata('role') == 2): ?>
						
                        <tr>
                            <td><a href="<?php echo base_url(); ?>store_category/add_customer_form">Add Customer</a></td>
                        </tr>
                        <?php endif;?>
                        <tr>
                            <td> <a href="<?php echo base_url(); ?>store_category/view_customer">View Customer </a></td>
                        </tr>
                        
                        
                        <tr>
                            <td> <a href="<?php echo base_url(); ?>store_category/add_product_form">Add Store Product</a></td>
                        </tr>
                        
                        
                        <tr>
                            <td> <a href="<?php echo base_url(); ?>store_category/product_preview">View Store Product</a></td>
                        </tr>
                        
                        <?php if($this->session->userdata('role') == 1||$this->session->userdata('role') == 3): ?>
                        <tr>
                            <td><a href="<?php echo base_url(); ?>store_category/sales_form">Sales Product</a></td>
                        </tr>
                        <?php endif;?>
                        
                        <tr>
                            <td> <a href="<?php echo base_url(); ?>store_category/sales_preview">View Sales Product</a></td>
                        </tr>
                        
                        <?php if($this->session->userdata('role') == 1||$this->session->userdata('role') == 2): ?>
                        <tr>
                            <td><a href="<?php echo base_url(); ?>store_category/add_deposit_form">Add Deposit</a> </td>
                        </tr>
                        <?php endif;?>
                        
                        <tr>
                            <td> <a href="<?php echo base_url(); ?>store_category/deposit_preview">View Deposit</a></td>
                        </tr>
                        
                        <tr>
                            <td> <a href="<?php echo base_url(); ?>store_category/deposit_history_search_entry">Search Deposit History</a></td>
                        </tr>
                        
                        <tr>
                            <td> <a href="<?php echo base_url(); ?>store_category/deposit_balance_history">Deposite Balance</a></td>
                        </tr>
                        
                        <tr>
                            <td><a href="<?php echo base_url(); ?>store_category/inventory_preview">Check Inventory</a> </td>
                        </tr>
                        
                        
                        
                    </table>
                    <?php endif; ?>
                    
        <?php if($this->session->userdata('role') == 4): ?>
                    <table border="1">
                        <tr>
                            <td><a href="<?php echo base_url(); ?>store_category.jsp">Home</a> </td>
                        </tr>
                        
                        
                        <tr>
                            <td> <a href="<?php echo base_url(); ?>store_category/view_category">View Category</a></td>
                        </tr>
                        
                        <tr>
                            <td> <a href="<?php echo base_url(); ?>store_category/view_customer">View Customer </a></td>
                        </tr>
                        
                        <tr>
                            <td> <a href="<?php echo base_url(); ?>store_category/product_preview">View Store Product</a></td>
                        </tr>
                        <tr>
                            <td> <a href="<?php echo base_url(); ?>store_category/sales_preview">View Sales Product</a></td>
                        </tr>
                        
                        <tr>
                            <td> <a href="<?php echo base_url(); ?>store_category/deposit_preview">View Deposit</a></td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo base_url(); ?>store_category/inventory_preview">Check Inventory</a> </td>
                        </tr>
                        
                        
                        
                    </table>
                    <?php endif; ?>            
                </div>

                <div class="content">

                    <?php echo $main_content; ?>

                </div>

                <div class="content_right"></div>



            </div>
                <div class="clr"  > </div>
            <div id="footer" >
                
                <p style="float: left; padding-left: 20px"> All copyright reserved by PHIS</p>

                <p style="float: right; text-align: left; padding-right: 20px;">Developed by Viyellatex Group</p>

            </div>




            <div class="clr"  > </div>



    </body>
</html>