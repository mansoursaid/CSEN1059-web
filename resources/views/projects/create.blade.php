<form  action="/projects/store" method="post" >
    <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
    Name:<br>
    <input type="text" name ="name"><br>
    Description:<br>
    <input type="text" name = "description"><br><br>
    Created by:<br>
    <input type="text" name = "created_by"><br><br>
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