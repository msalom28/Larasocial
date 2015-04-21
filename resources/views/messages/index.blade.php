@extends('layouts.default')

@section('content')

	<div class="row">
		<div class="col-md-3">
			This is the profile section
		</div>
			<div id="center-column" class="row col-md-6">
				<div class="row">
					<ul class="nav nav-pills" role="tablist">
						<li role="presentation" class="inactive"><h4>Inbox</h4></li>
						<li role="presentation" class="active pull-right"><a href="#">Total <span class="badge message-count">{!! $messages->total() !!}</span></a></li>						  
					</ul>
				</div>

			@if($messages->count())

				<div class="row message-list">
					@foreach($messages as $message)
						<div class="media listed-object-close">
							<div class="pull-left">		
								<a href="#"><img class="media-object avatar small-avatar" src="{!! $message->MessageResponses()->first()->senderprofileimage  !!}" alt="{!! $message->MessageResponses()->first()->sendername !!}"></a>		
							</div>
							<div class="media-body">
								<p>
								    <a data-message-response-id="{!! $message->messageResponses()->first()->id !!}" class="open-message" href="#">{!! $message->MessageResponses()->first()->getMessageResponseSubject() !!}
							 		</a> 
							     	<a data-message-id ="{!! $message->id !!}" class="delete-message" href="#"><span class="glyphicon glyphicon-trash pull-right"></span></a>

							     	<a data-message-response-id="{!! $message->messageResponses()->first()->id !!}" class="open-message" href="#"><span class="glyphicon glyphicon-eye-open pull-right"></span></a>
							     	<span class="text-muted pull-right"> {!! $message->messageResponses()->first()->created_at->diffForHumans() !!} </span> 

							 	</p>								
							</div>
						</div>
					@endforeach
						<div class="text-center">
						 	{!! $messages->render() !!}	
						</div>

			@else

				<div class="row	alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span> Your inbox is empty.</div>

			@endif			

			</div>

		<div class="col-md-3">
			This is the Chat with friends section
		</div>
	</div>	

@stop