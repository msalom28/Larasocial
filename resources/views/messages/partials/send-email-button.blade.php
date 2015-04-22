@if(Request::path() == 'messages/compose/'.$user->id)

	<a href="{!! url('users', $user->id) !!}" class="btn btn-primary btn-sm" role="button">Back</a>

@else

	<a href="{!! url('messages/compose', $user->id) !!}" class="btn btn-primary btn-sm" role="button">Message</a>						

@endif