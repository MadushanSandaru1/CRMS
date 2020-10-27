<?php
    // alert box...
    $class_err="none";
    $class_scc="none";

    $class= $this->uri->segment(3);
    if($class=="block"){
        $class_scc="block";
    }else if($class=="none"){
        $class_err="block";
    }
?>
<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>

        <style>
            .card-body{
                font-family: Arial;    
            }

            .alert{
                display: none;
            }

        </style>
    </head>
    <body>
    <?php require_once 'crms_header.php';?>
    <div class="content-wrapper">
<!--        <div class="row" id="proBanner">-->
<!--            <div class="col-12">-->
<!--                <span class="d-flex align-items-center purchase-popup">-->
<!--                  <p>Get tons of UI components, Plugins, multiple layouts, 20+ sample pages, and more!</p>-->
<!--                  <a href="" class="btn download-button purchase-button ml-auto">Upgrade To Pro</a>-->
<!--                  <i class="mdi mdi-close" id="bannerClose"></i>-->
<!--                </span>-->
<!--            </div>-->
<!--        </div>-->

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
<!--                        <br>-->
<!--                        <h4 class="" style="">Message</h4>-->
                        <!--<p class="card-description"> Add class <code>.table</code></p>-->

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
                                        <td><a href="#show_msg"><button class="btn btn-primary" id="btn btn2" onclick="getMsgId(<?php echo $row->id;?>)">View Message</button></a></td>
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

<!--Reply section-->
        <div class="row" >
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card " id="show_reply">

                </div>
            </div>
<!--End of Reply section-->
    <script>
        // function getMsgId(id){
        //     // alert(id);
        //     var xhttp = new XMLHttpRequest();
        //     xhttp.onreadystatechange = function() {
        //         if (this.readyState == 4 || this.status == 200) {
        //             document.getElementById("demo").innerHTML =this.responseText;
        //         }
        //     };
        //     xhttp.open("GET", "test_msg.php?id="+id, true);
        //     xhttp.send();
        // }

        function getMsgId(id){
            $.ajax({
                url:"<?php echo base_url('index.php/Home/view_msg')?>",
                method:"POST",
                data: {id:id},
                success:function (data){
                    document.getElementById("card").innerHTML=data;
                }
            });
         }

        $(document).ready(function(){
            $("#btn2").click(function (){
                $("#show_msg").slideDown();
            });

            $("#reply-btn").click(function (){
                $("#show_reply").toggle(1000);
            });
        });

        function reply_btn(email,name,msg_id){
            $.ajax({
                url:"<?php echo base_url('index.php/Home/reply_msg')?>",
                method:"POST",
                data: {email:email,name:name,msg_id:msg_id},
                success:function (data){
                    document.getElementById("show_reply").innerHTML=data;
                }
            });
        }

        // function smoothscroll(target,duration){
        //     var target=document.querySelector(target);
        //     var targetPosition=target.getBoundingClientRect().top;
        //     var startPosition=window.pageYOffset;
        //     var distance =targetPosition-startPosition;
        //     var startTime=null;
        //     console.log(startPosition);
        //     console.log(targetPosition);
        //     console.log(target);
        //
        //     function animation(currentTime){
        //         if(startTime===0)startTime=currentTime;
        //         var timeElapsed=currentTime-startTime;
        //         var run=ease(timeElapsed,startPosition,distance,duration);
        //         window.scrollTo(0,run);
        //         if(timeElapsed<duration) requestAnimationFrame(animation);
        //     }
        //
        //     function ease(t,b,c,d){
        //         t/=d/2;
        //         if(t<1) return c/1*t*t+b;
        //         t--;
        //         return -c/2*(t*(t-2)-1)+b;
        //     }
        //
        //     requestAnimationFrame(animation);
        // }
        //
        // var viewbtn=document.querySelector(".viewbtn");
        // viewbtn.addEventListener('click',function (){
        //     smoothscroll(".card",2000);
        // });
    </script>

    </div>
    <!-- content-wrapper ends -->
    <?php require_once 'crms_footer.php';?>
    </body>
</html>