<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Букеты из клубники в шоколаде - myblooms.ru</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" href="{{ asset('/main/css/style.css') }}"/>
    <meta name="description" content="Букеты из клубники в шоколаде с бесплатной доставкой по Москве!"/>
    <meta property="og:type" content="{{ config('app.name') }}"/>
    <meta property="og:title" content="Букеты из клубники в шоколаде"/>
    <meta property="og:url" content="{{ asset('/') }}"/>
    <meta property="og:description" content="Букеты из клубники в шоколаде с бесплатной доставкой по Москве!"/>
    <meta property="og:image" content="{{ asset('/main/img/OG-image.jpg') }}"/>
    <meta property="og:site_name" content="Интернет магазин Myblooms.ru"/>
    <link rel="shortcut icon" href="{{ asset('/main/img/favicon.png') }}" type="image/x-icon"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<section class="advantages">
    <div class="container">
        <div class="headline">
            <div class="logo-descr"><img src="{{ asset('/main') }}/img/logo.png" alt="logo"/><a
                    class="mobile-phone-icon" href="tel:+{{ phone_clear(setting('phone')) }}"><img
                        src="{{ asset('/main') }}/img/icons/phone-icon.png" alt="Позвоните нам"/></a>
                <p>В букетах используем свежую клубнику, фрукты <br>и только проверенный шоколад!</p>
            </div>
            <div class="header-contacts"><span class="link__phone"><a
                        href="tel:+{{ phone_clear(setting('phone')) }}">8{{ setting('phone') }}</a></span><span>{{ setting('working_hours') }}</span>
            </div>
        </div>
        <div class="hero-text">
            <h1>Букеты из клубники <br> <span>в шоколаде</span></h1>
            <p>с бесплатной доставкой в Москве!</p>
        </div>
        <div class="hero-advantages">
            <div class="hero-advantages__item"><img src="{{ asset('/main') }}/img/1.png" alt="#"/>
                <p>Свежайшие ягоды высшего сорта</p>
            </div>
            <div class="hero-advantages__item"><img src="{{ asset('/main') }}/img/2.png" alt="#"/>
                <p>Вкуснейший бельгийский шоколад</p>
            </div>
            <div class="hero-advantages__item"><img src="{{ asset('/main') }}/img/3.png" alt="#"/>
                <p>Вернем деньги, если букет не понравился</p>
            </div>
        </div>
        <a class="common__button hero-button" href="#choose_bouquet">Выбрать букет<span></span></a>
    </div>
</section>
<div class="hero-background__wave"></div>
<section class="bouquet-will-remembered">
    <div class="container">
        <p class="subheader">Банальный букет из цветов сейчас мало кого удивит.</p>
        <h2>Букет из ягод в шоколаде — запомнится надолго!</h2>
        <div class="composition__items">
            <div class="composition--item"><img src="{{ asset('/main') }}/img/composition--item_1.jpg" alt="#"/>
                <h4>Внешний вид</h4>
                <p>
                    Сочные спелые ягоды в шоколадной глазури, обёрнутые в плотную бумагу. Такой букет не только
                    красивый, но и вкусный, а так же он невероятно полезный!</p>
            </div>
            <div class="composition--item"><img src="{{ asset('/main') }}/img/composition--item_2.jpg" alt="#"/>
                <h4>Быстрая бесплатная доставка</h4>
                <p>
                    Доставка в день заказа. Быстрая доставка в любой уголок Москвы. Наши курьеры бережно и вовремя
                    доставят букет в удобное для Вас время.</p>
            </div>
            <div class="composition--item"><img src="{{ asset('/main') }}/img/composition--item_3.jpg" alt="#"/>
                <h4>Контролируем качество</h4>
                <p>
                    Мы закупаем свежие ягоды каждое утро, а сам букет собирается непосредственно перед отправкой
                    Вам.</p>
            </div>
        </div>
    </div>
</section>
<section class="composition">
    <div class="clouds"></div>
    <div class="composition__wrapper">
        <h2>Из чего состоит букет</h2>
        <div class="bouquet-block">
            <div class="bouquet-block--text-top">
                <p>Ягоды клубники покрыты бельгийским шоколадом</p>
                <p>Сочные спелые ягоды клубники, голубики и ежевики</p>
            </div>
            <div class="bouquet-block--text-bottom">
                <p>Плотная бумага любого цвета на Ваш вкус</p>
                <p>Лепестки свежей мяты и фисташки</p>
            </div>
        </div>
    </div>
    <div class="composition__wave"></div>
