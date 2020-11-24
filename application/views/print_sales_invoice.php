
<html>
    <head>
        <title><?php echo $title; ?></title>


        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
        
        <link type="text/javascript" href="<?php echo base_url(); ?>js/jquery-1.8.1.min.js">
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
        

        <script type="text/javascript">
            function CheckDelete()
            {
                chk = confirm("Are you want to delete this item ?");
                if (chk)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        </script>

        <style>
            table, th, td {
                border: 1px solid black;
            }
            table, th, td {
                border-collapse: collapse;
            }
        </style>

    </head>

    <body>

        <div id="wrapper" style="padding-left: 10%;">
            <div id="container">

                    <table width="95%" style="border: none !important;">
                        <tr style="border: none !important;">
                            <td align="center" style="border: none !important;"><img src="<?php echo base_url();?>images/phis_photo.jpg" width="80" height="80"><b><h2>Pledge Harbor International School</h2></b></td>
                        </tr>
                        <tr style="border: none !important;">
                            <td align="center" style="border: none !important;"><b><h4>Sales Invoice</h4></b></td>
                        </tr>
                    </table>

                    <table width="95%">
                        <tr>
                            <td align="right" style="width: 130px; font-size: 18px;"><b>Customer Name: </b></td><td align="left" style="font-size: 18px;"><?php echo $sales_detail[0]['customer_name'];?></td>
                            <td style="width: 130px;" rowspan="2"></td>
                            <td align="right" style="font-size: 18px;"><b>Date: </b></td>
                            <td style="font-size: 18px;"><?php echo $sales_detail[0]['date'];?></td>
                        </tr>
                        <tr>
                            <td align="right" style="font-size: 18px;"><b>Customer ID: </b></td><td style="font-size: 18px;"><?php echo $sales_detail[0]['customer_id'];?></td>

                            <td colspan="2"></td>
                        </tr>
                    </table>

                    <table width="95%">
                        <thead>
                            <tr>
                                <th align="center" style="font-size: 18px;"><b>Item ID</b></th>
                                <th align="center" style="font-size: 18px;"><b>Item Name</b></th>
                                <th align="center" style="font-size: 18px;"><b>Unit Price</b></th>
                                <th align="center" style="font-size: 18px;"><b>Quantity</b></th>
                                <th align="center" style="font-size: 18px;"><b>Total(TK)</b></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $total_price=0;
                        foreach ($sales_detail as $key => $v){ ?>
                            <tr>
                                <td align="center" style="font-size: 18px;"><?php echo $v['product_id']?></td>
                                <td align="center" style="font-size: 18px;"><?php echo $v['product_name']?></td>
                                <td align="center" style="font-size: 18px;"><?php echo $v['unit_price']?></td>
                                <td align="center" style="font-size: 18px;"><?php echo $v['quantity']?></td>
                                <td align="center" style="font-size: 18px;"><?php echo $v['total_price']?></td>
                            </tr>
                        <?php
                            $total_price+=$v['total_price'];
                        }
                        ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" align="right" style="font-size: 18px;"><b>TOTAL</b></td>
                                <td align="center" style="font-size: 18px;"><b><?php echo $total_price;?></b></td>
                            </tr>
                        </tfoot>
                    </table>

            </div>

    </body>
</html>

<script type="text/javascript">
    window.print();
</script>