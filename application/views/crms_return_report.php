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
$today = Date('Y-m-d h:i:s a',time());
$actual_hours=0;
$planed_hours=0;
foreach ($reserved_details as $values)
{
    $reserved_v_no = $values->vehicle_id;
    $cus_name = $values->customer_id;
    $res_id = $values->id;
    $pickup = $values->from_date;
    $drop = $values->to_date;
    $start_meter= $values->start_meter_value;
    $end_meter = $values->stop_meter_value;
}

foreach ($vehicle_data as $value)
{
    if ($value->id == $reserved_v_no) {
        $reserved_v_no = $value->registered_number;
        $price_per_day = $value->price_per_day;
        $price_per_km = $value->additional_price_per_km;
        $price_per_hour = $value->additional_price_per_hour;
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
            margin: 3px auto;
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
                        $sd= new DateTime($pickup);
                        $ed= new DateTime($today);
                        $datediffs = $sd->diff($ed);
                        $days = $datediffs->h;
                        $actual_hours = $days + ($datediffs->days*24);
                        $days = $days + ($datediffs->days);
                        //$d_diff = $datediffs->format('%H');
                        echo $days." Day";

                    ?>
                </b>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px;">Bill Amount</td>
            <td>:
                <b>
                    <?php
                        $sd= new DateTime($pickup);
                        $ed= new DateTime($drop);
                        $datediffs_expected = $sd->diff($ed);
                        $days_expected=$datediffs_expected->h;
                        $planed_hours = $days_expected+($datediffs_expected->days*24);
                        $days_expected=$days_expected+($datediffs_expected->days);
                        //$d_diff_exped = $datediffs_expected->format('%d');

                        if(($end_meter - $start_meter) >=200 && $days>$days_expected)
                        {
                            $hours =$actual_hours - $planed_hours;
                            $total_balance +=(($end_meter - $start_meter)*$price_per_km);
                            $total_balance +=$hours*$price_per_hour;
                            $total_balance+=$price_per_day;
                            $this->session->set_tempdata('vehicle_return_income',$total_balance, 10);
                        }
                        else if(($end_meter - $start_meter) >=200 && $days==$days_expected) {
                            $total_balance +=(($end_meter - $start_meter)*$price_per_km);
                            $total_balance +=$price_per_day;
                            $this->session->set_tempdata('vehicle_return_income',$total_balance, 10);
                        }
                        else if(($end_meter - $start_meter) < 200 && $days>$days_expected) {
                            $hours =$actual_hours - $planed_hours;
                            $total_balance +=$hours*$price_per_hour;
                            $total_balance +=$price_per_day;
                            $this->session->set_tempdata('vehicle_return_income',$total_balance, 10);
                        }
                        else if(($end_meter - $start_meter) < 200 && $days<$days_expected) {
                            $hours =$planed_hours-$actual_hours;
                            $total_balance +=$hours*$price_per_hour;
                            $this->session->set_tempdata('vehicle_return_income',$total_balance, 10);
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
