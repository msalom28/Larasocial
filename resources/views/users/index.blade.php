@extends('layouts.default')

@section('content')

	<div class="row">
		<div class="col-md-3">

			@include('users.partials.profile-section')
			
		</div>

		<div id="center-column" class="col-md-6">
			@if($users->count())
				<div class="users-list">

					@foreach($users as $user)

						<div class="media listed-object-close">
							<div class="pull-left">		
								<a href="{!! url('/users/'.$user->id) !!}"><img class="media-object avatar medium-avatar" src="{!! $user->profileimage !!}" alt="{!! $user->firstname !!}"></a>		
							</div>
							<div class="media-body">
								<h4 class="media-heading">{!! $user->firstname !!}</h4>							
								<div class="pull-right">

									@if(Auth::user()->isFriendsWith($user->id))
											<a href="{!! url('friends') !!}" data-method="delete" data-userid="{!! $user->id!!}" class="btn btn-primary unfriend-button btn-sm" role="button">Unfriend</a>
												
									@else

											@if( Auth::user()->sentFriendRequestTo($user->id))

												<button class="btn btn-primary btn-sm" disabled="disabled" type="submit">Requested</button>								

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

		<div id="right-side-column" class="col-md-3">
			@include('friends.partials.friend-chat-list')
		</div>
	</div>	

@stop