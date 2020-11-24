
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.3.2.min.js"></script>


<h3 style="text-align: center;">Add Item into Store </h3>
<hr>
<h4 style="text-align: center;">
    <?php
    $message = $this->session->userdata('message');
    if (isset($message)) {
        echo $message;
        $this->session->unset_userdata('message');
    }
    ?>
</h4>




<script type="text/javascript">

    $(document).ready(function() {

        var counter = 2;

        $("#addButton").click(function() {

            if (counter > 10) {
                alert("Only 10 textboxes allow");
                return false;
            }

            var newTextBoxDiv = $(document.createElement('tr'))
                    .attr("id", 'TextBoxDiv' + counter);




            newTextBoxDiv.before().html('<label>Product ID #' + counter + ' : </label>' +
                    '<input type="text" name="product_id[]" size="15" required="required" >' + '<label>Quantity : </label>' +
                    '<input type="number" name="quantity[]" required="required" >');

            newTextBoxDiv.appendTo("#add_product");


            counter++;
        });

        $("#removeButton").click(function() {
            if (counter == 1) {
                alert("No more textbox to remove");
                return false;
            }

            counter--;

            $("#TextBoxDiv" + counter).remove();

        });

        $("#getButtonValue").click(function() {

            var msg = '';
            for (i = 1; i < counter; i++) {
                msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
            }
            alert(msg);
        });
    });
</script>



<div id="add_product_form">

    <form action="<?php echo base_url(); ?>store_category/save_store_product" method="post" id="add_product">

        <table cellspacing="10px" align="center">
            <tr>
                <td>Date</td>
                <td>

                    <input type='date' id='date' name='date[]' required="required">

                </td>
            </tr>
            <tr>
                <td>Product ID</td>
                <td>
                    <input type="text" name="product_id[]" size="15" required="required">
                </td>

                <td>Quantity</td>
                <td>
                    <input type="number" name="quantity[]"  required="required">
                </td>
            </tr>




            <tr>
                <td>Product Source</td>
                <td>
                    <input type="text" name="source"  required="required">
                </td>
            </tr>


            <tr>
                <td>&nbsp;</td>
                
                <td>
                    <input type='button' value='Add More Product!' id='addButton'>
                </td>
                <td>
                    <input type='button' value='Remove One' id='removeButton'>
                </td>
                <td>
                    <input type="submit" name="btn" value="Save">
                </td>
            </tr>
        </table>
    </form> 

</div>




