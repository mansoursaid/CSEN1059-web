<form  action="/tickets/store" method="post" >
    <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
    Tweet Id:<br>
    <input type="text" name ="tweet_id"><br>
    Urgency:<br>
    <input type="text" name = "urgency"><br><br>
    Premium:<br>
    <input type="text" name = "premium"><br><br>
    Opened by:<br>
    <input type="text" name = "opened_by"><br><br>
    Assigned to:<br>
    <input type="text" name = "assigned_to"><br><br>
    Customer id:<br>
    <input type="text" name = "customer_id"><br><br>
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
