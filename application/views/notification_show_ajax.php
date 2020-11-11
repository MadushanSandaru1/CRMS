<?php
$id=$_POST["id"];

foreach($fetch_data->result() as $row){
    ?>
    <div class="row"id="notify">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" style="color: #f5005e" id="subject"><?php echo $row->title;?></h4><br>
                    <table class="table">
                        <tr>
                            <td>Registered Number :</td>
                            <td><?php echo $row->registered_number;?></td>
                        </tr>
                        <tr id="customRadioInline1" name="get_time" value="all" class="" data-toggle="collapse"  href="#revenue_license_date" aria-expanded="false" aria-controls="collapseExample ">
                            <td >Revenue license Date :</td>
                            <td><?php echo $row->revenue_license_date;?>&nbsp;&nbsp;&nbsp;<span class="mdi mdi-arrow-down-drop-circle" style=""></span></td>
                        </tr>
                        <tr>
                            <td colspan="2"  style="text-align: left;">
                                <div class="collapse " id="revenue_license_date">
                                    <div class="col">
                                        <input type="date" name="start_date" class="form-control" value="9" style="width: 90%;">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr id="customRadioInline1" name="get_time" value="all" class="" data-toggle="collapse"  href="#insurence_date" aria-expanded="false" aria-controls="collapseExample ">
                            <td>Insurance date :</td>
                            <td><?php echo $row->insurence_date;?>&nbsp;&nbsp;&nbsp;<span class="mdi mdi-arrow-down-drop-circle" style=""></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="collapse " id="insurence_date">
                                    <div class="col">
                                        <input type="date" name="start_date" class="form-control" value="9" style="width: 90%;">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>


                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <img src="<?php echo base_url($row->image);?>" style="width:380px;height: 250px;border-radius: 10px;">
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>


    <?php
}
?>