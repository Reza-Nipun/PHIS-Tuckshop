

<h3 style="text-align: center;">All Inventory </h3>

<hr>
<table align="center">
    <tr><td>
            <form action="<?php echo base_url(); ?>store_category/search_inventory" method="post">
                <input type="search" list="product" placeholder="Enter Product Name" name="product_name">
                <input type="submit" name="btn" value="Search">

            </form>
        </td>
    </tr>
</table>
<hr>

<div style="margin-left: 50px;">

    <table border="1" width="700" align="center">
        <tr>
            <td>Product ID</td>
            <td>Product Name</td>
            <td>Brand</td>
            <td>Size</td>
            <td>Total Store</td>
            <td>Total Sales</td>
            <td>Current Stock</td>
        </tr>

        <?php
        foreach ($item_info as $values) {
            ?>
            <tr>
                <td><?php echo $values->product_id?></td>
                <td><?php echo $values->product_name ?></td>
                <td><?php echo $values->brand ?></td>
                <td><?php echo $values->weight ?></td>
                <td><?php echo $values->total_store ?></td>
                <td><?php echo $values->total_sales ?></td>
                <td><?php echo $values->current_stock ?></td>

            </tr>

        <?php } ?>

    </table>

    <div class="pagination">
        <?php echo $this->pagination->create_links(); ?>
    </div> 



</div>