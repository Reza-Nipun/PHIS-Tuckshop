
<h3 style="margin-left: 200px;">All Product Category </h3>

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






<table align="center" border="2" style="text-align: center;">
    
    
    <tr> 
        <th >Product ID</th>
        <th >Product Name</th>
        <th >Product Brand</th>
        <th >Size/Weight(KiloGram)</th>
        
        
        <?php if($this->session->userdata('role') == 1): ?>
        <th>Edit</th>
        <th>Delete</th>
        <?php endif; ?>
    </tr>
    
     <?php
            foreach ($category as $values){
     ?>
    
    <tr>
        
        <td><?php echo $values->product_id?></td>
        <td><?php echo $values->product_name?></td>
        <td><?php echo $values->brand?></td>
        <td><?php echo $values->weight?></td>
        
        <?php if($this->session->userdata('role') == 1): ?>
        <td>
            <a href="">Edit</a>
        </td>
        <td>
            <a href=" "  onclick="return CheckDelete();" >Delete</a>
        </td>
        <?php endif;?>
        
    </tr>
    
    
    
     <?php }?>
    
</table>

<div class="pagination">
        <?php echo $this->pagination->create_links(); ?>
 </div> 
