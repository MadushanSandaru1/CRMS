<?php

    $name=$_POST["name"];
    $email=$_POST["email"];
?>

<div class="card " id="show_reply">
    <div class="card-body">
        <br>
        <h4 class="card-title" style="color: #f5005e">Reply</h4>
        <!--<p class="card-description"> Add class <code>.table</code></p>-->
        <?php echo form_open('Home/mail'); ?>

        <form class="form-area " id="myForm" method="post" class="contact-form text-right">
            <div class="row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Name : </label>
                    <input class="common-input mb-20 form-control" type="text" value="<?php echo $name;?>"  readonly>
                    <label class="col-form-label">Email : </label>
                    <input value="<?php echo $email;?>" name="email" class="common-input mb-20 form-control"  readonly>
                    <label class="col-form-label">Message : </label>
                    <textarea class="common-textarea form-control" name="message_content" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'"></textarea>
                    <br><button class="btn btn-primary" onclick="send_reply_btn()">Send</button>
                </div>

            </div>
        </form>

        <?php echo form_close(); ?>
        <div class="text-danger">
            <?php echo validation_errors(); ?>
        </div>
    </div>
</div>
