@extends('layouts.default')

@section('content')

	<div class="row">
		<div class="col-md-3">

			@include('users.partials.profile-section')
			
		</div>

		<div id="center-column" class="row col-md-6">
			<h4>Active users: </h4>
			@if($users->count())
				{{-- <div class="friend-request-list"> --}}
				<div class="users-list">

					@foreach($users as $user)

						{{-- <div class="media friend-request-media"> --}}
						<div class="row media listed-object-close">
							<div class="pull-left">		
								<a href="#"><img class="media-object avatar medium-avatar" src="{!! $user->profileimage !!}" alt="{!! $user->firstname !!}"></a>		
							</div>
							<div class="media-body">
								<a href="#"><h4 class="media-heading">{!! $user->firstname !!}</h4></a>								
								<div class="pull-right">

									@if(Auth::user()->isFriendsWith($user->id))
											<a href="{!! url('friends') !!}" data-method="delete" data-userid="{!! $user->id!!}" class="btn btn-primary unfriend-button btn-sm" role="button">Unfriend</a>
												
									@else

											@if( Auth::user()->sentFriendRequestTo($user->id))

												<button class="btn btn-primary btn-sm" disabled="disabled" type="submit">Request sent</button>								

											@elseif(Auth::user()->receivedFriendRequestFrom($user->id))

												<a href="{!! url('friends') !!}" data-method="post" data-userid="{!! $user->id!!}" class="btn btn-primary add-friend-button btn-sm" role="button">Add friend</a>				

											@else												
												<a href="{!! url('friend-requests') !!}" data-method="post" data-userid="{!! $user->id!!}" class="btn btn-primary friend-request-button btn-sm" role="button">Add friend</a>					

											@endif

									@endif
																									
								</div>		
							</div>
						</div>
					@endforeach
				</div>
					<div class="paginator text-center">
						 {!! $users->render() !!}	
					</div>
			@else

				<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span> No users were found.</div>

			@endif
		
				

		</div>

		<div class="col-md-3">
			chat with friends panel
		</div>
	</div>
	

@stop