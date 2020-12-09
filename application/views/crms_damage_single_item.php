<?php date_default_timezone_set("Asia/Colombo"); ?>
<?php
    $registered_vehicle="";
    foreach ($damageDetails as $values)
    {
        $registered_vehicle = $values->vehicle_id;
    }

    for ($i=0;$i < sizeof($getVehicleID);$i++)
    {
        if ($getVehicleID[$i]->id == $registered_vehicle)
        {
            $registered_vehicle = $getVehicleID[$i]->registered_number;
        }
    }
?>
<?php
    $reserved_person="";
    foreach ($damageDetails as $values)
    {
        $reserved_person = $values->reserved_id;
    }

    for ($i=0;$i < sizeof($getCustomerDetails);$i++)
    {
        if ($getCustomerDetails[$i]->id == $reserved_person)
        {
            $reserved_person = $getCustomerDetails[$i]->name;
        }
    }
?>
<html>
    <head>
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


        <header>
            <img src="assets/images/report_header.png" width="100%" height="20%"/>
            <small><pre class="text-right mr-5">printed date: <?php echo Date('Y-m-d h:i:s a',time()) ?></pre></small>
        </header>

        <footer class="text-center">
            <p class="mt-4">Copyright &copy; <?php echo date("Y");?> All rights reserved | Team Semicolon</p>
        </footer>
        <?php  foreach ($damageDetails as $detail):?>
        <main>
            <table class="ml-10">
                <tr>
                    <td colspan="2" class="text-danger text-center mb-3"><h3><?php echo $registered_vehicle;?> Vehicle Damage Details</h3></td>
                </tr>
                <tr>
                    <td><?php echo "<img src='".$detail->image."'   width=200px height=150px >"?></td>
                </tr>
                <tr>
                    <td style="padding: 10px; width: 30%;">Vehicle Registered Number</td>
                    <td>: <b><?php echo $registered_vehicle; ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Damage Description</td>
                    <td>: <b><?php echo $detail->description; ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Recorded Date</td>
                    <td>: <b><?php echo $detail->d_date; ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Reserved Person</td>
                    <td>: <b><?php echo $reserved_person; ?></b></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">Fix Amount</td>
                    <td>: <b><?php echo $detail->fix_amount." LKR/-"; ?></b></td>
                </tr>
                <?php if($detail->is_solved == 1):?>
                    <tr>
                        <td style="padding: 10px;">Solved Status</td>
                        <td>: <b>Damage Solved</b></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td style="padding: 10px;">Solved Status</td>
                        <td>: <b>Damage Not Solved</b></td>
                    </tr>
                <?php endif;?>
                <tr>
                    <td colspan="2" style="padding: 30px 10px 30px 10px;">
                        <p align="justify">
                            I do here by certify that all the details above furnished by me are true and accurate to the best of my knowledge.
                        </p>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td align="center" style="width: 25%;">___________________</td>
                    <td></td>
                    <td align="center" style="width: 25%;">___________________</td>
                </tr>
                <tr>
                    <td align="center" style="width: 25%;">Date</td>
                    <td></td>
                    <td align="center" style="width: 25%;">Signature</td>
                </tr>
            </table>
        </main>
        <?php endforeach;?>
    </body>
</html>
