
<h3 style="margin-left: 200px;">Add Employee</h3>

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

<h5 id="err_msg" style="margin-left: 200px; color: red;">

</h5>

<form action="<?php echo base_url();?>store_category/save_customer" method="post">
    <table style="margin-left: 100px;">
        <tr>
            <td>Customer ID</td><td><input type="text" required="1" name="customer_id" id="customer_id" placeholder="Write Customer ID" onblur="isCustomerExists();" /></td>
        </tr>
        <tr>
            <td>Customer Name</td><td><input type="text" required="1" name="customer_name" placeholder="Write Customer Name"></td>
        </tr>
        <tr>
            <td>Email Address</td><td><input type="text" name="email" required="1" placeholder="Write Email Address"></td>
        </tr>
        <tr>
            <td>Designation</td><td><input type="text" name="designation" required="1" placeholder="Write Grade"></td>
        </tr>
        <tr>
            <td>Customer Status</td>
            <td>
                <input type="radio" name="status" value="1" checked="true">Active
                <input type="radio" name="status" value="0">Inactive
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="btn" id="btn" value="Save"></td>
        </tr>
    </table>
</form>

<script type="text/javascript">
    function isCustomerExists() {
        var customer_id = $("#customer_id").val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>store_category/isCustomerExists/",
            data: {customer_id:customer_id},
            dataType: "html",
            success: function(data) {
                if(data == 'Exist!'){
                    $("#err_msg").text("Sorry, Customer ID is Already " + data);
                    $("#btn").attr("disabled", true);
                }

                if(data == 'Not Exists!'){
                    $("#err_msg").text("");
                    $("#btn").attr("disabled", false);
                }

            }
        });
    }
</script>