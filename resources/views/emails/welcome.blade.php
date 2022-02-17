@component('mail::message')
# Welcome to Funa Akatale!

Hi *{{$name}}**,

Thanks you for taking time to signing up on Funa Akatale. Your email is *{{$email}}**.
You can now access your account to view or edit your account,orders, change your password, and more.

@component('mail::button', ['url' => 'http://www.funa-akatale.com'])
visit us
@endcomponent

Thank You,<br>
We look forward to sending you soon.<br>
{{ config('app.name') }}
@endcomponent
