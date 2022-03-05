@component('mail::message')
# Job Application
From: *{{$email}}*
Subject: *Application for the post of an {{$job}}*
Dear Sir/Madam
This email is in reference to your advertisment on FUNA AKATALE APP.<br>
{{$message}}.

I thank you for your time and condideration. i look forward for an opportunity to to sit for an interview with you.I can be contacted at {{$phone}}

<!-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent -->

Thank you!,<br>
sincerely,<br>
{{ $name }} {{ $name_last }}
@endcomponent
