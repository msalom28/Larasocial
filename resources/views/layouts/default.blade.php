<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Larasocial</title>
	<meta name="viewport" content="width=device-width">
	<link rel="shortcut icon" href="{{ asset('larasocialfavicon.ico') }}">
	<link rel="stylesheet" href="{{ asset('css/libs.css') }}">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body data-spy="scroll" data-offset="0">
	<div id="go-up"><a href="#main-feed"><span class="glyphicon glyphicon-eject"></span></a></div>
	@include('layouts.partials.nav')
	<div class="container">
	@include('layouts.partials.center-alert')
		@yield('content')	
	</div>	
	@include('users.partials.userid')
	<div class="container" id="chat-container"></div>
	<footer class="footer">			
      <div class="container"> 
        <p class="text-muted"><small>&copy; Larasocial.info 2015</small></p>               
      </div>
    </footer>
    <script src="{{ asset('js/libs.js') }}"></script>
    <script src="http://larasocial.info/socket.io/socket.io.js"></script>
	<script src="{{ asset('js/main.js') }}"></script>
</body>
</htm>