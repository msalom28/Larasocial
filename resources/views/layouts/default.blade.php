<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Larasocial</title>
	<link rel="stylesheet" href="{{ asset('css/libs.css') }}">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body data-spy="scroll" data-offset="0">
	<div id="go-up"><a href="#main-feed"><span class="glyphicon glyphicon-eject"></span></a></div>
	@include('layouts.partials.nav')
	<div class="container">
		@yield('content')	
	</div>
	

	@if(Auth::check())
		<script> 
			var userId = <?php echo Auth::user()->id; ?>;
			var chatStatus = <?php echo Auth::user()->chatstatus; ?>;
			var userFirstname = <?php echo json_encode(Auth::user()->firstname); ?>;
			var userProfileImage = <?php echo json_encode(Auth::user()->profileimage); ?>;
			console.log(chatStatus);
			console.log(userId);
			console.log(userFirstname);
		</script>
	@endif
	
	<div class="container" id="chat-container"></div>
	<footer class="footer">			
      <div class="container"> 
        <p class="text-muted"><small>&copy; Larasocial.com 2015</small></p>               
      </div>
    </footer>
    <script src="{{ asset('js/libs.js') }}"></script>
    <script src="http://localhost:1337/socket.io/socket.io.js"></script>
	<script src="{{ asset('js/main.js') }}"></script>
</body>
</htm