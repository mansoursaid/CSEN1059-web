<h5>
Dear {{ $name }},
<br>
<br>
You have been added to the system as a support {{ App\User::IntTypeToStr($type) }}.
<br>
Your credentials are to log in are:
<br>
email : {{$email}}
<br>
Password : {{$password}}
<br>
<br>
<br>
make sure to change your password!
<br>
Thank you!
</h5>
