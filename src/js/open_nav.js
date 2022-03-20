$('#mobile-menu').on('click', function() {
    var nav = $('.mobile-nav');  

    nav.show();
    $('#mobile-menu').hide();
});

$('#mobile-exit').on('click', function() {
    $('.mobile-nav').hide();
    $('#mobile-menu').show();
});

$(window).resize(function() {

    if ($(this).width() >= 888) { 
        $('.mobile-nav').hide();
        $('.mobile-menu').hide();
    } else
        $('.mobile-menu').show();
});