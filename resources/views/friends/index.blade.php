@extends('layouts.default')

@section('content')

	<div class="row">
		<div class="col-md-3">

			@include('users.partials.profile-section')
			
		</div>

		<div id="center-column" class="col-md-6">
			@if(count($friends))
				<div class="users-list">

					@foreach($friends as $friend)
						<div class="media listed-object-close">
							<div class="pull-left">		
								<a href="{!! url('/users/'.$friend['id']) !!}"><img class="media-object avatar medium-avatar" src="{!! $friend['profileimage'] !!}" alt="{!! $friend['firstname'] !!}"></a>		
							</div>
							<div class="media-body">
								<h4 class="media-heading">{!! $friend['firstname'] !!}</h4>								
								<div class="pull-right">																							
									<a href="#" data-method="delete" data-userid="{!! $friend['id'] !!}" class="btn btn-primary unfriend-button-3 btn-sm" role="button">Unfriend</a>															
								</div>		
							</div>
						</div>
					@endforeach
				</div>
			@else

				<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span> You don't have any friends.</div>

			@endif
		
				

		</div>

		<div id="right-side-column" class="col-md-3">
			@include('friends.partials.friend-chat-list')
		</div>
	</div>
	

@stop