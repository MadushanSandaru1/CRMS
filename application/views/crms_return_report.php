<?php date_default_timezone_set("Asia/Colombo"); ?>
<?php
$reserved_v_no ="";
$cus_name="";
$res_id=0;
$cus_nic="";
$pickup ="";
$drop ="";
$start_meter =0;
$end_meter=0;
$d_diff=0;
$total_balance=0;
$price_per_day=0;
$price_per_km=0;
$price_per_hour=0;
$today = Date('Y-m-d h:i:s ',time());
$actual_hours=0;
$planed_hours=0;
$vehicle_id=0;
$advance_payment=0;

foreach ($reserved_details as $values)
{
    $reserved_v_no = $values->vehicle_id;
    $cus_name = $values->customer_id;
    $res_id = $values->id;
    $pickup = $values->from_date;
    $drop = $values->to_date;
    $start_meter= $values->start_meter_value;
    $end_meter = $values->stop_meter_value;
    $advance_payment = $values->advance_payment;
}

foreach ($vehicle_data as $value)
{
    if ($value->id == $reserved_v_no) {
        $reserved_v_no = $value->registered_number;
        $price_per_day = $value->price_per_day;
        $price_per_km = $value->additional_price_per_km;
        $price_per_hour = $value->additional_price_per_hour;
        $vehicle_id = $value->id;
    }
}

foreach ($customer_data as $value)
{
    if ($value->id == $cus_name) {
        $cus_name = $value->name;
        $cus_nic = $value->nic;
    }
}
?>


<html>
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- page title -->
    <title>Abhaya rent a car</title>

    <!-- css -->
    <link rel="stylesheet" href="assets/css/bootstrap.css";>

    <style>
        @page {
            margin: 0cm 0cm;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            font-family: 'Times New Roman', serif;
            margin-top: 7cm;
            margin-bottom: 2cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #C70039;
            color: #ffffff;
        }

        table {
            margin: 1px auto;
            width: 80%;
        }
    </style>
</head>
<body onload="">
<header>
    <img src="assets/images/report_header.png" width="100%" height="20%"/>
    <small><pre class="text-right mr-5">printed date: <?php echo Date('Y-m-d h:i:s a',time()) ?></pre></small>
</header>

<footer class="text-center">
    <p class="mt-4">Copyright &copy; <?php echo date("Y");?> All rights reserved | Team Semicolon</p>
</footer>

<!-- Wrap the content of your PDF inside a main tag -->
<main class="container">
    <table class="table">
        <tr>
            <td colspan="2" class="text-danger text-center mb-2"><h3>Receipt</h3></td>
        </tr>
        <tr>
            <td style="padding: 8px; width: 45%;">Vehicle Registration Number</td>
            <td>: <?php echo $reserved_v_no; ?></td>
        </tr>
        <tr>
            <td style="padding: 10px; width: 30%;">Customer Registration Number</td>
            <td>: <?php echo "CRMSRES".$res_id; ?></td>
        </tr>
        <tr>
            <td style="padding: 10px;">Customer Name</td>
            <td>: <?php echo $cus_name; ?></td>
        </tr>
        <tr>
            <td style="padding: 10px;">NIC Number</td>
            <td>: <?php echo $cus_nic; ?></td>
        </tr>
        <tr>
            <td style="padding: 10px;">Pickup Date</td>
            <td>: <b id="start_time"><?php echo $pickup; ?></b></td>
        </tr>
        <tr>
            <td style="padding: 10px;">Drop Date</td>
            <td>: <b id="end_time"><?php echo $today; ?></b></td>
        </tr>
        <tr>
            <td style="padding: 10px;">Distance</td>
            <td>: <?php echo $end_meter - $start_meter." km"; ?></td>
        </tr>
        <tr>
            <td style="padding: 10px;">Duration</td>
            <td>:
                <b id="total_hours">
                    <?php
                        $h=10;
                        $sd= new DateTime($pickup);
                        $ed= new DateTime($today);
                        $date_diffs = $sd->diff($ed);
                        $actual_hours=$date_diffs->format('%h');
                        echo $date_diffs->format('%a Day and %h hours');
                    ?>
                </b>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px;">Bill Amount</td>
            <td>:
                <b>
                    <?php
                        $start_time= new DateTime($pickup);
                        $end_time= new DateTime($drop);
                        $datediffs_expected = $start_time->diff($end_time);
                        //$planed_hours = $datediffs_expected->format('%d')*24;
                        $planed_hours = $datediffs_expected->format('%h');
                        $planed_days = $datediffs_expected->format('%a');
                        if($planed_days ==0)
                            $planed_days=1;
                        //$d_diff_exped = $datediffs_expected->format('%d');


                        if(($end_meter - $start_meter) >=200 && $actual_hours>$planed_hours)
                        {
                            $hours =$actual_hours - $planed_hours;
                            $total_balance +=(($end_meter - $start_meter)*$price_per_km);
                            $total_balance +=$hours*$price_per_hour;
                            $total_balance+=$price_per_day*$planed_days;
                            $total_balance -=$advance_payment;
                            $this->session->set_tempdata('vehicle_return_income',$total_balance, 10);
                            $this->session->set_tempdata('vehicle_return_v_id',$vehicle_id, 10);
                        }
                        else if(($end_meter - $start_meter) >=200 && $actual_hours==$planed_hours) {
                            $total_balance +=(($end_meter - $start_meter)*$price_per_km);
                            $total_balance +=$price_per_day*$planed_days;
                            $total_balance -=$advance_payment;
                            $this->session->set_tempdata('vehicle_return_income',$total_balance, 10);
                            $this->session->set_tempdata('vehicle_return_v_id',$vehicle_id, 10);
                        }
                        else if(($end_meter - $start_meter) < 200 && $actual_hours>$planed_hours) {
                            $hours =$actual_hours - $planed_hours;
                            $total_balance +=$hours*$price_per_hour;
                            $total_balance +=$price_per_day*$planed_days;
                            $total_balance -=$advance_payment;
                            $this->session->set_tempdata('vehicle_return_income',$total_balance, 10);
                            $this->session->set_tempdata('vehicle_return_v_id',$vehicle_id, 10);
                        }
                        else if(($end_meter - $start_meter) < 200 && $actual_hours<$planed_hours) {
                            $total_balance +=$price_per_day;
                            $total_balance -=$advance_payment;
                            $this->session->set_tempdata('vehicle_return_income',$total_balance, 10);
                            $this->session->set_tempdata('vehicle_return_v_id',$vehicle_id, 10);
                        }

                        echo $total_balance." LKR/-";
                    ?>
                </b>
            </td>
        </tr>
        <tr>
            <td colspan="2"><p class="text-justify mt-4"> In above mention customer received the vehicle from Abhaya Rent a Car and Cab Service company and he settle the bill amount.</p></td>
        </tr>
    </table>


    <table>
        <tr>
            <td align="center" style="width: 30%;">________________________</td>
            <td></td>
            <td align="center" style="width: 30%;">________________________</td>
        </tr>
        <tr>
            <td align="center" style="width: 30%;">Date</td>
            <td></td>
            <td align="center" style="width: 30%;">Cashier's Signature</td>
        </tr>
    </table>
</main>
</body>
</html>

<!-- script files -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">

    function set_duration() {
        s_time = Date.parse(document.getElementById("start_time").value);
        endTime = Date.parse(document.getElementById("end_time").value);

        days = Math.ceil((endTime - s_time) / 1000 / 60 / 60 / 24);
        document.getElementById("total_hours").innerHTML = days;
    }


</script>
