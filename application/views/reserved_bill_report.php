<?php date_default_timezone_set("Asia/Colombo"); ?>

<html>
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- page title -->
    <title>Abhaya rent a car</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css";>

    <style>
        @page {
            margin: 0cm 0cm;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            font-family: 'Times New Roman', serif;
            margin-top: 5.5cm;
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
    <body>

        <?php foreach($report_details->result() as $data_row){} ?>

        <!-- Define header and footer blocks before your content -->
        <header>
            <img src="assets/images/report_header.png" width="100%" height="20%"/>
            <small><pre class="text-right mr-4">printed date: <?php echo Date('Y-m-d h:i:s a',time()) ?></pre></small>
        </header>

        <footer class="text-center">
            <p class="mt-4"><small>Copyright &copy; <?php echo date("Y");?> All rights reserved | Team Semicolon</small></p>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <table>
                <tr>
                    <td colspan="2" class="text-danger text-center mb-1"><h6>Vehicle Reserved Bill</h6></td>
                </tr>
                <tr>
                    <td style="padding: 5px; width: 35%;"><small>Vehicle Registered Number</small></td>
                    <td><small>: <b><?php echo $data_row->registered_number; ?></b></small></td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><small>Customer Name</small></td>
                    <td><small>: <b><?php echo $data_row->name; ?> (<?php echo $data_row->nic; ?>)</b></small></td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><small>Reserved Date</small></td>
                    <td><small>: <b><?php echo $data_row->from_date; ?></b></small></td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><small>Date required to return</small></td>
                    <td><small>: <b><?php echo $data_row->to_date; ?></b></small></td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><small>Start Meter Value</small></td>
                    <td><small>: <b><?php echo $data_row->start_meter_value; ?></b></small></td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><small>Advanced Payment</small></td>
                    <td><small>: <b>Rs. <?php echo number_format($data_row->advance_payment,2); ?></b></small></td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><small>Estimated Total Amount</small></td>
                    <td><small>: <b>Rs. <?php echo number_format(($data_row->price_per_day)*($data_row->no_of_days),2); ?></b></small></td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><small>Balance Amount</small></td>
                    <td><small>: <b>Rs. <?php if((($data_row->price_per_day)*($data_row->no_of_days))-$data_row->advance_payment < 0) echo number_format(0,2); else echo number_format((($data_row->price_per_day)*($data_row->no_of_days))-$data_row->advance_payment,2); ?></b></small></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 20px 0px 0px 10px;">
                        <p align="justify">
                            <small>
                                The specified distance is 200KM. There will be a charge of Rs. <b><?php echo number_format($data_row->additional_price_per_hour,2); ?></b> for each additional hour
                                or Rs. <b><?php echo number_format($data_row->additional_price_per_km,2); ?></b> for each additional kilometer.
                            </small>
                        </p>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td align="center" style="width: 30%;"><small>___________________</small></td>
                    <td></td>
                    <td align="center" style="width: 30%;"><small>___________________</small></td>
                </tr>
                <tr>
                    <td align="center" style="width: 30%;"><small>Date</small></td>
                    <td></td>
                    <td align="center" style="width: 30%;"><small>Customer's Signature</small></td>
                </tr>
                <tr>
                    <td align="center" style="width: 30%;"></td>
                    <td></td>
                    <td class="mt-4" align="center" style="width: 30%;"><small>___________________</small></td>
                </tr>
                <tr>
                    <td align="center" style="width: 30%;"></td>
                    <td></td>
                    <td align="center" style="width: 30%;"><small>Authorized Signature</small></td>
                </tr>
            </table>
        </main>

    </body>

</html>
