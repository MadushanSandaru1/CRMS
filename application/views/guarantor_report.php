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
    <body>

        <?php foreach($report_details->result() as $data_row){} ?>

        <!-- Define header and footer blocks before your content -->
        <header>
            <img src="assets/images/report_header.png" width="100%" height="20%"/>
            <small><pre class="text-right mr-5">printed date: <?php echo Date('Y-m-d h:i:s a',time()) ?></pre></small>
        </header>

        <footer class="text-center">
            <p class="mt-4">Copyright &copy; <?php echo date("Y");?> All rights reserved | Team Semicolon</p>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <table>
                <tr>
                    <td colspan="2" class="text-danger text-center mb-3"><h2>Guarantor's Statement</h2></td>
                </tr>
                <tr>
                    <td style="padding: 10px; width: 30%;">Vehicle Reserved ID</td>
                    <td>: <b><?php echo $data_row->reserved_id; ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Name</td>
                    <td>: <b><?php echo $data_row->name; ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">NIC Number</td>
                    <td>: <b><?php echo $data_row->nic; ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Address</td>
                    <td>: <b><?php echo $data_row->address; ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Phone Number</td>
                    <td>: <b><?php echo $data_row->phone; ?></b></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 30px 10px 30px 10px;">
                        <p align="justify">
                            I know Mr. / Mrs. <b><?php echo $data_row->customer_name; ?></b> very well who received the car / motorcycle bearing number <b><?php echo $data_row->vehicle_no; ?></b> from Abhaya rent a car on <b><?php echo $data_row->from_date; ?></b> and I will represent those who took over the vehicle in case of breach of terms and conditions of the company. I hereby certify that I am liable on behalf of the person who took over this vehicle, if necessary, for any legal purpose.
                        </p>
                    </td>
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
                    <td align="center" style="width: 30%;">Guarantor's Signature</td>
                </tr>
            </table>
        </main>

    </body>

</html>
