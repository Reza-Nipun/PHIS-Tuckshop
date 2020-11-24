

<h3 style="text-align: center;">All Store Item </h3>
<hr>


<div style="margin-left: 50px;">

    <table border="1" width="700" align="center">
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Brand</th>
            <th>Size/Weight(GM)</th>
            <th>Quantity</th>
            <th>Source</th>
            <th>Date</th>

            <?php if ($this->session->userdata('role') == 1): ?>
                <th>Edit</th>
                <th>Delete</th>
            <?php endif; ?>
        </tr>

        <?php
        foreach ($item_info as $values) {
            ?>
            <tr>
                <td><?php echo $values->product_id?></td>
                <td><?php echo $values->product_name ?></td>
                <td><?php echo $values->brand ?></td>
                <td><?php echo $values->weight ?></td>
                <td><?php echo $values->quantity ?></td>
                <td><?php echo $values->source ?></td>
                <td><?php echo $values->date ?></td>


                <?php if ($this->session->userdata('role') == 1): ?>
                    <td>
                        <a href="">Edit</a>
                    </td>
                    <td>
                        <a href="" onclick="return CheckDelete();">Delete</a>
                    </td>
                <?php endif; ?>
            </tr>

        <?php } ?>

    </table>

    <div class="pagination">
        <?php echo $this->pagination->create_links(); ?>
    </div> 



</div>