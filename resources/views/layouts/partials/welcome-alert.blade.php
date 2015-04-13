@if(Session::has('welcome-message'))
	<div class="alert alert-success flash-alert welcome-alert">
		{!! Session::get('welcome-message') !!}
	</div>
@endif