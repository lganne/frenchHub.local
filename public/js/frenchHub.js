/* parallax */
$(window).scroll(function(){
    var position = $(this).scrollTop();
    $('.parallax img').css({top:position/1.2});

    if ($(this).scrollTop() > 100) {
        $('#scrollup').fadeIn();
    } else {
        $('#scrollup').fadeOut();
    }
});

$('.parallaxScroll').on('click','',function(){
    var top = $('section').first().position().top;
    $("html, body").animate({
        scrollTop: top}, {easing: "swing", duration: 800
    });
});

$('#scrollup').click(function(){
    $("html, body").animate({ scrollTop: 0 }, 400);
    return false;
});


$(document).ready(function(){
    
    /* Onglets */
    $('ul.tabs li').click(function(){
        var tab_id = $(this).attr('data-tab');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
    });

    $('.login').click(function(e){
        $('.login').slideToggle();
        $('.form').fadeToggle();
    });
})