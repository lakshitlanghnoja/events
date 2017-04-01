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
                    <div id="login_message">

                    </div>
                    <div class="form-group">
                        <input type="email" id="login_email" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <input type="password" id="login_password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="login_btn" class="btn-secondary">Submit</button>                                              
                        <a href="#" title="Login" id="forgotPasswordLink"  data-toggle="modal" data-target="#forgotPasswordModal">Forgot your password?</a>
                    </div>
                </form>  
            </div>
        </div>
    </div>
</div>
<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <a href="#" title="Close" data-dismiss="modal" class="modal-close"><i class="fa fa-close"></i></a>
        <div class="modal-content">
            <div class="modal-body">
                <h3>Forgot your password?</h3>
                <form action="" method="post">
                    <div id="forgotPassword_message">

                    </div>
                    <div class="form-group">
                        <input type="email" id="forgetPassword_email" class="form-control" placeholder="Email Address">
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" id="forgotPassword_btn" class="btn-secondary">Submit</button>                        
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
                <div id="register_fom_message"></div>
                <form action="" id="registrationForm" method="post" autocomplete="off">
                    <input type="hidden" name="<?php echo $this->_ci->security->get_csrf_token_name(); ?>" value="<?php echo $this->_ci->security->get_csrf_hash(); ?>">
                    <input type="hidden" name="id" value="0">
                    <div class="form-group">
                        <input type="text" id="register_first_name" name="register_first_name" class="form-control" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input type="text" id="register_last_name" name="register_last_name" class="form-control" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="password" id="register_password" name="register_password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="text" id="register_dob" name="register_dob" class="form-control" placeholder="Date of Birth">
                    </div>
                    <div class="form-group">
                        <input type="text" id="register_mobile" name="register_mobile" class="form-control" placeholder="Mobile Number">
                    </div>            
                    <div class="form-group">
                        <button type="button" id="register_submit" class="btn-secondary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="baseURL" value="<?php echo base_url(); ?>">
<input type="hidden" id="tockenName" value="<?php echo $this->_ci->security->get_csrf_token_name(); ?>">
<input type="hidden" id="tockenValue" value="<?php echo $this->_ci->security->get_csrf_hash(); ?>">
<?php

?>
</body>
</html>