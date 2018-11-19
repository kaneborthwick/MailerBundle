<?php

namespace MailerBundle\Sender\Adapter;

use Towersystems\Mailer\Model\EmailInterface;
use Towersystems\Mailer\Renderer\RenderedEmail;
use Towersystems\Mailer\Sender\Adapter\AdapterInterface;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

class ZendMailAdapter implements AdapterInterface {

	/**
	 * [$transport description]
	 * @var [type]
	 */
	protected $transport;

	/**
	 * [__construct description]
	 */
	public function __construct() {

		$transport = new SmtpTransport();

		$options = new SmtpOptions(array(
			/* removed */
		));

		$transport->setOptions($options);
		$this->transport = $transport;
	}

	/**
	 * {@inheritdoc}
	 */
	public function send(
		array $recipients,
		$senderAddress,
		$senderName,
		RenderedEmail $renderedEmail,
		EmailInterface $email,
		array $data,
		array $attachments = [],
		array $bbc = [],
		array $cc = []
	) {

		$mail = (new Message())
			->setSubject($renderedEmail->getSubject())
			->setFrom($senderAddress, $senderName)
			->addBcc($bcc)
			->addCC($cc)
			->setTo($recipients);

		$bodyPart = new \Zend\Mime\Message();
		$bodyMessage = new \Zend\Mime\Part($renderedEmail->getBody());
		$bodyMessage->type = 'text/html';

		$bodyPart->setParts(array($bodyMessage));
		$mail->setBody($bodyPart);
		$mail->setEncoding('UTF-8');

		$this->transport->send($mail);
	}

}