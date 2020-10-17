<?php
    $id=$_POST["id"];

    foreach($fetch_data->result() as $row){

?>
    <div class="row mt-5" id="show_msg">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card" id="">
                <div class="card-body">
                    <br>
                    <h4 class="card-title" style="color: #f5005e" id="subject"><?php echo $row->subject;?></h4><hr>
                    <label>Name : </label> <label id="name"><?php echo $row->name;?></label><br>
                    <label>Email : </label> <label id="email"><?php echo $row->email;?></label><br>
                    <p id="demo"> </p>
                    <label>Message : </label> <label id="msg"><?php echo $row->message;?></label><br><br>
                    <a href="#show_reply">
                        <button class="btn btn-primary" id="reply-btn" onclick="reply_btn('<?php echo $row->email;?>','<?php echo $row->name;?>')">Reply</button>
                    </a>
                </div>
            </div>
        </div>
    </div>


<?php
    }
        ?>