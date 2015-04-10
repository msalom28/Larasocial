<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Larasocial</title>
	<link rel="stylesheet" href="{{ asset('css/libs.css') }}">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

	@include('layouts.partials.nav')
	<div class="container">
	@yield('content')	
	</div>

	
	<div class="container" id="chat-container"></div>
	<footer class="footer">			
      <div class="container"> 
        <p class="text-muted"><small>&copy; Larasocial.com 2015</small></p>               
      </div>
    </footer>
    <script src="{{ asset('js/libs.js') }}"></script>
	<script src="{{ asset('js/main.js') }}"></script>
</body>
</htm