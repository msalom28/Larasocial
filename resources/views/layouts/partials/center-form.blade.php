<div class="row center-form">
	{!! Form::open(['route' => $path, 'class' => $formType]) !!}
		<div class="form-group">
			{!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => $placeholder]) !!}
		</div>
			@if($sendingMessage)

				<div class="form-group">
					{!! Form::hidden('receiverId', $userId, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::hidden('senderId', $currentUserId, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::hidden('senderProfileImage', $currentUserProfileimage, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::hidden('senderName', $currentUserFirstname, ['class' => 'form-control']) !!}
				</div>

			@endif

		<div class="form-group center-form-submit">
			{!! Form::submit($button, ['class' => 'btn btn-primary btn-xs']) !!}
		</div>	
	{!! Form::close() !!}
</div>