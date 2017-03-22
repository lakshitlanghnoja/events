$(document).ready(function () {
    $('#login_btn').click(function (e) {
        e.preventDefault();
        var email = $('#login_email').val();
        var password = $('#login_password').val();

        if (email == '') {
            $('#login_message').text('Please enter valid email address');
            $('#login_message').css('background-color', 'red');
            $('#login_message').css('padding', '5px');
            $('#login_message').css('border-radius', '5px');
            $('#login_message').css('margin-bottom', '10px');
            $('#login_message').css('color', '#fff');
            return false;
        }
        if (password == '') {
            $('#login_message').text('Please enter password');
            $('#login_message').css('background-color', 'red');
            $('#login_message').css('padding', '5px');
            $('#login_message').css('border-radius', '5px');
            $('#login_message').css('margin-bottom', '10px');
            $('#login_message').css('color', '#fff');
            return false;
        }

        $('#login_message').text('');
        $('#login_message').css('background-color', '#FFFFFF');

        var URL = '<?php echo base_url(); ?>users/ajax_login';
        //alert(<?php echo $this->_ci->security->get_csrf_token_name(); ?>);
        $.ajax({
            type: 'POST',
            url: URL,
            data: {'<?php echo $this->_ci->security->get_csrf_token_name(); ?>': '<?php echo $this->_ci->security->get_csrf_hash(); ?>', email: email, password: password},
            success: function (data) {
                data = jQuery.parseJSON(data);

                if (data.status == 1) {
                    window.location.replace("<?php echo base_url(); ?>");
                } else {
                    $('#login_message').text(data.msg);
                    $('#login_message').css('background-color', 'red');
                    $('#login_message').css('padding', '5px');
                    $('#login_message').css('border-radius', '5px');
                    $('#login_message').css('margin-bottom', '10px');
                    $('#login_message').css('color', '#fff');
                    return false;
                }
            }
        });
    });

    $('#forgotPasswordLink').click(function () {
        $('.modal-close').trigger('click');
    });

    $('#forgotPassword_btn').click(function (e) {
        e.preventDefault();
        var email = $('#forgetPassword_email').val();

        if (email == '') {
            $('#forgotPassword_message').text('Please enter valid email address');
            $('#forgotPassword_message').css('background-color', 'red');
            $('#forgotPassword_message').css('padding', '5px');
            $('#forgotPassword_message').css('border-radius', '5px');
            $('#forgotPassword_message').css('margin-bottom', '10px');
            $('#forgotPassword_message').css('color', '#fff');
            return false;
        }

        $('#forgotPassword_message').text('');
        $('#forgotPassword_message').css('background-color', '#FFFFFF');

        var URL = '<?php echo base_url(); ?>users/ajax_forgotPassword';
        $.ajax({
            type: 'POST',
            url: URL,
            data: {'<?php echo $this->_ci->security->get_csrf_token_name(); ?>': '<?php echo $this->_ci->security->get_csrf_hash(); ?>', email: email},
            success: function (data) {
                data = jQuery.parseJSON(data);

                if (data.status == 1) {
                    $('#forgotPassword_message').text(data.msg);
                    $('#forgotPassword_message').css('background-color', '#09F70D');
                    $('#forgotPassword_message').css('padding', '5px');
                    $('#forgotPassword_message').css('border-radius', '5px');
                    $('#forgotPassword_message').css('margin-bottom', '10px');
                    $('#forgotPassword_message').css('color', '#fff');
                } else {
                    $('#forgotPassword_message').text(data.msg);
                    $('#forgotPassword_message').css('background-color', 'red');
                    $('#forgotPassword_message').css('padding', '5px');
                    $('#forgotPassword_message').css('border-radius', '5px');
                    $('#forgotPassword_message').css('margin-bottom', '10px');
                    $('#forgotPassword_message').css('color', '#fff');
                    return false;
                }
            }
        });
    });

    jQuery.validator.addMethod("noSpace", function (value, element) {
        return value.trim() != "";
    });
    $("#registrationForm").validate({
        rules: {
            register_first_name: {
                required: true,
                noSpace: true
            },
            register_last_name: {
                required: true,
                noSpace: true
            },
            register_email: {
                required: true,
                noSpace: true,
                email: true
            },
            register_password: {
                required: true,
                noSpace: true
            },
            register_dob: {
                required: true,
                noSpace: true,
                date: true
            },
            register_mobile: {
                required: true,
                noSpace: true,
                number: true
            },

        },
        messages: {
            register_first_name: {
                required: "Please enter your first name",
                noSpace: "Please enter your first name"
            },
            register_last_name: {
                required: "Please enter your last name",
                noSpace: "Please enter your last name"
            },
            register_email: {
                required: "Please enter your email address",
                noSpace: "Please enter your email address",
                email: "Please enter valid email address"
            },
            register_password: {
                required: "Please enter your password",
                noSpace: "Please enter your password"
            },
            register_dob: {
                required: "Please select your date of birth",
                noSpace: "Please enter your date of birth",
                date: "Plese enter valid date in mm/dd/yyyy formate"
            },
            register_mobile: {
                required: "Please enter postcode",
                noSpace: "Please enter postcode",
                number: "Please enter only digits"
            }
        },
        errorPlacement: function (error, element) {
            element.after(error);
        }
    });

    $('#register_submit').click(function () {
        if ($('#registrationForm').valid()){
               alert('success');
        }
        
        
    });
});