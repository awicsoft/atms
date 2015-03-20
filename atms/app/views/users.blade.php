@extends('template.default')



@section('content')
	<ul>
			@foreach($users as $user)
			
				<li>{{ link_to("users/$user->username",$user->ID) }}</li>
			
			@endforeach
	</ul>
@stop


