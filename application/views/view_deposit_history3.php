
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
 	<!--<form action="<?php echo base_url(); ?>store_category/deposit_history_search" method="post">
                <input type="search" list="student_id_list" placeholder="Enter Student ID" name="student_id" style="width:300px">
                <input type="submit" name="btn" value="Search">
                
                
                <datalist id="student_id_list">
        <?php
        foreach ($student_list as $values) {
            ?>
<option value="<?php echo $values->customer_id.'~'.$values->customer_name?>"></option>
        <?php } ?>

                </datalist>
                
                
            </form>-->
        </td>
    </tr>
</table>


<div>
    <table border="1" width="500" align="center" class="bottomBorder2">
        <tr style="background-color:#ABB8B6">
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Desig/Grade</th>
            <th>Balance</th>
        </tr>

        <?php
        foreach ($students_info as $values) {
			$student_id = $values->customer_id;
		?>
        <tr>
            <td style="text-align:center"><?php echo $values->customer_id; ?></td>
            <td style="text-align:center"><?php echo $values->customer_name; ?></td>
            <td style="text-align:center"><?php echo $values->designation; ?></td>
            <td style="text-align:center"><?php echo $values->balance; ?></td>
        </tr>
        <?php } ?>

    </table>
</div>


