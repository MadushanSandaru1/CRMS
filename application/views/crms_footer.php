                <!-- footer -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="" class="text-danger">Team Semicolon</a></span>
                    </div>
                </footer>
                <!-- ** footer -->

            </div>
            <!-- ** page content -->

        </div>
    </div>


    <!-- Logout Modal -->
    <div class="modal fade" id="signoutModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('User/user_signout');?>
                <form>
                    <div class="modal-body">
                        Are you sure that you want to sign out?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Yes</button>
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
                    </div>
                </form>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- ** Logout Modal -->

    <!-- js -->
    <script src="<?php echo base_url('assets/vendors/js/vendor.bundle.base.js');?>"></script>
    <script src="<?php echo base_url('assets/js/off-canvas.js');?>"></script>
    <script src="<?php echo base_url('assets/js/hoverable-collapse.js');?>"></script>
    <script src="<?php echo base_url('assets/js/misc.js');?>"></script>
    <script src="<?php echo base_url('assets/js/file-upload.js');?>"></script>


    <script type="text/javascript">
        //live clock
        function display_c(){
            var refresh=1000; // Refresh rate in milli seconds
            mytime=setTimeout('display_ct()',refresh)
        }

        function display_ct() {
            var monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            var x = new Date();
            // date part
            var day = x.getDate();
            if (day <10 ){
                day = '0' + day;
            }
            var date = monthNames[x.getMonth()]+' '+day+', '+x.getFullYear();

            // time part
            var hour = x.getHours();
            var minute = x.getMinutes();
            var second = x.getSeconds();
            if(hour <10 ){hour='0'+hour;}
            if(minute <10 ){minute='0' + minute; }
            if(second<10){second='0' + second;}
            var time = hour+':'+minute+':'+second;
            document.getElementById('liveTime').innerHTML = date +' | '+ time;
            display_c();
        }
    </script>

</body>
</html>