@extends('layouts.default')

@section('content')

	@include('layouts.partials.welcome-alert')

	<div id="main-feed" class="row">
		<div class="col-md-3">
			@include('users.partials.profile-section')
		</div>

		<div id="center-column" class="col-md-6">

			@include('layouts.partials.center-form', [
			'placeholder' => 'What\'s on your mind?', 
			'formType' => 'feed-form', 
			'button' => 'Publish', 
			'path' => 'feeds_path',
			'postingFeed' => true
			])

				<div class="feed-list" data-feedcount="{!! $feedsCount !!}">
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

		<div id="right-side-column" class="col-md-3">
			@include('friends.partials.friend-chat-list')
		</div>
	</div>	

@stop