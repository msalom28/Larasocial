<div id="feedid{!! $feed->id !!}" class="media listed-object">
	<div class="pull-left">

		<img class="media-object avatar medium-avatar" src="{!! $feed->user->profileimage !!}" alt="{!! $feed->user->firstname !!}">
		
	</div>
	<div class="media-body">
		<h4 class="media-heading">{!! $feed->user->firstname !!}</h4>
		<p>{!! $feed->created_at->diffForHumans() !!}</p>
		{!! $feed->body !!}
				
	</div>					
</div>