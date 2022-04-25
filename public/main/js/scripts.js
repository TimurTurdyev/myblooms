$(document).ready(function () {
    $('.slick-slider').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        adaptiveHeight: true,
        slidesToScroll: 2,
        responsive: [
            {
                breakpoint: 980,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    adaptiveHeight: false,
                    variableWidth: true
                }
            }
        ]
    });


    var $speed = 200;
    var $class = 'opened';
    var $class_open = '.faq-answer';

    $('.faq-question').on('click', function () {
        $ul = $(this).closest('ul');
        $answer = $(this).closest('li').find($class_open);

        if (!$(this).closest('li').hasClass($class)) {

            $ul.find('li').each(function () {
                if ($(this).hasClass($class))
                    $(this).removeClass($class).find($class_open).slideUp($speed);
            });
        }

        $answer
            .slideToggle($speed)
            .closest('li')
            .toggleClass($class);
    });

    $("#list").mixItUp({

        selectors: {
            target: '.all-bouquets',
            filter: '.filter',
            sort: '.sort'
        },
        load: {
            filter: 'all',
            sort: 'myorder:asc'
        },

        controls: {
            enable: true,
            //activeClass:'on'
        },

        animation: {
            enable: true,
            effects: 'scale fade',
            duration: 200
        },

        layout: {
            display: 'block'
        }
    });

    $("body").on('click', '[href*="#"]', function (e) {
        var fixed_offset = 5;
        $('html,body').stop().animate({scrollTop: $(this.hash).offset().top - fixed_offset}, 1000);
        e.preventDefault();
    });

    $(".input-tel").mask("+7 (999) 99-99-999");


    $('a.bouquet-sort__button, a.how-it-work__popup-link').click(function (event) {
        event.preventDefault();
        var data = $(this).closest('li').find('.size > .active').data();
        var product = $(this).data('product');

        if (product) {
            data.product = product;
        }

        $('.modal__bouquet').find('input[name=setting]').val(data ? JSON.stringify(data) : '');

        $('.overlay').fadeIn(297, function () {
            $('.modal__bouquet')
                .css('display', 'block')
                .animate({opacity: 1}, 198);
        });
    });

    $('.modal__bouquet--close, .overlay').click(function () {
        $('.modal__bouquet').find('input[name=setting]').val('');
        $('.modal__bouquet').animate({opacity: 0}, 198, function () {
            $(this).css('display', 'none');
            $('.overlay').fadeOut(297);
        });
    });


    $("[data-fancybox]").fancybox({
        scrolling: 'true',
        slideShow: true,
        fullScreen: true,
        thumbs: true,
        closeBtn: true,
        arrows: true,
        infobar: true,
        slideShow: {
            autoStart: true,
            speed: 3500
        },
        thumbs: {
            autoStart: true
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //E-mail Ajax Send
    $("form").submit(function () { //Change
        var th = $(this);

        $.ajax({
            type: "POST",
            url: "send-form", //Change
            data: th.serialize()
        }).done(function (response) {
            $(location).attr('href', response.location)
        });

        return false;
    });

    $('.size').on('click', 'span', function (event) {
        var self = this;
        var data = $(this).data();
        $(this).addClass('active');

        for(var key in data) {
            $(this).parent().parent().find('.' + key).text(data[key]);
        }

        $.each($(this).parent().children(), function () {
            if (this !== self) {
                $(this).removeClass('active');
            }
        });
    });

});
