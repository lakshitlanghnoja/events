$(document).ready(function () {
    $('#register_dob').datepicker({
        maxDate: new Date(new Date().setFullYear(new Date().getFullYear() - 18))
    });
    $('#date_of_birth').datepicker({
        maxDate: new Date(new Date().setFullYear(new Date().getFullYear() - 18))
    });

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
        baseURL = $('#baseURL').val();
        var URL = baseURL + 'users/ajax_login';

        tockenValue = $('#tockenValue').val();

        //alert(<?php echo $this->_ci->security->get_csrf_token_name(); ?>);
        $.ajax({
            type: 'POST',
            url: URL,
            data: {tture_token: tockenValue, email: email, password: password},
            success: function (data) {
                data = jQuery.parseJSON(data);

                if (data.status == 1) {
                    window.location.replace(baseURL);
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


        baseURL = $('#baseURL').val();
        var URL = baseURL + 'users/ajax_forgotPassword';

        tockenValue = $('#tockenValue').val();
        $.ajax({
            type: 'POST',
            url: URL,
            data: {tture_token: tockenValue, email: email},
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

    $('#completeEvent_btn').click(function (e) {
        e.preventDefault();
        var rate = $('#eventRating').val();
        if (rate == '') {
            $('#eventComplete_message').text('Please give some rate');
            $('#eventComplete_message').css('background-color', 'red');
            $('#eventComplete_message').css('padding', '5px');
            $('#eventComplete_message').css('border-radius', '5px');
            $('#eventComplete_message').css('margin-bottom', '10px');
            $('#eventComplete_message').css('color', '#fff');
            return false;
        }
        $('#eventComplete_message').text('');
        $('#eventComplete_message').css('background-color', '#FFFFFF');
        
        var eventJoinId = $('#submitRateEventJoinId').val();
        
        var data = $('#completeEventForm').serialize();
        baseURL = $('#baseURL').val();
        var URL = baseURL + 'events/complete_event';

        tockenValue = $('#tockenValue').val();
        $.ajax({
            type: 'POST',
            url: URL,
            data: data,
            success: function (data) {
                data = jQuery.parseJSON(data);

                if (data.status == 1) {
                    $('#eventComplete_message').text(data.msg);
                    $('#eventComplete_message').css('background-color', '#09F70D');
                    $('#eventComplete_message').css('padding', '5px');
                    $('#eventComplete_message').css('border-radius', '5px');
                    $('#eventComplete_message').css('margin-bottom', '10px');
                    $('#eventComplete_messages').css('color', '#fff');
                    setTimeout(function () {
                        $('#completeEventCloseButton').trigger('click');
                        $('#event_join_'+eventJoinId).hide();
                    }, 1500);
                    
                } else {
                    $('#eventComplete_message').text(data.msg);
                    $('#eventComplete_message').css('background-color', 'red');
                    $('#eventComplete_message').css('padding', '5px');
                    $('#eventComplete_message').css('border-radius', '5px');
                    $('#eventComplete_message').css('margin-bottom', '10px');
                    $('#eventComplete_messages').css('color', '#fff');
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
            email: {
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
                number: true,
                maxlength: 10,
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
            email: {
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
                number: "Please enter only digits",
                maxlength: "Enter only 10 digit of number"
            }
        },
        errorPlacement: function (error, element) {
            element.after(error);
        }
    });

    $('#register_submit').click(function (e) {
        e.preventDefault();
        if ($("#registrationForm").valid()) {
            baseURL = $('#baseURL').val();
            var URL = baseURL + 'users/ajax_registration';
            formData = $('#registrationForm').serialize();
            tockenValue = $('#tockenValue').val();
            $.ajax({
                type: 'POST',
                url: URL,
                data: formData,
                success: function (data) {
                    data = jQuery.parseJSON(data);
                    if (data.status == 1) {
                        $('#registrationForm').find("input[type=text], textarea").val("");
                        $('#register_fom_message').text(data.msg);
                        $('#register_fom_message').css('background-color', '#09F70D');
                        $('#register_fom_message').css('padding', '5px');
                        $('#register_fom_message').css('border-radius', '5px');
                        $('#register_fom_message').css('margin-bottom', '10px');
                        $('#register_fom_message').css('color', '#fff');
                    } else {
                        $('#register_fom_message').text(data.msg);
                        $('#register_fom_message').css('background-color', 'red');
                        $('#register_fom_message').css('padding', '5px');
                        $('#register_fom_message').css('border-radius', '5px');
                        $('#register_fom_message').css('margin-bottom', '10px');
                        $('#register_fom_message').css('color', '#fff');
                        return false;
                    }
                }
            });
        }
        return false;
    });

    $("#profile_form").validate({
        rules: {
            firstname: {
                required: true,
                noSpace: true
            },
            lastname: {
                required: true,
                noSpace: true
            },
            email: {
                required: true,
                noSpace: true,
                email: true
            },
            date_of_birth: {
                required: true,
                noSpace: true,
                date: true
            },
            mobile_number: {
                required: true,
                noSpace: true,
                number: true,
                maxlength: 10,
            },
            social_media_link: {
                url: true
            }

        },
        messages: {
            firstname: {
                required: "Please enter first name",
                noSpace: "Please enter first name",
            },
            lastname: {
                required: "Please enter last name",
                noSpace: "Please enter last name",
            },
            email: {
                required: "Please enter email address",
                noSpace: "Please enter email address",
                email: "Please enter valid email address",
            },
            date_of_birth: {
                required: "Please enter date of birth",
                noSpace: "Please enter date of birth",
                date: "Please enter valid date",
            },
            mobile_number: {
                required: "Please enter mobile number",
                noSpace: "Please enter mobile number",
                number: "Please enter valid mobile number",
                maxlength: "Enter only 10 digit of number",
            },
            social_media_link: {
                url: "Please enter valid URL"
            }
        },
        errorPlacement: function (error, element) {
            element.after(error);
        }
    });

    $('.updateProfileForm').click(function (e) {
        e.preventDefault();
        if ($("#profile_form").valid()) {
            $('#profile_form').submit();
        }
    });
});
