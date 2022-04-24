$('.list-shop .nav_cont ul a').click(function () {
    $('.list-shop .nav_cont ul li').each(function () {
       $(this).removeClass('active');
    });
    $('.list-shop .tab_contact .tab').each(function () {
       $(this).removeClass('active');
    });
    $(this).parent().addClass('active');
    var id = $(this).attr('href');
    $(id).addClass('active');
    return false;
});
$('.list_flower .tab_block_nav a').click(function () {
    $name_ss = $(this).find('.tn').html();

    $('.list_flower .title .sam b').html($name_ss);

    if ($(document).width() <= 969 ) {
        $(this).parent().hide();
        var id = $(this).attr('href');
        $(id).show();
        return false;
    } else {
        $(this).parent().fadeOut();
        var id = $(this).attr('href');
        $(id).delay('400').fadeIn();
        return false;
    }


});


$('.list_item .control_panel .back').click(function () {

    $('.list_flower .title .sam b').html('Коллекция');

    $('.list_flower .list_item .tab').each(function () {
       $(this).hide();
    });

    $('.tab_block_nav').css('position','relative');

    if ($(document).width() <= 969 ) {
        $('.tab_block_nav').show();
    } else {
        $('.tab_block_nav').fadeIn();
    }



    var id  = '#block-comp',
        top = $(id).offset().top;
    $('body,html').animate({scrollTop: top - 100}, 1500);


    return false;
});




$('.block_gl .inner').slick({
    rows:2,
    variableWidth: true,
    infinite: true,
    dots: false,

    slidesPerRow: 1,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow:'#stat-left',
    nextArrow:  '#stat-right',
    //  mobileFirst: true,
    responsive: [
        {
            breakpoint: 970,
            settings: {
                slidesPerRow: 1 ,
                rows: 1,
                slidesToScroll: 1,
                slidesToShow: 3,

                dots: false
            }
        },
        {
            breakpoint: 720,
            settings: {
                slidesPerRow: 1,
                rows: 1,
                slidesToScroll: 1,
                slidesToShow: 1,

                dots: false
            }
        }
    ]
});



$("header ul").on("click","a", function (event) {
    event.preventDefault();
    var id  = $(this).attr('href'),
        top = $(id).offset().top;
    $('body,html').animate({scrollTop: top - 100}, 1500);
});
$('.scroll_link').click(function () {

    event.preventDefault();
    var id  = $(this).attr('href'),
        top = $(id).offset().top;
    $('body,html').animate({scrollTop: top - 100}, 1500);
});

$('[data-fancybox="images"]').fancybox({
    arrows  : false,
    toolbar  : false,
    smallBtn : true,

        afterShow: function () {

            $('.fancybox-button--arrow_left').appendTo('.fancybox-slide--current > div');
            $('.fancybox-button--arrow_right').appendTo('.fancybox-slide--current > div');
            $('<a href="" class="close-popupa des1"></a>').appendTo('.fancybox-slide--current > div');
        },

    clickContent    : false
});

$(document).on("click",".close-button", function(){
    $.fancybox.close();
    return false;
});
$( ".close-popup, .close_fsk" ).on( "click", function() {
    $.fancybox.close();
    return false;
});


$('.th_img').click(function () {

    $(this).parent().find('.th_img').each(function () {
       $(this).removeClass('active');
    });

    $(this).addClass('active');

    $url = $(this).find('.in').data('scp');
    $(this).parent().parent().find('.big_img').find('.in').css('background', 'url('+ $url +') center no-repeat');
    $(this).parent().parent().find('.big_img').find('.in').css('background-size','cover');

    return false;
});


$('.dop_comp').click(function () {
    $start_pos = 1;
    $(this).parent().parent().find('.item').each(function () {
       if ($(this).hasClass('dis')) {
           if (!$(this).hasClass('acts')) {
               if ($start_pos <= '4') {
                   $(this).fadeIn();
                   $(this).addClass('acts');
                   $start_pos++;
               }
           }
       }
    });
    $coll_all = $(this).parent().parent().find('.item.dis').length;
    $coll_open = $(this).parent().parent().find('.item.acts').length;
    if ($coll_all == $coll_open) {
        $(this).fadeOut();
    }
    return false;
});


$(".name" ).click(function() {
    $(this).removeClass("has-error");
});
$(".phone" ).click(function() {
    $(this).removeClass("has-error");
});
$(".mail" ).click(function() {
    $(this).removeClass("has-error");
});


$('input.phone').inputmask("+7(999)999-99-99");


$("form.sender").submit(function(){
    var form = $(this);
    var error = false;

    form.find('.phone').each( function(){
        if ($(this).val() == '') {
            $(this).addClass("has-error");
            error = true; // ошибка
        }
    });

    form.find('.name').each( function(){
        if ($(this).val() == '') {
            $(this).addClass("has-error");
            error = true; // ошибка
        }
    });

    if (!error) {
        var data = form.serialize();
        $.ajax({
            type: 'POST',
            url: './zayavka_mail.php',
            dataType: 'json',
            data: data,
            beforeSend: function(data) {
                form.find('input[type="submit"]').attr('disabled', 'disabled');
            },
            success: function(data){
                $.fancybox.close();
                $('#thanks_link').click();
                form[0].reset();
            },
            complete: function(data) {
                form.find('input[type="submit"]').prop('disabled', false);
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
        });
    }
    return false;
});
