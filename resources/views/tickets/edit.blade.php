<form  action="/tickets/{{$ticket->id}}/edited" method="post" >
    <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
    <br>Tweet id {{ $ticket->tweet_id }}<br>
    Status:<br>
    <input type="text" name = "status"><br><br>
    <input type="submit" value="Submit">
</form>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
