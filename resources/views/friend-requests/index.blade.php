@extends('layouts.default')

@section('content')

	<div class="row">
		<div class="col-md-3">

			@include('users.partials.profile-section')
			
		</div>

		<div id="center-column" class="col-md-6">

			@if($usersWhoRequested->count())
				
				<div class="users-list">

					@foreach($usersWhoRequested as $user)

				
						<div class="media listed-object-close">
							<div class="pull-left">		
								<a href="{!! url('/users/'.$user->id) !!}"><img class="media-object avatar medium-avatar" src="{!! $user->profileimage !!}" alt="{!! $user->firstname !!}"></a>		
							</div>
							<div class="media-body">
								<h4 class="media-heading">{!! $user->firstname !!}</h4>							
								<div class="pull-right">																							
									<a href="{!! url('friends') !!}" data-method="post" data-userid="{!! $user->id!!}" class="btn btn-primary add-friend-button-2 btn-sm" role="button">Accept</a>

									<a href="{!! url('friend-requests') !!}" data-method="delete" data-userid="{!! $user->id!!}" class="btn btn-primary unfriend-button-2 btn-sm" role="button">Decline</a>																
								</div>		
							</div>
						</div>
						
					@endforeach
				</div>
					<div class="paginator text-center">
						 	{!! $usersWhoRequested->render() !!}
					</div>
			@else

				<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span> You don't have any friend requests.</div>

			@endif
		
				

		</div>

		<div id="right-side-column" class="col-md-3">
			@include('friends.partials.friend-chat-list')
		</div>
	</div>
	

@stop