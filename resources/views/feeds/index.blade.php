@extends('layouts.default')

@section('content')

	@include('layouts.partials.welcome-alert')

	<div class="row">
		<div class="col-md-3">
			This is the profile section
		</div>

		<div id="center-column" class="row col-md-6">

			@include('layouts.partials.center-form', [
			'placeholder' => 'What\'s on your mind?', 
			'formType' => 'feed-form', 
			'button' => 'Publish', 
			'path' => 'feeds_path',
			'sendingMessage' => false
			])

				<div class="row feed-list" data-feedcount="{!! $feedsCount !!}">
				<div id="loader"></div>

					@if($feeds->count())

						@foreach($feeds as $feed)

							@include('feeds.partials.feed-list')

						@endforeach
					@else
						<div class="alert alert-info no-feeds-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span> You haven't posted anything yet.
						</div>
						
					@endif

				</div>

		</div>

		<div class="col-md-3">
			This is the Chat with friends section
		</div>
	</div>	

@stop