<?php
    $id=$_POST["id"];

    foreach($fetch_data->result() as $row){

?>
    <div class="row mt-5" id="show_msg">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card" id="">
                <div class="card-body">
                    <h4 class="card-title" style="color: #f5005e" id="subject"><?php echo $row->subject;?></h4><hr>
                    <label>Name : </label> <label id="name"><?php echo $row->name;?></label><br>
                    <label>Email : </label> <label id="email"><?php echo $row->email;?></label><br>
                    <p id="demo"> </p>
                    <label>Message : </label> <label id="msg"><?php echo $row->message;?></label><br><br>
                    <a href="#show_replyy">
                        <button data-toggle="modal" data-target="#revenueL" class="btn btn-primary" id="reply-btn">Reply</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
        <!-- Modal revenueL-->
        <div class="modal fade" id="revenueL" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: #f5005e" id="exampleModalLongTitle">Reply<label id="reg_num"></label></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--<p class="card-description"> Add class <code>.table</code></p>-->
                        <?php echo form_open('CustomerMessage/reply_mail'); ?>

                        <form class="form-area" id="myForm" method="post" class="contact-form text-right">
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <input type="hidden" value="<?php echo $row->id;?>" name="msg_id">
                                    <input type="hidden" value="<?php echo $row->subject;?>" name="msg_sub">
                                    <label class="col-form-label">Name : </label>
                                    <input class="common-input mb-20 form-control" type="text" value="<?php echo $row->name;?>"  readonly>
                                    <label class="col-form-label">Email : </label>
                                    <input value="<?php echo $row->email;?>" name="email" class="common-input mb-20 form-control"  readonly>
                                    <label class="col-form-label">Message : </label>
                                    <textarea class="common-textarea form-control" name="message_content" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'"></textarea>
                                    <br><input type="submit" class="btn btn-primary" name="submit" value="Send">
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
        <!--end of model-->

<?php
    }
        ?>