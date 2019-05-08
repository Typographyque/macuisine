/*------------------------------------*\
            SECTION WELCOME
\*----------------------------------- */

function HeightBackground(){
    height = $(window).height();
    $("#welcome").css({
        'height': height
    })
}

function shrinkNav(){
    $window = $(window);
    $(window).scroll(function () {
        if($window.scrollTop() > 50){
            $("#header").removeClass('full');
            $("#header").addClass('shrink');
        }else{
            $("#header").removeClass('shrink');
            $("#header").addClass('full');
        }
    })
}

function scrollFade(){
    scrollPos = $(this).scrollTop();
    $(".welcome_content").css({
        'opacity': 1 - (scrollPos / 400),
        'margin-top': (scrollPos / 4) + "px",
    })
}

function welcomeHidde(){
    $window = $(window);
    $(window).scroll(function () {
        if ($window.scrollTop() > 400){
            $(".welcome_content").addClass('hide');
        }else{
            $(".welcome_content").removeClass('hide');
        }
    })

}

$(document).ready(function(){
    HeightBackground();
    $(window).resize(function(){
        HeightBackground();
    })
    $(window).scroll(function(){
        shrinkNav();
        scrollFade();
        welcomeHidde()
    })
})

$(document).on('click', '#icon_burger', function () {
    $('#main_menu').toggleClass('responsive');
})