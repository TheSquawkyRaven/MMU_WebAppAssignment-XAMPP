var show = 0;

$('#btn-see').on('click', function() {
    var password = $('input[name=password]');
    var img = $('.input-side-btn img');

    if(show == 0) {
        img.attr('src', 'assets/password_unsee.svg');
        password.attr('type', 'text');
        show = 1;
    }else {
        img.attr('src', 'assets/password_see.svg');
        password.attr('type', 'password');
        show = 0;
    }
});
