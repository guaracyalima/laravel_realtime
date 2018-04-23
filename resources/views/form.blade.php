<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Laravel</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

	<!-- Styles -->
	<style>
	html, body {
		background-color: #fff;
		color: #636b6f;
		font-family: 'Raleway', sans-serif;
		font-weight: 100;
		height: 100vh;
		margin: 0;
	}

	.full-height {
		height: 100vh;
	}

	.flex-center {
		align-items: center;
		display: flex;
		justify-content: center;
	}

	.position-ref {
		position: relative;
	}

	.top-right {
		position: absolute;
		right: 10px;
		top: 18px;
	}

	.content {
		text-align: center;
	}

	.title {
		font-size: 84px;
	}

	.links > a {
		color: #636b6f;
		padding: 0 25px;
		font-size: 12px;
		font-weight: 600;
		letter-spacing: .1rem;
		text-decoration: none;
		text-transform: uppercase;
	}

	.m-b-md {
		margin-bottom: 30px;
	}

	#users {
		float: left;
		width: 150px;
		margin-left:  20px;
		border: 1px solid red;
	}

	#messages {
		float: left;
		width: 150px;
		height: 700px;
		margin-left:  20px;
		border: 1px solid red;
	}

	#form {
		float: left;
		width: 850px;
	}
</style>
</head>
<body>
	<div class="full-height">
		@if (Route::has('login'))
		<div class="top-right links">
			@auth
			<a href="{{ url('/home') }}">Home</a>
			@else
			<a href="{{ route('login') }}">Login</a>
			<a href="{{ route('register') }}">Register</a>
			@endauth
		</div>
		@endif

		<div class="content">
			<ul id="users">
				<li>Users</li>
			</ul>

			<ul id="messages">
				<li>Messages</li>
			</ul>

			<div id="form">
				<form action="{{ action('MessageController@store') }}" method="POST">
					<textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
					<button type="button" id="send">Enviar</button>
				</form>
			</div>
			
		</div>
	</div>
	<script src="http://localhost:6001/socket.io/socket.io.js"></script>
	<script src="{{ asset('js/app.js')}}"></script>

	<script >
		$(document).ready(function() {
			$('#send').on('click', function(){
				let message = $('#message').val();

				$.ajax({
					method: 'post',
					url: '{{ url('/send_message') }}',
					data: {
						message: message,
					},
					success: function(data){
						console.log('a data da msg enviada', data)
					}, 
					error: function(error){
						console.log('error ', error)
					},
					beforeSend: function(){
						 $('#message').val('Carregando..');
					}
				})
			})
		})
	</script>
</body>
</html>
