
<h3 style="text-align: center;">Add Deposit </h3>
<hr>
<h4 style="text-align: center;">
    <?php
        $message=$this->session->userdata('message');
        if(isset($message))
        {
            echo $message;
            $this->session->unset_userdata('message');
        }
    
    
    ?>
</h4>





<form action="<?php echo base_url();?>store_category/save_deposit" method="post">
    
    <table cellspacing="10px" align="center">
        <tr>
            <td>Date</td>
            <td>
                
                <input type='date' id='date' name='date' required="required">
                
            </td>
        </tr>
        

        <tr>
            <td>Customer ID</td>
            <td>
                <input type="text" name="customer_id" size="37" required="required">
            </td>
        </tr>
        
        <tr>
            <td>Deposit Amount</td>
            <td>
                <input type="number" name="deposit_amount"  required="required">
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



