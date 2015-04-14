@extends('layouts.default')

@section('content')

	<div class="row">
		<div class="col-md-3">

			users profile section
			
		</div>

		<div id="center-column" class="row col-md-6">

			@if($users->count())
				{{-- <div class="friend-request-list"> --}}
				<div class="users-list">

					@foreach($users as $user)

						{{-- <div class="media friend-request-media"> --}}
						<div class="media listed-object-close">
							<div class="pull-left">		
								<a href="#"><img class="media-object avatar medium-avatar" src="{!! $user->profileimage !!}" alt="{!! $user->firstname !!}"></a>		
							</div>
							<div class="media-body">
								<a href="#"><h4 class="media-heading">{!! $user->firstname !!}</h4></a>								
								<div class="pull-right">																							
									<a href="#" data-method="post" data-userid="{!! $user->id!!}" class="btn btn-primary friend-request-button btn-sm" role="button">Add friend</a>																
								</div>		
							</div>
						</div>
					@endforeach
				</div>
					<div class="paginator text-center">
						 {!! $users->render() !!}	
					</div>
			@else

				<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span> No users were found.</div>

			@endif
		
				

		</div>

		<div class="col-md-3">
			chat with friends panel
		</div>
	</div>
	

@stop