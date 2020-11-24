<html>
    <head>

        <script>

            function show() {
                var option = document.getElementById("category").value;


                if (option == "search_by_name")
                {
                    document.getElementById("search_by_name").style.display = "block";
                    document.getElementById("search_by_date").style.display = "none";
                    document.getElementById("name_date").style.display = "none";
                    document.getElementById("id_date").style.display = "none";
                }
                if (option == "search_by_date")
                {
                    document.getElementById("search_by_name").style.display = "none";
                    document.getElementById("search_by_date").style.display = "block";
                    document.getElementById("name_date").style.display = "none";
                    document.getElementById("id_date").style.display = "none";
                }
                if (option == "name_date")
                {
                    document.getElementById("name_date").style.display = "block";
                    document.getElementById("search_by_name").style.display = "none";
                    document.getElementById("search_by_date").style.display = "none";
                    document.getElementById("id_date").style.display = "none";
                }
                if (option == "id_date")
                {
                    document.getElementById("name_date").style.display = "none";
                    document.getElementById("search_by_name").style.display = "none";
                    document.getElementById("search_by_date").style.display = "none";
                    document.getElementById("id_date").style.display = "block";
                }
            }
        </script>

    </head>
    <body onload="show()">
        
<h3 style="text-align: center;">All Sales Item </h3>
<hr>
<div style="">
            <table align="center">
                <tr >
                    <td><label>Search by:</label></td>
                    <td><select id="category" onchange="show()">    <!--onchange show methos is call-->

                            <option value="search_by_name"selected="selected" >Search by Product Name</option>
                            <option value="search_by_date">Search by Date</option>
                            <option value="name_date">Name with Date</option>
                            <option value="id_date">Customer ID with Date</option>
                        </select>
                    </td>
                </tr>
            </table>

            <h5 align="center">
                <div id="search_by_name">
                    <form action="<?php echo base_url(); ?>store_category/search_by_product_name_sales_preview" method="post">
                        <input type="search" list="receiver_name" placeholder="Enter Product Name" name="product_name" size="30">
                        <input type="submit" name="btn" value="Search">
                    </form>
                </div>

                <div id="search_by_date">
                    <form action="<?php echo base_url(); ?>store_category/search_by_date_sales_item_preview" method="post">
                        <label>FROM</label><input type="date" id="date1" name="date1"  >
                        <label>TO</label><input type="date" id="date2" name="date2"  >
                        <input type="submit" name="btn" value="Search">
                    </form>
                </div>

                <div id="name_date">
                    <form action="<?php echo base_url(); ?>store_category/search_name_with_date_sales_preview" method="post">
                        <label>Name</label><input type="search" list="product_name" placeholder="Enter Product Name" name="product_name"><br>
                        <label>FROM</label><input type="date" id="date1" name="date1"  >
                        <label>TO</label><input type="date" id="date2" name="date2"  >
                        <input type="submit" name="btn" value="Search">
                    </form>
                </div>
                <div id="id_date">
                    <form action="<?php echo base_url(); ?>store_category/search_id_with_date_sales_preview" method="post">
                        <label>Name</label><input type="search" list="customer_id" placeholder="Enter Customer ID" name="customer_id"><br>
                        <label>FROM</label><input type="date" id="date1" name="date1"  >
                        <label>TO</label><input type="date" id="date2" name="date2"  >
                        <input type="submit" name="btn" value="Search">
                    </form>
                </div>
                
            </h5>
        </div>
<hr>
<div style="margin-left: 10px;">

    <table border="1"  align="center">
        <tr>
            <th>Customer ID</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Brand</th>
            <th>Size/Weight(GM)</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Totla Price</th>
            <th>Date</th>

            <?php if ($this->session->userdata('role') == 1): ?>
                <th>Edit</th>
            <?php endif; ?>
        </tr>

        <?php
        foreach ($item_info as $values) {
            ?>
            <tr>
                <td><?php echo $values->customer_id?></td>
                <td><?php echo $values->product_id?></td>
                <td><?php echo $values->product_name ?></td>
                <td><?php echo $values->brand ?></td>
                <td><?php echo $values->weight ?></td>
                <td><?php echo $values->quantity ?></td>
                <td><?php echo $values->unit_price ?></td>
                <td><?php echo $values->total_price ?></td>
                <td><?php echo $values->date ?></td>


                <?php if ($this->session->userdata('role') == 1): ?>
                    <td>
                        <a href="">Edit</a>
                    </td>
                    
                <?php endif; ?>
            </tr>

        <?php } ?>

    </table>

    <div class="pagination">
        <?php echo $this->pagination->create_links(); ?>
    </div> 



</div>

    </body>
</html>