var msg_element = $('.message');
var message = $('.message span');

$('.signup-form').on('submit', function() {
    var username = $('input[name=username]');
    var password = $('input[name=password]');
    var confirm_password = $('input[name=confirm-password]');
    var type = $('select[name=type]');
    var id = $('input[name=id');

    if(username.val() == '' || password.val() == '' || 
        confirm_password.val() == '' || type.val() == null || id.val() == '') {
        msg_element.css('display', 'block');
        message.html('Please complete the form');
        return false;
    }else if(password.val() != confirm_password.val()) {
        msg_element.css('display', 'block');
        message.html('Passwords are not same');
        return false;
    }

    msg_element.css('display', 'none');
    return true;
});

$('.login-form').on('submit', function(){
    var username = $('input[name=username]');
    var password = $('input[name=password]');

    if(username.val() == '' || password.val() == '') {
        msg_element.css('display', 'block');
        message.html('Please complete the form');
        return false;
    }

    msg_element.css('display', 'none');
    return true;
});