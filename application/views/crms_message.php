<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>

        <style>
            .card-body{
                font-family: Arial;
            }

            #show_msg ,#show_reply{
                display: none;
            }
        </style>
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
<!--                        <br>-->
<!--                        <h4 class="" style="">Message</h4>-->
                        <!--<p class="card-description"> Add class <code>.table</code></p>-->

                        <div>
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
<!--                                    <th>Message</th>-->
                                    <th>Data</th>
                                    <th>View Message</th>
                                </tr>
                                <?php
                                foreach($fetch_data->result() as $row){
                                    ?>
                                    <tr>
                                        <td><?php echo $row->name;?></td>
                                        <td><?php echo $row->email;?></td>
                                        <td><?php echo $row->subject;?></td>
                                        <td><?php echo $row->received_time;?></td>
                                        <td><button class="btn btn-danger" id="btn" onclick="getMsgId('<?php echo $row->message;?>','<?php echo $row->name;?>','<?php echo $row->subject;?>','<?php echo $row->email;?>')">View Message</button></td>
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

<!--Message View-->
        <div class="row" id="show_msg">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <br>
                        <h4 class="card-title" style="color: #f5005e" id="subject"></h4><hr>
                        <samp>Name : </samp> <label id="name"></label><br>
                        <samp>Email : </samp> <label id="email"></label><br>
                        <p > </p>
                        <samp>Message : </samp> <label id="msg"></label><br><br>
                        <button class="btn btn-danger" id="reply-btn">Reply</button>
                    </div>
                </div>
            </div>
        </div>
<!--end of Message View-->

<!--Reply section-->
        <div class="row" id="show_reply">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <br>
                        <h4 class="card-title" style="color: #f5005e">Reply</h4>
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
    <script>
        // function getMsgId(id){
        //     //alert(id);
        //     var xhttp = new XMLHttpRequest();
        //     xhttp.onreadystatechange = function() {
        //         if (this.readyState == 4 || this.status == 200) {
        //             document.getElementById("demo").innerHTML =this.responseText;
        //         }
        //     };
        //     xhttp.open("GET", "test_msg.php?id="+id, true);
        //     xhttp.send();
        // }

        function getMsgId(msg,name,subject,email){
            document.getElementById("name").innerHTML=name;
            document.getElementById("subject").innerHTML=subject;
            document.getElementById("msg").innerHTML=msg;
            document.getElementById("email").innerHTML=email;
        }

        //function getMsgId(id){
        //    //alert(id);
        //    $.ajax({
        //        url:"<?php //echo base_url('index.php/Home/test_ms')?>//",
        //        method:"POST",
        //        data: {id:id},
        //        success:function (data){
        //
        //        }
        //    });
        // }

        //show message box
        $(document).ready(function(){
            $("#btn").click(function (){
                $("#show_msg").slideDown();
            });

            $("#reply-btn").click(function (){
                $("#show_reply").slideDown();
            });
        });
    </script>

    </div>
    <!-- content-wrapper ends -->
    <?php require_once 'crms_footer.php';?>
    </body>
</html>