</section>
<section class="bouquet-selection" id="choose_bouquet">
    <div class="container container-special">
        <h2>Выберите букет, который Вам подходит</h2>
        <p class="subheader">Доставка по Москве в пределах МКАД Бесплатно</p>
        <div class="bouquet-sort">
            <div class="splitter__block">
                <div class="splitter">
                    @foreach( $groups as $group )
                        @if( $loop->first )
                            <button class="filter" data-filter="all">Все</button>
                        @endif
                        <button class="filter" data-filter=".group{{ $group->id }}">{{ $group->name }}</button>
                    @endforeach
                </div>
            </div>
            <div class="bouquet-sort__items">
                <ul class="items-grid" id="list">
                    @foreach( $products as $product )
                        <li class="all-bouquets group{{ $product->group?->id }}" data-myorder="{{ $loop->index }}">
                            @foreach( $product->attachment as $image)
                                @if( $loop->first )
                                    <a href="{{ $image->relative_url }}" data-fancybox="{{ $product->id }}">
                                        <img src="{{ $image->relative_url }}" alt="{{ $image->alt }}"/>
                                    </a>
                                @else
                                    <a href="{{ $image->relative_url }}"
                                       data-fancybox="{{ $product->id }}"
                                       hidden="hidden"></a>
                                @endif
                            @endforeach
                            <h4>{{ $product->name }}</h4>
                            @php
                                $prices = $product->pricesCollection();
                            @endphp
                            @if( $price = $prices->first() )
                                <span class="text">{{ $price->text }}</span>
                            @endif
                            @if( $text = $product->attributesCollection() )
                                <span>{{ $text->join(', ') }}</span>
                            @endif

                            @if( $price = $prices->first() )
                                <p class="price">{{ $price->price }}</p>
                            @endif
                            @if( $prices->count() > 1)
                                <div class="size">
                                    @foreach( $prices as $price )
                                        <span
                                            data-option=" {{ $price->name }}"
                                            data-text="{{ $price->text }}"
                                            data-price="{{ $price->price }}"
                                            class="@if( $loop->first ) active @endif"
                                        >
                                            {{ $price->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                            <a class="common__button bouquet-sort__button"
                               data-product="{{ $product->name }}">Заказать<span></span></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="bouquet-form">
    <div class="container">
        <div class="bouquet-form__block">
            <div class="bouquet-form__block--form">
                <h3>Ничего не понравилось?</h3>
                <p>
                    Если ни одна из стандартных композиций не пришлась Вам по душе, можете заказать индивидуальный
                    букет. Заполните форму ниже или просто позвоните нам:</p>
                <form class="bouquet-form__form" action="">
                    <div class="inputs__block">
                        <input type="hidden" name="subject" value="Форма с пожеланиями"/>
                        <div class="inputs">
                            <input type="text" placeholder="Ваше имя" name="name" required="required"/>
                            <input class="input-tel" type="tel" placeholder="Ваш телефон" name="phone"
                                   required="required"/>
                        </div>
                        <div class="textarea">
                            <textarea type="textarea"
                                      placeholder="Пожелания к заказу"
                                      name="comment"></textarea>
                        </div>
                    </div>
                    <div class="bouquet-form__button">
                        <button class="common__button">Перезвоните мне<span></span></button>
                        <div class="bouquet-form__contacts"><span class="link__phone"><a
                                    href="tel:+{{ phone_clear(setting('phone')) }}">8{{ setting('phone') }}</a></span><span>{{ setting('working_hours') }}</span>
                        </div>
                    </div>
                    <div class="bouquet-form__checkbox"><span>Я принимаю условия <a
                                href="{{ route('confidentiality') }}"
                                target="blank">передачи информации</a></span>
                    </div>
                </form>
            </div>
        </div>
        <img class="bouquet-form--img" src="{{ asset('/main') }}/img/bouquet-form__img.png" alt="#"/>
    </div>
</section>

{{--<section class="reviews">--}}
{{--    <div class="container">--}}
{{--        <h2>Что говорят наши клиенты</h2>--}}

{{--        <div class="slider-block">--}}
{{--            <div class="slick-slider"><img src="{{ asset('/main') }}/img/reviews/1.jpg" alt="#"/><img--}}
{{--                    src="{{ asset('/main') }}/img/reviews/1.jpg" alt="#"/><img--}}
{{--                    src="{{ asset('/main') }}/img/reviews/1.jpg" alt="#"/><img--}}
{{--                    src="{{ asset('/main') }}/img/reviews/1.jpg" alt="#"/><img--}}
{{--                    src="{{ asset('/main') }}/img/reviews/1.jpg" alt="#"/><img--}}
{{--                    src="{{ asset('/main') }}/img/reviews/1.jpg" alt="#"/></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

<section class="how-it-work">
    <div class="container">
        <h2>Заказать букет проще простого</h2>
        <div class="how-it-work__items">
            <div class="how-it-work--item"><img src="{{ asset('/main') }}/img/how-it-work--item_1.png" alt="#"/>
                <h4>Заявка или звонок</h4>
                <p>Вы оставляете заявку на сайте или звоните нам:<br> 8{{ setting('phone') }}</p><a
                    class="common__button how-it-work__popup-link" href="#">Заказать<span></span></a>
            </div>
            <div class="how-it-work--item"><img src="{{ asset('/main') }}/img/how-it-work--item_2.png" alt="#"/>
                <h4>Уточняем детали</h4>
                <p>Менеджер перезванивает и подтверждает заказ</p>
            </div>
            <div class="how-it-work--item"><img src="{{ asset('/main') }}/img/how-it-work--item_3.png" alt="#"/>
                <h4>Доставка</h4>
                <p>Курьер доставляет букет в удобное для Вас место и время</p>
            </div>
            <div class="how-it-work--item"><img src="{{ asset('/main') }}/img/how-it-work--item_4.png" alt="#"/>
                <h4>Получение</h4>
                <p>Вы получаете букет и оплачиваете удобным для вас способом</p>
            </div>
        </div>
    </div>
</section>
<div class="wavy_line"></div>
<section class="faq">
    <div class="container">
        <h2>Часто задаваемые вопросы</h2>
        <ul class="faq-questions">
            <li>
                <h5 class="faq-question">Где вы берете ягоды для букетов?</h5>
                <p class="faq-answer">Мы получаем ягоды ежедневно от поставщиков</p>
            </li>
            <li>
                <h5 class="faq-question">Как осуществляется оплата?</h5>
                <p class="faq-answer">
                    Оплата наличными курьеру, при получении заказа<br>
                    Оплата через мобильный банк (с карты на карту)
                </p>
            </li>
            <li>
                <h5 class="faq-question">Мне нужно букет очень срочно. Вы успеете?</h5>
                <p class="faq-answer">
                    Доставка осуществляется в течении 3х часов с момента подтверждения заказа в пределах МКАД<br>
                    Доставка осуществляется круглостуточно (прием заказов на ночное время с 9:00 до 20:00).
                    <br><br>
                    Доставка в пределах МКАД - Бесплатно.<br>
                    За пределами МКАД 50 ₽/км.<br>
                    В ночное время суток с (22:00 до 09:00) - стоимость доставки составляет 790 ₽ в пределах МКАД.<br>
                    <br>
                    Доставка к точному времени 490р.
                </p>
            </li>
            <li>
                <h5 class="faq-question">Хочу забрать самовывозом, где Вы находитесь?</h5>
                <p class="faq-answer">Вы можете забрать заказ в урочное время самовывозом по адресу Дмитровское шоссе
                    90к1</p>
            </li>
        </ul>
    </div>
</section>
<footer>
    <div class="container">
        <h2>Хотите заказать букет<br> или есть дополнительные вопросы?</h2>
        <p class="subheader">Доставка по Москве в пределах МКАД Бесплатно</p>
        <form class="footer__form" action="#">
            <input type="hidden" name="subject" value="Форма в футере"/>
            <div class="footer__inputs">
                <input type="text" placeholder="Ваше имя" name="name" required="required"/>
                <input class="input-tel" type="tel" placeholder="Ваш телефон" name="phone" required="required"/>
            </div>
            <button class="common__button footer__button">Перезвоните мне<span></span></button>
            <div class="footer__form__checkbox"><span>Я принимаю условия <a href="{{ route('confidentiality') }}"
                                                                            target="blank">передачи информации</a></span>
            </div>
        </form>
    </div>
</footer>
<hr class="foo-line"/>
<div class="container">
    <div class="bottom__line">
        <div class="bottom__logo-descr"><img src="{{ asset('/main') }}/img/logo.png" alt="logo"/>
            <div class="bottom__logo-descr--text">
                {!! setting('company_info') !!}
                <a class="confidentiality--link"
                   href="{{ route('confidentiality') }}"
                   target="blank">
                    Политика конфиденциальности
                </a>
            </div>
        </div>


        @if( setting('instagram') )
            <a href="{{ setting('instagram') }}">
                <p style="display: block; margin: 0 auto;">
                    <img src="{{ asset('/main') }}/img/Instagram.png" alt="Instagram">
                </p>
            </a>
        @endif

    </div>


    <div class="bottom__line__contacts"><span class="link__phone"><a
                href="tel:+74951339232">8{{ setting('phone') }}</a></span><span>{{ setting('working_hours') }}</span>
    </div>
</div>
</div>
<div class="modal__bouquet">
    <h6>Заявка на доставку букета</h6>
    <p class="modal__subheader">Заполните форму и мы перезвоним, чтобы уточнить детали заказа</p>
    <p class="modal-text">Вы можете оплатить букет двумя способами: при получении курьеру или заранее. Сообщите
        менеджеру как вы хотите заказать.</p>
    <form class="modal__form">
        <input type="hidden" name="subject" value="Форма в модальном окне"/>
        <input type="text" placeholder="Ваше имя" name="name" required="required"/>
        <input type="hidden" name="setting" value="">
        <input class="input-tel" type="tel" placeholder="Ваш телефон" name="phone" required="required"/>
        <button class="modal__button common__button">Заказать букет</button>
    </form>
    <span class="modal__bouquet--close"><img src="{{ asset('/main') }}/img/icons/close.png" alt="close"/></span>
</div>
<div class="overlay"></div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/smoothscroll/1.4.10/SmoothScroll.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="{{ asset('/main/js/jquery.mixitup.js') }}"></script>
<script type="text/javascript" src="{{ asset('/main/js/scripts.js') }}"></script>
{!! setting('code') !!}
</body>
</html>
