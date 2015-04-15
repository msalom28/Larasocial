@extends('layouts.default')

@section('content')

	<div class="row">
		<div class="col-md-3">
			This is the profile section
		</div>

		<div id="center-column" class="col-md-6">
		
				<div class="row feed-list">
				

					@if($feeds->count())

						@foreach($feeds as $feed)

							@include('feeds.partials.feed-list')

						@endforeach

						<div class="paginator text-center">
						 	{!! $feeds->render() !!}	
						</div>
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