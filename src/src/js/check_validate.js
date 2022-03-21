var msg_element = $('.message');
var message = $('.message span');

$('.signup-form').on('submit', function() {

    msg_element.addClass('error');
    msg_element.removeClass('success');
    
    var username = $('input[name=username]');
    var name = $('input[name=name]');
    var password = $('input[name=password]');
    var confirm_password = $('input[name=confirm-password]');
    var type = $('select[name=type]');
    var dob = $('input[name=dob]');
    //var id = $('input[name=id');

    if(username.val() == '' || password.val() == '' || 
        confirm_password.val() == '' || type.val() == null || name.val() == '' || dob.val() == '') {
        msg_element.css('display', 'block');
        message.html('Please complete the form');
        return false;
    }else if(password.val() != confirm_password.val()) {
        msg_element.css('display', 'block');
        message.html('Passwords are not same');
        return false;
    }

    msg_element.css('display', 'none');

    $.ajax({
        url: 'php/signup.php',
        method: 'POST',
        data: {username:username.val(), name:name.val(), password:password.val(), type:type.val(), dob:dob.val()},
        success: function(data) {
            if(data == 'true') {
                msg_element.removeClass('error');
                msg_element.addClass('success');
                msg_element.css('display', 'block');
                message.html('Register Success');
                $('.signup-form')[0].reset();
            }else {
                msg_element.css('display', 'block');
                message.html(data);
            }
        }
    });

    return false;
});

$('.login-form').on('submit', function() {
    msg_element.addClass('error');
    msg_element.removeClass('success');

    var username = $('input[name=username]');
    var password = $('input[name=password]');

    if(username.val() == '' || password.val() == '') {
        msg_element.css('display', 'block');
        message.html('Please complete the form');
        return false;
    }

    msg_element.css('display', 'none');
    
    $.ajax({
        url: 'php/login.php',
        method: 'POST',
        data: {username:username.val(), password:password.val()},
        success: function(data) {
            if(data == 'Invalid username or password') {
                msg_element.css('display', 'block');
                message.html(data);
            }else {
                window.location.replace(data + '/');
            }
        }
    });

    return false;
});