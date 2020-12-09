<?php

    //session timeout error
    if (!$this->session->userdata('user_id')) {
        $this->session->set_flashdata('user_status', 'Session timeout');

        //redirect to sign in page
        redirect('Home/crms_signin');
    }


    $class_err="none";
    $class_scc="none";

    $class= $this->uri->segment(3);
    if($class=="block"){
        $class_scc="block";
    }else if($class=="none"){
        $class_err="block";
    }
?>
<style>
    .card-body{
        font-family: Arial;
    }

    .alert{
        display: none;
    }

</style>
    <?php require_once 'crms_header.php';?>
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-message"></i>
                </span> Message
            </h3>

            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span><i class="mdi mdi-clock icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="alert alert-info" role="alert" style="display: <?php echo $class_scc;?>">
            Send  Message Successful..
        </div>
        <div class="alert alert-danger" role="alert" style="display:<?php echo $class_err;?>">
            Send  Message Not Successful..
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Data</th>
                                    <th>View Message</th>
                                </tr>
                                <?php
                                foreach($fetch_data->result() as $row){
                                    ?>
                                    <tr>
                                        <td><?php echo $row->name;?></td>
                                        <td><?php echo $row->subject;?></td>
                                        <td><?php echo $row->received_time;?></td>
                                        <td><a href="#show_msg"><button class="btn btn-primary" id="btn" onclick="getMsgId(<?php echo $row->id;?>)">View Message</button></a></td>
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
        <br>
        <br>
        <br>
        <div class="row" id="show_msg">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card" id="card">
                </div>
            </div>
        </div>
<!--end of Message View-->

    <script>
        function getMsgId(id){
            $.ajax({
                url:"<?php echo base_url('index.php/CustomerMessage/view_msg')?>",
                method:"POST",
                data: {id:id},
                success:function (data){
                    document.getElementById("card").innerHTML=data;
                }
            });
         }
    </script>
    </div>
    <!-- content-wrapper ends -->
    <?php require_once 'crms_footer.php';?>