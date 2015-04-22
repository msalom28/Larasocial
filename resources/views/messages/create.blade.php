@extends('layouts.default')

@section('content')

	<div class="row">
		<div class="col-md-3">
			@include('users.partials.profile-section')
		</div>
			<div id="center-column" class="col-md-6">
				<h4>Send private message:</h4>
				@include('layouts.partials.center-form', [
				'placeholder' => 'Type your message..', 
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

		<div class="col-md-3">
			This is the Chat with friends section
		</div>
	</div>	

@stop