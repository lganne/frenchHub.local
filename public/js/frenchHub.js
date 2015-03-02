$(document).ready(function () {
    $('#header_crossbar a').click(function () {
        $('#login_content').slideToggle();
        $(this).toggleClass('active');
        if ($(this).hasClass('active')){              
                $(this).find('span').html('&#x25b2;');
        }else{
           $(this).find('span').html('▼'); 
        }
    });

    $('#menu span').click(function() {
        $("nav").toggle("slide");
        });

    /* Scroll */
    $('a[href^="#"]').click(function(){
        var the_id = $(this).attr("href");

        $('html, body').animate({
            scrollTop:$(the_id).offset().top
        }, 1500);
        return false;
    });

    $(window).scroll(function(){
        if($(window).scrollTop()<500){
            $('#scroll_up').fadeOut();
        }else{
            $('#scroll_up').fadeIn();
        }

        $(".content").each(function(){
        if($(window).scrollTop() >= $(this).first().offset().top){
            if ($(this).attr('data-id') == 'active_content') {
                $('.menu-btn').addClass('active');
                $('.menu').addClass('menu_active');
            }
            else{
                $('.menu-btn').removeClass('active');
                $('.menu').removeClass('menu_active');
            }           
        }
        });
    });

    $('a.menu-btn').click(function(){
        $('body').toggleClass('menu-push');
        $('nav').toggleClass('menu-open');
        $('a.menu-btn').toggle('fast');
        $('a.menu-btn-active').toggle('fast');
    });

    $('a.menu-btn-active').click(function(){
        $('body').toggleClass('menu-push');
        $('nav').toggleClass('menu-open');
        $('a.menu-btn').toggle('fast');
        $('a.menu-btn-active').toggle('fast');
    });
});