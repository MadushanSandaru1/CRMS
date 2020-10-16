<?php
    $id=$_POST["id"];

    foreach($fetch_data->result() as $row){

?>

    <div class="row" id="show_msg">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card" id="">
                <div class="card-body">
                    <br>
                    <h4 class="card-title" style="color: #f5005e" id="subject"><?php echo $row->subject;?></h4><hr>
                    <samp>Name : </samp> <label id="name"><?php echo $row->name;?></label><br>
                    <samp>Email : </samp> <label id="email"><?php echo $row->email;?></label><br>
                    <p id="demo"> </p>
                    <samp>Message : </samp> <label id="msg"><?php echo $row->message;?></label><br><br>
                    <button class="btn btn-danger" id="reply-btn" onclick="reply_btn('<?php echo $row->email;?>','<?php echo $row->name;?>')">Reply</button>
                </div>
            </div>
        </div>
    </div>


<?php
    }
        ?>