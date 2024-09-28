@component('mail::message')
Dear {{$data['name']}},
<br>
Congratulations !!<br>
{{$data['message']}}<br>

##Credentials <br>
Email : {{$data['email']}}<br>
Password : {{$data['password']}}<br>
@component('mail::button', ['url' => $data['loginUri']])
    Login
@endcomponent
Thanks,<br>
Support Team,<br>
{{ config('app.name') }}
@endcomponent
