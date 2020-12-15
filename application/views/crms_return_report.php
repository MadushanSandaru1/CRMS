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
            if ($value->id == $reserved_v_no)
                $reserved_v_no = $value->registered_number;
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
                margin: 0 auto;
                width: 80%;
            }
        </style>
    </head>
    <body onload="getTimeDuration()">
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
                    <td colspan="2" class="text-danger text-center mb-2"><h2>Receipt</h2></td>
                </tr>
                <tr>
                    <td style="padding: 10px; width: 30%;">Vehicle Registration Number</td>
                    <td>: <b><?php echo $reserved_v_no; ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px; width: 30%;">Customer Registration Number</td>
                    <td>: <b><?php echo "CRMSRES".$res_id; ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Customer Name</td>
                    <td>: <b><?php echo $cus_name; ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">NIC Number</td>
                    <td>: <b><?php echo $cus_nic; ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Pickup Date</td>
                    <td>: <b id="start-time"><?php echo $pickup; ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Drop Date</td>
                    <td>: <b id="end-time"><?php echo $drop; ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Distance</td>
                    <td>: <b><?php echo $end_meter - $start_meter." km"; ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Duration</td>
                    <td>: <b id="total-hours"><?php echo "" ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Bill Amount</td>
                    <td>: <b><?php echo ""; ?></b></td>
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
    function getTimeDuration() {

        var intialTime = document.getElementById("start-time").value;
        var initialTimeFormat = moment(intialTime);
        var endTime = document.getElementById("end-time").value;
        var endTimeFormat = moment(endTime);
        var totalHours = endTimeFormat.diff(initialTimeFormat,"hours");
        document.getElementById("total-hours").innerText=totalHours;

    }
</script>
