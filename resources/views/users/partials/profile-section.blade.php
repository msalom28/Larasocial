@if(Auth::check())

	<div id="profile-card" class="media">

		@if($user->is(Auth::user()->id))	

			<img class="avatar large-avatar pull-left" src="{!! Auth::user()->profileimage !!}" alt="{!! Auth::user()->firstname !!}">			

			<div class="media-body">
				<h4 class="media-heading">{!! Auth::user()->firstname !!}</h4>
									
			</div>

		@else

			<img class="avatar large-avatar pull-left" src="{!! $user->profileimage !!}" alt="{!! $user->firstname !!}">			

			<div class="media-body">
				<h4 class="media-heading">{!! $user->firstname !!}</h4>
				
				@if(Auth::user()->isFriendsWith($user->id))

					@include('messages.partials.send-email-button')

					<a href="{!! url('friends') !!}" data-method="delete" data-userid="{!! $user->id!!}" class="btn btn-primary unfriend-button btn-sm" role="button">Unfriend</a>
						
				@else

					@if( Auth::user()->sentFriendRequestTo($user->id))

						@include('messages.partials.send-email-button')

						<button class="btn btn-primary btn-sm" disabled="disabled" type="submit">Requested</button>										

					@elseif(Auth::user()->receivedFriendRequestFrom($user->id))

						@include('messages.partials.send-email-button')

						<a href="{!! url('friends') !!}" data-method="post" data-userid="{!! $user->id!!}" class="btn btn-primary add-friend-button btn-sm" role="button">Add friend</a>				

					@else

						@include('messages.partials.send-email-button')

						<a href="{!! url('friend-requests') !!}" data-method="post" data-userid="{!! $user->id!!}" class="btn btn-primary friend-request-button btn-sm" role="button">Add friend</a>					

					@endif

				@endif

			</div>

		@endif		
		<ul class="list-inline text-muted">
			<li><span class="friends-count">{!! $friendsCount = $user->friends()->count() !!}</span> {!! str_plural('friend', $friendsCount) !!}</li>
			<li><span class="feeds-count">{!! $friendsCount = $user->feeds()->count() !!}</span> {!! str_plural('feed', $friendsCount) !!}</li>
		</ul>
	</div>

	@if($user->is(Auth::user()->id))

		<div class="list-group">
			<a href="{!! url('users') !!}" class="list-group-item" role="button">Users</a>
			<a href="{!! url('friends') !!}" class="list-group-item" role="button">Friends</a>
			<a href="{!! url('friend-requests') !!}" class="list-group-item" role="button">Friend requests</a>
			<a href="{!! url('messages') !!}" class="list-group-item" role="button">Messages</a>
		</div>

	@endif

@else

	<div id="profile-card" class="media">			

		<img class="avatar large-avatar" src="{!! $user->profileimage !!}" alt="{!! $user->firstname !!}">		
		
		<div class="media-body">
			<h4 class="media-heading">{!! $user->firstname !!}</h4>
		</div>					
	</div>

@endif