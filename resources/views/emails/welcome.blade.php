@component('mail::message')
Hello **{{$name}}**,
# Welcome to Funa Akatale!

Thank you for taking time to signing up with us.

@component('mail::button', ['url' => 'http://www.funa-akatale.com'])
visit us
@endcomponent

Thank You,<br>
{{ config('app.name') }}
@endcomponent
