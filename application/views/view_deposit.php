

<h3 style="text-align: center;">View All Deposit </h3>
<hr>
<table align="center">
    <tr><td>
            <form action="<?php echo base_url(); ?>store_category/search_depositer" method="post">
                <input type="search" list="deposit" placeholder="Enter Depositer ID" name="customer_id">
                <input type="submit" name="btn" value="Search">

            </form>
        </td>
    </tr>
</table>
<hr>
<div style="margin-left: 50px;">

    <table border="1" width="700" align="center">
        <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Designation/Grade</th>
            <th>Total Deposit</th>
            <th>Total Spend</th>
            <th>Current Deposit</th>

           
        </tr>

        <?php
        foreach ($item_info as $values) {
            ?>
            <tr>
                <td><?php echo $values->customer_id?></td>
                <td><?php echo $values->customer_name ?></td>
                <td><?php echo $values->designation ?></td>
                <td><?php echo $values->total_deposit ?></td>
                <td><?php echo $values->total_spend ?></td>
                <td><?php echo $values->current_deposit ?></td>

            </tr>

        <?php } ?>

    </table>

    <div class="pagination">
        <?php echo $this->pagination->create_links(); ?>
    </div> 



</div>