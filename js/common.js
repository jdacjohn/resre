// JavaScript Document


setTimeout(function () {
    window.scrollTo(0, 0);
}, 1);

$(window).on('resize', function (event) {
    setCarousel(window.innerWidth);
});

$(document).ready(function (e) {


    $('.drop_up_toggle').on('click', function (e) {

        e.preventDefault();

        $('.drop_up').toggleClass('active');
        $('header.busines').toggleClass('active');
        /* Original code*/
        if ($(this).html() == 'TOOLKITS')
        {
            $(this).html('CLOSE');
        } else
        {
            $(this).html('TOOLKITS');
        }

        if ($(this).attr('aria-expanded') == 'false')
        {
            $(this).attr('aria-expanded', 'true');
            $('.drop_up_menuitem').attr('tabindex', '0');
            $('.drop_up_menuitem').attr('aria-hidden', 'false')
        } else
        {
            $(this).attr('aria-expanded', 'false');
            $('.drop_up_menuitem').attr('tabindex', '-1');
            $('.drop_up_menuitem').attr('aria-hidden', 'true')
        }

    });

    $('.drop_up_toggle').focus(function (e) {

        e.preventDefault();
        if ($('.drop_up').hasClass('active') != true)
        {
            /*
             $('.drop_up').addClass('active');
             $('header.busines').addClass('active');
             if($(this).html()=='TOOLKITS')
             {
             $(this).html('CLOSE'); 
             }
             */
            $(this).attr('aria-expanded', 'false');
            $('.drop_up_menuitem').attr('tabindex', '-1');
        }
    });

    //MOBILE MENU FIX

    $('.navbar-toggle').on('click', function () {

        $(this).parents('nav').toggleClass('custom_navbar_scroll');
    });

    setCarousel(window.innerWidth);

    var hash = location.hash
    if (hash)
    {
        $('html, body').stop();
        var target = hash,
                $target = $(target);

        if ($target.length)
        {
            scrollToObject($target);
        }
    }

    $("#VideoModal .close").on("click", function () {
        $("#VideoModal iframe").attr("src", $("#VideoModal iframe").attr("src"));
    });

    $('.tweeter_box iframe').find('a').css('color', '#eda83c');

    $('#kids_nav').on('click', function (e)
    {
        window.location.replace('kids.html');
    });

    $('.custom_navbar a, .scroll_to').on('click', function (e) {

        var current_page = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);
        var hash = this.hash;
        var dest = this.href.substring(this.href.lastIndexOf("/") + 1);

        if (dest == current_page + hash)
        {
            var target = hash,
                    $target = $(target);
            if (target)
            {
                e.preventDefault();

                var $target = $(target);
                if ($target.length)
                {
                    scrollToObject($target);
                }
            }
        }
    });

    /*$('.scroll_to30').on('click',function (e) {
     scrollToObject($('#header_anchor'));
     });
     */

});


function scrollToObject($target)
{
    var nav_offset = $('.navbar').innerHeight();
    $('html, body').stop().delay(300).animate({
        'scrollTop': $target.offset().top - nav_offset
    }, 900, 'swing', function () {

    });
}



function setCarousel(size)
{
    $('.carousel_img').each(function ()
    {
        var src = $(this).attr('src');
        var current_path = src.substring(0, src.lastIndexOf("/") + 1);
        console.log(current_path);
        console.log(size);
        if (size < 769 && current_path != 'images/small_carousel/')
        {
            current_path = 'images/small_carousel/';
        }

        if (size >= 769 && current_path == 'images/small_carousel/')
        {
            current_path = 'images/';
        }
        var image_name = src.substring(src.lastIndexOf("/") + 1);
        var new_src = current_path + image_name;
        $(this).attr('src', new_src);

    });

    if (size < 769)
    {
        $('#kids_link').addClass('dropdown-toggle');
        $('#kids_link').attr('data-toggle', 'dropdown');
    } else
    {
        $('#kids_link').removeClass('dropdown-toggle');
        $('#kids_link').attr('data-toggle', '');
    }
}


