<?php
//$link = mysql_connect('localhost', 'root', 'imran');
?>

<style type="text/css">
    table.bottomBorder { border-collapse:collapse; }
    table.bottomBorder td, table.bottomBorder th, table.bottomBorder tr { border-bottom:1px dotted gray;padding:5px; border:1px dotted gray;
        font-size:14px;
        font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
    }

    table.bottomBorder th{ font-size:13px !important; font-weight:bold; }



    table.bottomBorder2 { border-collapse:collapse; }
    table.bottomBorder2 td, table.bottomBorder2 th, table.bottomBorder2 tr { border-bottom:1px dotted gray;padding:5px; border:1px dotted gray;
        font-size:14px;
        font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
    }
    table.bottomBorder2 th{ font-size:14px !important; font-weight:bold; }



</style>

<h4 align="center">View Deposit History</h4>

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
<table align="center" style="margin-bottom:0px">
    <tr><td>
            <form action="<?php echo base_url(); ?>store_category/deposit_history_search" method="post" style="margin-bottom:0px !important">
                <input type="search" list="student_id_list" placeholder="Enter Student ID" name="student_id" style="width:300px" value="<?php // echo $data['student_id']; ?>">
                <input type="submit" name="btn" value="Search">




                <datalist id="student_id_list">
                    <?php
                    foreach ($student_list as $values) {
                        ?>
                        <option value="<?php echo $values->customer_id.'~'.$values->customer_name?>"></option>
                    <?php } ?>

                </datalist>


            </form>
        </td>
    </tr>
</table>

<hr>

<div>
    <table border="1" width="500" align="center" class="bottomBorder2">
        <tr style="background-color:#ABB8B6">
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Desig/Grade</th>
        </tr>

        <?php
        foreach ($student_info as $values) {
            $student_id = $values->customer_id;
            ?>
            <tr>
                <td style="text-align:center"><?php echo $student_id; ?></td>
                <td style="text-align:center"><?php echo $values->customer_name; ?></td>
                <td style="text-align:center"><?php echo $values->designation; ?></td>
            </tr>
        <?php } ?>

    </table>
</div>


<hr>



<div style="margin-left: 10px;">

    <table border="1" width="760" align="center" class="bottomBorder">
        <tr style="background-color:#FAD5C8">
            <th>#</th>
            <th>Depst Date</th>
            <th>Previous BL</th>
            <th>Depst Amnt</th>
            <th>Net Depst Amnt</th>
            <th>Consumption Description</th>
            <th>Consumed Amnt</th>
            <th>Balance</th>
        </tr>

        <?php
        //$sum_deposit_amount = 0;

        $no = 1;

        foreach ($item_info as $values) {

            $DepositDate = $values->DepositDate;
            $deposit_amount = $values->deposit_amount;

            //$sum_deposit_amount = $sum_deposit_amount+$values->deposit_amount;

            ?>
            <tr>
                <td style="text-align:center"><?php echo $no; ?></td>
                <td style="text-align:center"><?php echo $DepositDate; ?></td>
                <td style="text-align:center"><?php

                    $sql ="SELECT (T0.depst_amnt-T1.cnsmd_amnt) AS 'prev_bl' 
                    FROM (SELECT COALESCE(customer_id, '$student_id') AS 'customer_id', 
                    IFNULL(SUM( `deposit_amount` ), 0) AS  'depst_amnt'
                    FROM  `tbl_accounts` 
                    WHERE  `customer_id` =  '$student_id'
                    AND date <  '$DepositDate') T0 
                    LEFT JOIN (SELECT COALESCE(customer_id, '$student_id') AS 'customer_id', 
                    IFNULL(SUM( total_price ), 0) AS  'cnsmd_amnt'
                    FROM  `tbl_sales` 
                    WHERE  `customer_id` =  '$student_id'
                    AND date <  '$DepositDate') T1 ON T1.customer_id = T0.customer_id";

                    // Here << COALESCE(customer_id, '$student_id') AS 'customer_id' >> this technique has followed to consider customer_id as Parametarized Customer ID when there is no data found in DB, as otherwise the customer_id will show << NULL >> when << date < '0000-00-00' >> query executes due to no data found. COALESCE has used as it uses the ASCII SQL Standard.

                    // using below convention is more safe than I used below. I used for reducing condition checking.

                    /*$query = $this->db->query($sql);
                    if ($query->num_rows() > 0)
                    {
                      foreach ($query->result() as $row)
                       { $prev_bl = $row->prev_bl; echo $prev_bl; }
                    }*/

                    $query = $this->db->query($sql);
                    foreach ($query->result() as $row)
                    { $prev_bl = $row->prev_bl; echo $prev_bl; }

                    ?></td>
                <td style="text-align:center"><?php echo $deposit_amount; ?></td>
                <td style="text-align:center"><?php echo $prev_bl+$deposit_amount; ?></td>
                <td style="text-align:center; font-size:12px">
                    <?php
                    if($no==1)
                    {
                        $today = date('Y-m-d');
                        echo "From <strong>$DepositDate</strong> to <strong>$today</strong>";

                        $sql_cnsmd_tot = "SELECT IFNULL(SUM( total_price ), 0) AS  'cnsmd_total' FROM `tbl_sales` WHERE `customer_id` = '$student_id' AND STR_TO_DATE(date , '%Y-%m-%d') BETWEEN STR_TO_DATE('$DepositDate' , '%Y-%m-%d') AND STR_TO_DATE('$today' , '%Y-%m-%d')";

                    }
                    else {
                        $day_b4_last_depst_dt = date('Y-m-d', strtotime($last_depst_dt . '-1 day' ));
                        echo "From <strong>$DepositDate</strong> to <strong>$day_b4_last_depst_dt</strong>";

                        $sql_cnsmd_tot = "SELECT IFNULL(SUM( total_price ), 0) AS  'cnsmd_total' FROM `tbl_sales` WHERE `customer_id` = '$student_id' AND STR_TO_DATE(date , '%Y-%m-%d') BETWEEN STR_TO_DATE('$DepositDate' , '%Y-%m-%d') AND STR_TO_DATE('$day_b4_last_depst_dt' , '%Y-%m-%d')";

                    }
                    ?>
                </td>
                <td style="text-align:center"><?php
                    $query = $this->db->query($sql_cnsmd_tot);
                    foreach ($query->result() as $row)
                    { $cnsmd_total = $row->cnsmd_total; echo $cnsmd_total; }
                    ?>
                </td>

                <?php if($no == 1) { ?>
                    <td style="text-align:center; color:#FFF; background-color:#2DABFF; font-size:16px"><?php echo ($prev_bl+$deposit_amount)-$cnsmd_total; ?></td>
                <?php } else { ?>
                    <td style="text-align:center"><?php echo ($prev_bl+$deposit_amount)-$cnsmd_total; ?></td>
                <?php } ?>


            </tr>

            <?php

            $last_depst_dt = $DepositDate;
            $no++;

        } ?>

    </table>

    <div class="pagination">
        <?php echo $this->pagination->create_links(); ?>
    </div>



</div>
