$('.exit-background').on('click', function(e){
    var target = $(e.target);

    if(!target.is('.form-container')) return;
    else
        $('.exit-background').hide();
});

$('.exit-btn').on('click', function(e){
    $('.exit-background').hide();
});

// Add Proposal Page
$('#add-proposal').on('click', function(){
    $('.exit-background').show();
});

// Project Planning
$('.view-planning').on('click', function(){
    $('.exit-background').show();
});

// Meeting
$('.view-meeting').on('click', function(){
    $('.meeting-container').show();
});

$('.add-meeting').on('click', function(){
    $('.add-meeting-container').show();
});

// Mark
$('.mark-project').on('click', function(){
    $('.exit-background').show();
});

//Homepage
$('#login').on('click', function(){
    $('.login-container').show();
    $('.message').css('display', 'none');
});
$('#signup').on('click', function(){
    $('.signup-container').show();
    $('.message').css('display', 'none');
});