<?php namespace Citco\Mailer;

use Illuminate\Support\ServiceProvider;
use Illuminate\Mail\MailServiceProvider as BaseMailServiceProvider;

class MailerServiceProvider extends BaseMailServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->publishes([
		    __DIR__.'/../../config/mailer.php' => config_path('mailer.php'),
		]);

		$this->app->singleton('mailer', function($app)
		{
			$this->registerSwiftMailer();

			// Once we have create the mailer instance, we will set a container instance
			// on the mailer. This allows us to resolve mailer classes via containers
			// for maximum testability on said classes instead of passing Closures.
			$mailer = new Mailer(
				$app['view'], $app['swift.mailer'], $app['events']
			);

			$this->setMailerDependencies($mailer, $app);

			// If a "from" address is set, we will set it on the mailer so that all mail
			// messages sent by the applications will utilize the same "from" address
			// on each one, which makes the developer's life a lot more convenient.
			$from = $app['config']['mail.from'];

			if (is_array($from) && isset($from['address']))
			{
				$mailer->alwaysFrom($from['address'], $from['name']);
			}

			$mailer->x_site_id = config('mailer.site_id');
			$mailer->sender_addr = array(config('mailer.noreply_address'), config('mailer.noreply_name'));
			$mailer->log_addr = array(config('mailer.log_address'), config('mailer.log_name'));
			$mailer->developer_addr = array(config('mailer.dev_address'), config('mailer.dev_name'));
			$mailer->return_path = config('mailer.return_path');
			$mailer->environment = $app->environment();

			return $mailer;
		});
	}
}
