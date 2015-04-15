<?php namespace App\Providers;

use App\Events\UserWasRegistered;
use App\Events\FriendRequestWasSent;
use App\Handlers\Events\EmailRegistrationConfirmation;
use App\Handlers\Events\EmailFriendRequest;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
	
		UserWasRegistered::class => [

			EmailRegistrationConfirmation::class,
		],

		FriendRequestWasSent::class => [

			EmailFriendRequest::class,
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
