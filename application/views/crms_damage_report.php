<?php require_once 'crms_header.php';?>
    <div class="content-wrapper">
        <!--div class="row" id="proBanner">
            <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                  <p>Get tons of UI components, Plugins, multiple layouts, 20+ sample pages, and more!</p>
                  <a href="" class="btn download-button purchase-button ml-auto">Upgrade To Pro</a>
                  <i class="mdi mdi-close" id="bannerClose"></i>
                </span>
            </div>
        </div-->

        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-clipboard-text"></i>
                </span> Damage Report </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="color: #F7396F;">Damage Report Generation</h4>
                        <!--<p class="card-description"> Basic form layout </p>-->  
                        <br>

                        <!--<div class="alert alert-danger">-->
                            <?php 
                                    if(!empty(validation_errors()))
                                        echo "<span style='color:red;'>".validation_errors()."</span>"; 
                            ?>
                        <!--</div>-->
                        <?php echo form_open('Damage_Report/GenerateDamageReport'); ?>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Vahicle ID</label>
                                <select class="form-control" name="vehicle_id">
                                    <?php if(count($getVehicleID)): ?>
                                        <?php foreach($getVehicleID as $value):?>
                                            <option value=<?php echo $value->id;?>><?php echo $value->id;?></option>
                                        <?php endforeach;?>
                                    <?php endif; ?>
                                 </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Time Duration</label>
                                <input type="Date" class="form-control" id="exampleInputEmail1" placeholder="" name = "fdate">
                                <input type="Date" class="form-control" id="exampleInputEmail1" placeholder=" " name = "tdate">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Include Damage Picture</label>
                                <select class="form-control" name = "is_include_damage_picture">
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Types of Solved</label>
                                <select class="form-control" name="is_solved_type">
                                    <option>All</option>
                                    <option>Solved Damages</option>
                                    <option>Not Solved Damages</option>
                                </select>
                            </div>
                      
                      
                            <button type="submit" class="btn btn-gradient-primary mr-2">Generate</button>
                            <button class="btn btn-light">Cancel</button>
                        <?php echo form_close(); ?>   
                    </div>
                </div>
            </div>

            <!-- Table part -->
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="color: #F7396F;">Damage Details</h4>
                        <!--<p class="card-description"> Add class <code>.table</code></p>-->
                    
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Vehicle ID</th>
                                    <th>Date</th>
                                    <th>Discription</th>
                                    <th>Reserved ID</th>
                                    <!--<th style="text-align: center;">Picture</th>-->
                                    <th>Fix Amount</th>
                                    <th>Is Solved</th>
                                    <th style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($getDamageDetails)):?>
                                    <?php foreach($getDamageDetails as $values): ?>                                    
                                        <tr>
                          	                <td><?php echo "".$values->vehicle_id;?></td>
                          	                <td><?php echo $values->date;?></td>
                          	                <td><?php echo $values->description; ?></td>
                          	                <td><?php echo "".$values->reserved_id; ?></td>
                          	                <!--<td><input type="submit" name="" class="btn btn-success" value="View"></td>-->
                          	                <td><?php echo $values->fix_amount." LKR/-"; ?></td>
                                            <td>
                                                <?php
                                                        if($values->is_solved == 0)
                                                        {
                                                            echo "<b style='color: red;'>Not Yet</b>" ;
                                                        } 
                                                        else
                                                            echo "<b style='color: green;'>Yes</b>" ;
                                                ?>
                                            </td>
                          	                <td>
                          		                <input type="submit" name="" class="btn btn-success" value="Edit">
                          		                <input type="submit" name="" class="btn btn-gradient-primary" value="Remove"></td>
                          	                </td>

                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                       	        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>