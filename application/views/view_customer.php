
<h4 align="center">All Customer</h4>




<h4 style="margin-left: 200px">
    <?php
        $message=$this->session->userdata('message');
        if(isset($message))
        {
            echo $message;
            $this->session->unset_userdata('message');
        }
    
    
    ?>
</h4>


<hr>
<table align="center">
    <tr><td>
            <form action="<?php echo base_url(); ?>store_category/search_customer" method="post">
                <input type="search" list="customer" placeholder="Enter Customer Name or ID" name="customer_id">
                <input type="submit" name="btn" value="Search">

            </form>
        </td>
    </tr>
</table>
<hr>



<table align="center"  border="1">
    <tr>
        
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Email</th>
        <th>Designation/Grade</th>
        
        <?php if ($this->session->userdata('role') == 1): ?>
        <th>Edit</th>
        <?php endif; ?>
    </tr>
    
    <?php foreach ($customer_info as $values){ ?>
    <tr>
        
        <td><?php echo $values->customer_id?></td>
        <td><?php echo $values->customer_name?></td>
        <td><?php echo $values->email?></td>
        <td><?php echo $values->designation?></td>
        
        <?php if ($this->session->userdata('role') == 1): ?>
        <td>
            <a href="#">Edit</a>
        </td>
        <?php endif; ?>
        
    </tr>
    
    <?php } ?>
    
</table>


<div class="pagination">
        <?php echo $this->pagination->create_links(); ?>
    </div> 
