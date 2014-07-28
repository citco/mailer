<?php namespace Citco\Mailer;

class Mailer extends \Illuminate\Mail\Mailer {

	/**
	 * Application environment.
	 *
	 * @var string
	 */
	public $environment;

	/**
	 * The is the X-Site-ID that will be added to the email header.
	 *
	 * @var string
	 */
	public $x_site_id;

	/**
	 * The default sender email address.
	 *
	 * @var string
	 */
	public $sender_addr;

	/**
	 * A BCC of all emails are sent to this email address.
	 *
	 * @var string
	 */
	public $log_addr;

	/**
	 * All emails will be sent to this email address on non-production env.
	 *
	 * @var string
	 */
	public $developer_addr;

	/**
	 * Send a Swift Message instance.
	 *
	 * @param  \Swift_Message  $message
	 * @return int
	 */
	protected function sendSwiftMessage($message)
	{
		$from = $message->getFrom();
		if (empty($from))
		{
			list($sender_addr, $sender_name) = $this->sender_addr;
			empty($sender_addr) OR $message->setFrom($sender_addr, $sender_name);
		}

		list($log_addr, $log_name) = $this->log_addr;
		empty($log_addr) OR $message->setBcc($log_addr, $log_name);

		$to = $message->getTo();
		empty($to) OR $to = key($to);
		$headers = $message->getHeaders();
		$headers->addTextHeader('X-Site-ID', $this->x_site_id);
		$headers->addTextHeader('X-User-ID', base64_encode(gzcompress($to)));

		if (strcasecmp($this->environment, 'production') != 0)
		{
			list($dev_addr, $dev_name) = $this->developer_addr;
			$message->setTo($dev_addr, $dev_name);
		}

		parent::sendSwiftMessage($message);
	}
}
