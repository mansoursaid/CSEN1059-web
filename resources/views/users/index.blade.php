<h1>List of users</h1>
	<h2>User Name , User type</h2>
	@foreach( $users as $user )
		<p>{{$user->name}}, {{user->type}}</p>
	@endforeach
