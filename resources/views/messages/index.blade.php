@extends('layouts.default')

@section('content')

	<div class="row">
		<div class="col-md-3">
			@include('users.partials.profile-section')
		</div>
			<div id="center-column" class="col-md-6">
			<ul class="nav nav-pills" role="tablist">
				<li role="presentation" class="inactive"><h4>Inbox</h4></li>
				<li role="presentation" class="active pull-right"><a href="#">Total <span class="badge message-count">{!! $messages->total() !!}</span></a></li>						  
			</ul>				
			<div class="message-list">
			@if($messages->count())	
				
					@foreach($messages as $message)
						<div class="media listed-object-close">
							<div class="pull-left">		
								<img class="media-object avatar small-avatar" src="{!! $message->messageResponses()->first()->senderprofileimage  !!}" alt="{!! $message->messageResponses()->first()->sendername !!}">	
							</div>
							<div class="media-body">
								<p>

									 <a data-message-response-id="{!! $message->messageResponses()->first()->id !!}" class="open-message" href="{!! url('messages', $message->id) !!}">{!! $message->messageResponses()->first()->getMessageResponseSubject() !!}
								 		</a> 

									@if($message->messageResponses()->first()->wasSentByThisUser($user->id))

										<a data-message-id ="{!! $message->id !!}" class="delete-message" href="#"> <span class="glyphicon glyphicon-trash pull-right"></span></a>

								     	<a data-message-response-id="{!! $message->messageResponses()->first()->id !!}" class="open-message" href="{!! url('messages', $message->id) !!}"> <span class="text-muted glyphicon glyphicon-eye-open pull-right"></span></a>
								     	<span class="text-muted pull-right"> {!! $message->messageResponses()->first()->created_at->diffForHumans() !!}  </span>


									@elseif($message->messageResponses()->first()->hasBeenOpenedBy($user->id))

										<a data-message-id ="{!! $message->id !!}" class="delete-message" href="#"> <span class="glyphicon glyphicon-trash pull-right"></span></a>

								     	<a data-message-response-id="{!! $message->messageResponses()->first()->id !!}" class="open-message" href="{!! url('messages', $message->id) !!}"> <span class="text-muted glyphicon glyphicon-eye-open pull-right"></span></a>
								     	<span class="text-muted pull-right"> {!! $message->messageResponses()->first()->created_at->diffForHumans() !!}  </span>


								 


									@else

								     	<a data-message-id ="{!! $message->id !!}" class="delete-message" href="#"> <span class="glyphicon glyphicon-trash pull-right"></span></a>

								     	<a data-message-response-id="{!! $message->messageResponses()->first()->id !!}" class="open-message" href="{!! url('messages', $message->id) !!}"> <span class="glyphicon glyphicon-eye-open pull-right"></span></a>
								     	<span class="text-muted pull-right"> {!! $message->messageResponses()->first()->created_at->diffForHumans() !!}  </span>

							     	@endif 

							 	</p>								
							</div>
							</div>
					@endforeach
						<div class="paginator text-center">
						 	{!! $messages->render() !!}	
						</div>
				

			@else

				<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span> Your inbox is empty.</div>

			@endif			
			</div>
			</div>

		<div id="right-side-column" class="col-md-3">
			@include('friends.partials.friend-chat-list')
		</div>

	</div>

@stop