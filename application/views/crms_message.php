<html>
    <head>

    </head>
    <body>
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
                  <i class="mdi mdi-message"></i>
                </span> Message
            </h3>
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
                        <br>
                        <h4 class=" text-danger">Message</h4>
                        <!--<p class="card-description"> Add class <code>.table</code></p>-->

                        <div>
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Data</th>
                                    <th>Reply</th>
                                </tr>
                                <?php
                                foreach($fetch_data->result() as $row){
                                    ?>
                                    <tr>
                                        <td><?php echo $row->name;?></td>
                                        <td><?php echo $row->email;?></td>
                                        <td><?php echo $row->subject;?></td>
                                        <td><?php echo $row->message;?></td>
                                        <td><?php echo $row->received_time;?></td>
                                        <td><button class="btn btn-danger">Reply</button></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--Reply section-->
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <br>
                        <h4 class="card-title text-danger">Reply</h4>
                        <!--<p class="card-description"> Add class <code>.table</code></p>-->
                        <?php echo form_open('Contact/customer_message'); ?>

                        <form class="form-area " id="myForm" method="post" class="contact-form text-right">
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <input name="message_name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" class="common-input mb-20 form-control" type="text">

                                    <input name="message_email" placeholder="Enter email address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mb-20 form-control" type="email">

                                    <input name="message_subject" placeholder="Enter your subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your subject'" class="common-input mb-20 form-control" type="text">
                                    <div class="mt-20 alert-msg" style="text-align: left;"></div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <textarea class="common-textarea form-control" name="message_content" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'"></textarea>
                                    <button type="submit" class="primary-btn mt-20" style="float: right;">Send Message</button>
                                </div>

                            </div>
                        </form>

                        <?php echo form_close(); ?>
                        <div class="text-danger">
                            <?php echo validation_errors(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
<!--End of Reply section-->

    </div>
    <!-- content-wrapper ends -->
    <?php require_once 'crms_footer.php';?>
    </body>
</html>