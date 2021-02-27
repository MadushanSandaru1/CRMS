<?php date_default_timezone_set("Asia/Colombo"); ?>

<?php
    foreach($report_vehicle->result() as $row){}
?>

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
                    <td colspan="4" class="text-danger text-center">
                        <h6>

                            Vehicle
                            <?php
                                if($this->session->tempdata('expense_report_type') == 'all')
                                    echo "Income/Expenses";
                            elseif($this->session->tempdata('expense_report_type') == 'expense')
                                echo "Expenses";
                            else
                                echo "Income";
                            ?>
                            Report - <?php echo $row->registered_number; ?>
                        </h6>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center">
                        <?php echo $row->title; ?>
                    </td>
                </tr>

                <?php if($this->session->tempdata('expense_report_start_date')) {
                ?>
                <tr>
                    <td colspan="4" class="text-danger text-center">
                        <?php echo $this->session->tempdata('expense_report_start_date')." to ".$this->session->tempdata('expense_report_end_date'); ?>
                    </td>
                </tr>

                    <?php
                }
                ?>
                <tr>
                    <td colspan="4" class="py-3">

                    </td>
                </tr>
                <tr>
                    <th style="padding: 5px; width: 10%;">#</th>
                    <th style="padding: 5px; width: 20%;">Date</th>
                    <th style="padding: 5px; width: 15%;">Type</th>
                    <th style="padding: 5px; width: 20%;">Amount (LKR)</th>
                </tr>
                <?php
                    $i=1;
                    $income_sum=0;
                    $expense_sum=0;
                    foreach($this->session->tempdata('expense_report_details') as $data_row){
                ?>
                <tr>
                    <td style="padding: 5px; width: 10%;"><small><?php echo $i; ?></small></td>
                    <td style="padding: 5px; width: 20%;"><small><?php echo $data_row->date; ?></small></td>
                    <td style="padding: 5px; width: 15%;"><small><?php echo $data_row->type; ?></small></td>
                    <td style="padding: 5px; width: 20%;" class="text-right"><small><?php echo number_format($data_row->amount,2); ?></small></td>
                </tr>
                <?php
                        if($data_row->type=="I") {
                            $income_sum+=$data_row->amount;
                        } elseif($data_row->type=="E") {
                            $expense_sum+=$data_row->amount;
                        }
                        $i++;
                    }
                ?>

            </table>

            <table class="mt-5">
                <?php
                if($this->session->tempdata('expense_report_type') != 'expense') {
                ?>
                <tr>
                    <td style="width: 15%;">Total Income: </td>
                    <td style="width: 25%;"><b>LKR <?php echo number_format($income_sum, 2); ?></b></td>
                </tr>
                <?php
                }
                if($this->session->tempdata('expense_report_type') != 'income') {
                ?>
                <tr>
                    <td style="width: 15%;">Total Expense: </td>
                    <td style="width: 25%;"><b>LKR <?php echo number_format($expense_sum, 2); ?></b></td>
                </tr>
                <?php
                }
                ?>
            </table>

            <table class="mt-5">
                <tr>
                    <td align="center" style="width: 30%;"><small>___________________</small></td>
                    <td></td>
                    <td align="center" style="width: 30%;"><small>___________________</small></td>
                </tr>
                <tr>
                    <td align="center" style="width: 30%;"><small>Date</small></td>
                    <td></td>
                    <td align="center" style="width: 30%;"><small>Authorized Signature</small></td>
                </tr>
            </table>
        </main>

    </body>

</html>
