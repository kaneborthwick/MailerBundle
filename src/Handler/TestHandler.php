<?php

namespace MailerBundle\Handler;

use Psr\Http\Server\MiddlewareInterface;
use Towersystems\Mailer\Sender\SenderInterface;

class TestHandler implements MiddlewareInterface {

	/**
	 * [$emailSender description]
	 * @var [type]
	 */
	protected $emailSender;

	/**
	 * [__construct description]
	 * @param [type] $container [description]
	 * @param [type] $config    [description]
	 */
	public function __construct(
		SenderInterface $emailSender
	) {
		$this->emailSender = $emailSender;
	}

	/**
	 * {@iheritdoc}
	 */
	public function process(
		\Psr\Http\Message\ServerRequestInterface $request,
		\Psr\Http\Server\RequestHandlerInterface $handler)
	: \Psr\Http\Message\ResponseInterface{

		$this->emailSender->send('unsubscription_email', ['junwei@towersystems.com.au']);
		echo "done";die;
	}

}