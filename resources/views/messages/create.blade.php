@extends('layouts.default')

@section('content')

	<div class="row">
		<div class="col-md-3">
			@include('users.partials.profile-section')
		</div>
			<div id="center-column" class="col-md-6">
				@include('layouts.partials.center-form', [
				'placeholder' => 'Send a private message to ' .$user->firstname.'...', 
				'formType' => 'message-form', 
				'button' => 'Submit', 
				'path' => 'save_message_path',
				'sendingMessage' => true,
				'userId' => $user->id,
				'currentUserId' => $currentUser->id,
				'currentUserProfileimage' => $currentUser->profileimage,
				'currentUserFirstname' => $currentUser->firstname

				])

			</div>

		<div id="right-side-column" class="col-md-3">
			@include('friends.partials.friend-chat-list')
		</div>
	</div>	

@stop