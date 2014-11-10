<?php namespace Citco\Mailer;

use Illuminate\Support\ServiceProvider;
use Illuminate\Mail\MailServiceProvider as BaseMailServiceProvider;

class MailerServiceProvider extends BaseMailServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;


	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->package('citco/mailer');

		$me = $this;

		$this->app->bindShared('mailer', function($app) use ($me)
		{
			$me->registerSwiftMailer();

			// Once we have create the mailer instance, we will set a container instance
			// on the mailer. This allows us to resolve mailer classes via containers
			// for maximum testability on said classes instead of passing Closures.
			$mailer = new Mailer($app['view'], $app['swift.mailer']);

			$mailer->setLogger($app['log'])->setQueue($app['queue']);

			$mailer->setContainer($app);

			// If a "from" address is set, we will set it on the mailer so that all mail
			// messages sent by the applications will utilize the same "from" address
			// on each one, which makes the developer's life a lot more convenient.
			$from = $app['config']['mail.from'];

			if (is_array($from) && isset($from['address']))
			{
				$mailer->alwaysFrom($from['address'], $from['name']);
			}

			$mailer->environment = $app->environment();

			$mailer->x_site_id = $app['config']->get('mailer::site.id');
			$mailer->sender_addr = array($app['config']->get('mailer::noreply.address'), $app['config']->get('mailer::noreply.name'));
			$mailer->log_addr = array($app['config']->get('mailer::log.address'), $app['config']->get('mailer::log.name'));
			$mailer->developer_addr = array($app['config']->get('mailer::dev.address'), $app['config']->get('mailer::dev.name'));
			$mailer->return_path = $app['config']->get('mailer::return.path');

			// Here we will determine if the mailer should be in "pretend" mode for this
			// environment, which will simply write out e-mail to the logs instead of
			// sending it over the web, which is useful for local dev environments.
			$pretend = $app['config']->get('mail.pretend', false);

			$mailer->pretend($pretend);

			return $mailer;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
