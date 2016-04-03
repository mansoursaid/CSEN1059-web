<h1>Create a new user:</h1>

{!! Form::open(['url' => 'users']) !!}
	{!! Form::label('name', 'Name: ') !!}
	{!! Form::text('name') !!}
	<br>
	{!! Form::label('type', 'Type: ') !!}
	{!! Form::text('type') !!}
	<br>
	{!! Form::label('email', 'Email: ') !!}
	{!! Form::text('email') !!}
	<br>
	{!! Form::label('password', 'password: ') !!}
	{!! Form::password('password') !!}
	<br>
	<br>
	{!! Form::submit('Create User') !!}
{!! Form::close() !!}
