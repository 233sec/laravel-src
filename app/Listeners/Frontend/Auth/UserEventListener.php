<?php

namespace App\Listeners\Frontend\Auth;

/**
 * Class UserEventListener
 * @package App\Listeners\Frontend\Auth
 */
class UserEventListener
{

	/**
	 * @param $event
	 */
	public function onLoggedIn($event) {
		\Log::info('用户登入: ' . $event->user->name);
	}

	/**
	 * @param $event
	 */
	public function onLoggedOut($event) {
		\Log::info('用户登出: ' . $event->user->name);
	}

	/**
	 * @param $event
	 */
	public function onRegistered($event) {
		\Log::info('用户注册: ' . $event->user->name);
	}

	/**
	 * @param $event
	 */
	public function onConfirmed($event) {
		\Log::info('用户确认: ' . $event->user->name);
	}

	/**
	 * Register the listeners for the subscriber.
	 *
	 * @param  \Illuminate\Events\Dispatcher  $events
	 */
	public function subscribe($events)
	{
		$events->listen(
			\App\Events\Frontend\Auth\UserLoggedIn::class,
			'App\Listeners\Frontend\Auth\UserEventListener@onLoggedIn'
		);

		$events->listen(
			\App\Events\Frontend\Auth\UserLoggedOut::class,
			'App\Listeners\Frontend\Auth\UserEventListener@onLoggedOut'
		);

		$events->listen(
			\App\Events\Frontend\Auth\UserRegistered::class,
			'App\Listeners\Frontend\Auth\UserEventListener@onRegistered'
		);

		$events->listen(
			\App\Events\Frontend\Auth\UserConfirmed::class,
			'App\Listeners\Frontend\Auth\UserEventListener@onConfirmed'
		);
	}
}