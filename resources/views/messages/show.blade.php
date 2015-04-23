@extends('layouts.default')

@section('content')

	<div class="row">
		<div class="col-md-3">
			@include('users.partials.profile-section')
		</div>
			<div id="center-column" class="col-md-6">

			@if($message->count())

				<ul class="nav nav-pills" role="tablist">
				  <li role="presentation"class="active pull-right"><a href="/messages"><span class="glyphicon glyphicon-menu-left"></span> Back</a></li>
				</ul>

				<div class="message-response-list">

					@foreach($message->MessageResponses as $messageResponse)

						@if(Auth::user()->is($messageResponse->senderid))

							<div class="media listed-object-close">
						
								<div class="pull-left">		
									<img class="media-object avatar small-avatar" src="{!! $messageResponse->senderprofileimage  !!}" alt="{!! $messageResponse->sendername !!}">	
								</div>

								<div class="media-body">
									<p>	
										<span class="text-muted">{!! $messageResponse->created_at->diffForHumans() !!} you wrote:</span>
										<a href="#"><span class="glyphicon glyphicon-chevron-down pull-right expand-message"></span></a>
									</p>
									<div class="message-body">
									 
									 	{!! $messageResponse->body !!}

									</div>							
								</div>
							</div>

						@else

							<div class="media listed-object-close">
							
								<div class="pull-left">		
									<img class="media-object avatar small-avatar" src="{!! $messageResponse->senderprofileimage  !!}" alt="{!! $messageResponse->sendername !!}">	
								</div>

								<div class="media-body">
									<p>	
										<span class="text-muted">{!! $messageResponse->created_at->diffForHumans() !!} {!! $messageResponse->sendername !!} wrote:</span>
										<a href="#"><span class="glyphicon glyphicon-chevron-down pull-right expand-message"></span></a>
									</p>
									<div class="message-body">
									 
									 	{!! $messageResponse->body !!}

									</div>							
								</div>
							</div>
							
						@endif

						

					@endforeach

				@include('layouts.partials.center-form', [
							
							'placeholder' => 'Write a reply..', 
							'formType' => 'message-response-form', 
							'button' => 'Submit', 
							'path' => 'message_responses_path',
							'messageResponseId' => $message->messageResponses()->first()->id,
							'messageId' => $message->id,
							'receiverId' => $message->messageResponses()->first()->senderid,
							'senderId' => $user->id,
							'senderProfileImage' => $user->profileimage,
							'senderName' => $user->firstname,
							'sendingResponseMessage' => true
					])

				
						
				</div>										
				

				@else

					<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span> Your inbox is empty.</div>

				@endif		

			</div>

		<div id="right-side-column" class="col-md-3">
			@include('friends.partials.friend-chat-list')
		</div>

	</div>

@stop