</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <ul class="footer-navigation">
                    <li><a href="#" title="About us">About us</a></li>
                    <li><a href="#" title="Press Releases">Press Releases</a></li>
                    <li><a href="#" title="Careers">Careers</a></li>
                    <li><a href="#" title="Terms and Policies">Terms and Policies</a></li>
                </ul>
            </div>

            <div class="col-sm-4"></div>
            <div class="col-sm-4 clearfix">
                <h4 class="text-right">Follow us on</h4>
                <ul class="social-icons clearfix pull-right">
                    <li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                    <li><a href="#" title="Youtube"><i class="fa fa-youtube"></i></a></li>
                </ul>
                <p class="text-right pull-right">All rights reserved @2017</p>
            </div>
        </div>
    </div>
</footer>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <a href="#" title="Close" data-dismiss="modal" class="modal-close"><i class="fa fa-close"></i></a>
        <div class="modal-content">
            <div class="modal-body">
                <h3>Login</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <input type="email" id="login_email" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <input type="password" id="login_password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="login_btn" class="btn-secondary">Submit</button>
                        <a href="#" title="Forgot your password" class="form-link">Forgot your password?</a>
                    </div>
                </form>  
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">

        <a href="#" title="Close" data-dismiss="modal" class="modal-close"><i class="fa fa-close"></i></a>
        <div class="modal-content">
            <div class="modal-body">
                <h3>Register</h3>
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Mobile Number">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-secondary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#login_btn').click(function (e) {
        e.preventDefault();
        var email = $('#login_email').val();
        var password = $('#login_password').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . $this->_data['section_name']; ?>/users/index',
            data: {<?php echo $this->_ci->security->get_csrf_token_name(); ?>: '<?php echo $this->_ci->security->get_csrf_hash(); ?>', email: email, password: password},
            success: function (data) {
//                    alert(data); return;

                //for managing same state while record delete
                if ($('.rows') && $('.rows').length > 1) {
                    pageno = "&page_number=<?php echo $page_number; ?>";
                } else {
                    pageno = "&page_number=<?php echo $page_number - 1; ?>";
                }
                ajaxLink('<?php echo base_url() . $this->_data['section_name']; ?>/users/index', 'ajax_table', '<?php echo $querystr; ?>' + pageno);
                $("#messages").show();
                $("#messages").html(data);
            }
        });
    });
</script>
</body>
</html>