@component('mail::message')
    {{ $subject }}

    Имя: {{ $name }}
    Телефон: {{ $phone }}

    @foreach( $setting as $key => $value )
        {{ $key }} : {{ $value }}
    @endforeach

    Комментарий: {{ $comment }}

    @component('mail::button', ['url' => config('app.url')])
        На сайт
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
