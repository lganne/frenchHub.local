$(document).ready(function(){
    
    /* Parallax */
    $(window).scroll(function(){
        var position = $(this).scrollTop();
        $('.parallax img').css({top:position/1.2});

        if ($(this).scrollTop() > 100) {
            $('#scrollup').fadeIn();
        } else {
            $('#scrollup').fadeOut();
        }
    });
    
    /* Scroll */
    $('a[href^="#"]').click(function(){
        var the_id = $(this).attr("href");

        $('html, body').animate({
            scrollTop:$(the_id).offset().top
        }, 'slow');
        return false;
    });

    /* Nav fixed on scrollTop */
    var nav = $('.nav'), navTopPosition = nav.offset().top;
    
    $(window).on('scroll', function(){
        if($(window).scrollTop() > navTopPosition ) {
            nav.addClass('fixed');
            
        } else {
            nav.removeClass('fixed');
        }
    });

    /* Nav slide */
    $(".open").click(function(){
        $(".contenu").animate({
            width: '260px'
        });
        $(this).hide();
        $('.close').show();
    });

    $(".close").click(function(){
        $(".contenu").animate({
            width: '120px'
        });
        $(this).hide();
        $('.open').show();
    });

    /* Login */
    $('.login').click(function(e){
        $('.login').slideToggle();
        $('.form').fadeToggle();
    });

    /* Onglets */
    $('.member').click(function(){

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $('#member').addClass('current');
        $('#tab-5').addClass('current');
    });
    
    $('ul.tabs li').click(function(){
        var tab_id = $(this).attr('data-tab');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
    });
})
