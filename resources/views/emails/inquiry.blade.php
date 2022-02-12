@component('mail::message')
# PRODUCT INQUIRY
From: *{{$from}}**
Date: *{{$date}}**

Subject: *{{$subject})*

Dear Sir/Madam 

{{$message}}.

<!-- @component('mail::button', ['url' => '']) -->
<!-- Button Text
@endcomponent -->

Yours sincerely,<br>
{{ config('app.name') }}
@endcomponent
