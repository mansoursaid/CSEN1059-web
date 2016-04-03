<form  action="/projects/{{$project->id}}/edited" method="post" >
    <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
    <br>Old project name: {{ $project->name}}<br>
    New name!:<br>
    <input type="text" name = "name"><br><br>
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