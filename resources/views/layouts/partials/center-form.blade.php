<div class="center-form">
	{!! Form::open(['route' => $path, 'class' => $formType]) !!}
		<div class="form-group">
			{!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => $placeholder]) !!}
		</div>
			@if(isset($sendingMessage))

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

			@elseif(isset($sendingResponseMessage))

				<div class="form-group">
					{!! Form::hidden('responseId', $messageResponseId, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::hidden('messageId', $messageId, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::hidden('receiverId', $receiverId, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::hidden('senderId', $senderId, ['class' => 'form-control']) !!}
				</div>
			
				<div class="form-group">
					{!! Form::hidden('senderProfileImage', $senderProfileImage, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::hidden('senderName', $senderName, ['class' => 'form-control']) !!}
				</div>	


			@endif

		<div class="form-group center-form-submit">
			{!! Form::submit($button, ['class' => 'btn btn-primary btn-xs']) !!}
		</div>	
	{!! Form::close() !!}
</div>