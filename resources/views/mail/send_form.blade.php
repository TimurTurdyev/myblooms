@component('mail::message')
    {{ $subject }}

    Имя: {{ $name }}
    Телефон: {{ $phone }}

    @foreach( $setting as $key => $value )
        {{ $key }} : {{ $value }}
    @endforeach

    Комментарий: {{ $comment }}
@endcomponent
