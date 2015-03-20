<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
	<h2> Dear {{$user->username}}</h2>
		<h2>Password Reset</h2>

		<div>
			Here is Your New Password : {{$npassword}}<br/>
			To Active this Password Please Follow the Link  {{URL::to('/')}}/recoverPasswordToken/{{$user->code}}.<br/>
		</div>
	</body>
</html>
