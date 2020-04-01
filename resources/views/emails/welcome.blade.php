@component('mail::message')
# Introduction

The body of your message.
Hello, @if($user->name){{$user->name}}@endif
@component('mail::button', ['url' => 'google.com',  'color' => 'green'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
