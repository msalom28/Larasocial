@extends('layouts.default')

@section('content')

	<div class="row">
		<div class="col-md-3">

			@include('users.partials.profile-section')
			
		</div>

		<div id="center-column" class="row col-md-6">
			<h4>Friend requests:</h4>
			@if($usersWhoRequested)
				{{-- <div class="friend-request-list"> --}}
				<div class="users-list">

					@foreach($usersWhoRequested as $user)

						{{-- <div class="media friend-request-media"> --}}
						<div class="media listed-object-close">
							<div class="pull-left">		
								<a href="#"><img class="media-object avatar medium-avatar" src="{!! $user->profileimage !!}" alt="{!! $user->firstname !!}"></a>		
							</div>
							<div class="media-body">
								<a href="#"><h4 class="media-heading">{!! $user->firstname !!}</h4></a>								
								<div class="pull-right">																							
									<a href="{!! url('friends') !!}" data-method="post" data-userid="{!! $user->id!!}" class="btn btn-primary add-friend-button-2 btn-sm" role="button">Accept</a>

									<a href="{!! url('friend-requests') !!}" data-method="delete" data-userid="{!! $user->id!!}" class="btn btn-primary unfriend-button-2 btn-sm" role="button">Decline</a>																
								</div>		
							</div>
						</div>
					@endforeach
				</div>
					<div class="paginator text-center">
						 	
					</div>
			@else

				<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span> You don't have any friend requests.</div>

			@endif
		
				

		</div>

		<div class="col-md-3">
			chat with friends panel
		</div>
	</div>
	

@stop