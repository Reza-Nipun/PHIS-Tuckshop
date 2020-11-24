<h4 style="margin-left: 200px">Add Product Category</h4>
<hr/>



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




<form action="<?php echo base_url();?>store_category/save_category" method="post">
    
    <table cellspacing="10px" align="center">
        <tr>
            <td>Product ID</td>
            <td>
                <input type="text" name="product_id" size="38" required="1" ><span class="required">*</span>
            </td>
        </tr>
        <tr>
            <td>Product Name</td>
            <td>
                <input type="text" name="product_name" size="38" required="1" ><span class="required">*</span>
            </td>
        </tr>
        
        <tr>
            <td>Brand</td>
            <td>
                <input type="text" name="brand" size="38" required="1" ><span class="required">*</span>
            </td>
        </tr>
        <tr>
            <td>Weight</td>
            <td>
                <input type="text" name="weight" size="38" required="1" ><span class="required">*</span>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="btn" value="Save">
            </td>
        </tr>
    </table>
</form> 