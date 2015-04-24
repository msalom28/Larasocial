<div class="chat-switch media">
	
	<h5 class="pull-left">Chat status:</h5>

	<div class="media-body">
		@if(Auth::user()->isAvailableToChat())

			<div class="pull-right chat-button"><input type="checkbox" name="chatStatus" checked data-size="mini"></div>

		@else

			<div class="pull-right chat-button"><input type="checkbox" name="chatStatus" unchecked data-size="mini"></div>				

		@endif
		
	</div>

</div>


<div id="friend-list">

	@if(Auth::user()->chatstatus)
	
	<div class="wrapper"></div>

	@else
		<div class="wrapper"></div>
		<div class="wrapper-2"></div>		
	@endif	
					

	@if(Auth::user()->friends()->count())		

		<div id="friend-side-list" class="list-group">

			@foreach(Auth::user()->friends()->get() as $friend)


					@if($friend->isAvailableToChat())

						@if($friend->isOnline())				
						
							<a id="chat-list-user-{!! $friend->id !!}" href="#" class="list-group-item side-list" data-userid = "{!! $friend->id !!}" data-profileimage="{!! $friend->profileimage !!}" data-firstname ="{!! $friend->firstname !!}">						

								<div class="media">

									<div class="pull-left">
								         <img class="media-object avatar small-avatar" src="{!! $friend->profileimage !!}" alt="{!! $friend->firstname !!}">        
								     </div>

								     <div class="media-body">						     	

								     		{!! $friend->firstname !!} <span class="glyphicon glyphicon-flash text-success"></span>
								     	
								     </div>
											
								</div>						
							</a>

						@else

							<a href="#" class="list-group-item side-list disabled" data-userid = "{!! $friend->id !!}">						
							
								<div class="media">

									<div class="pull-left">
								         <img class="media-object avatar small-avatar" src="{!! $friend->profileimage !!}" alt="{!! $friend->firstname !!}">        
								     </div>

								     <div class="media-body">						     	

								     		{!! $friend->firstname !!} <span class="glyphicon glyphicon-flash text-success"></span>
								     	
								     </div>
											
								</div>						
							</a>
							
						@endif						

					@else						
						
						<a href="#" class="list-group-item disabled" data-userid = "{!! $friend->id !!}">						
							
							<div class="media">

								<div class="pull-left">
							         <img class="media-object avatar small-avatar" src="{!! $friend->profileimage !!}" alt="{!! $friend->firstname !!}">        
							     </div>

							     <div class="media-body">						     	

							     		{!! $friend->firstname !!} <span class="glyphicon glyphicon-flash text-success"></span>
							     	
							     </div>
										
							</div>

						</a>					

					@endif				

			@endforeach
			
		</div>

	@else

		<div id="no-friend-chat-alert" class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span> You don't have any friends.</div>

	@endif
</div>