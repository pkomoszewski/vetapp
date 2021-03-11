@component('mail::message')
Witam, {{$user->email}}

 informujemy, że sposób uwierzytelniania w aplikacji został zmieniony.
 Usługa 2FA została  {{$status}}


@component('mail::button', ['url' => 'http://127.0.0.1:8000/'])
Życzymy miłego korzystania z serwisu
@endcomponent
@component('mail::promotion')
Jeżeli nie ty zmieniłeś ustawienia proszę się z kontakować z pomocą techniczą.
@endcomponent
Z poważaniem,<br>
{{ config('app.name') }}
@endcomponent

