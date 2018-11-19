<?php

use MailerBundle\Handler\TestHandler;
use MailerBundle\Provider\EmailProviderFactory;
use MailerBundle\Renderer\Adapter\TwigAdapter;
use MailerBundle\Sender\Adapter\ZendMailAdapter;
use Towersystems\Mailer\Provider\EmailProvider;
use Towersystems\Mailer\Sender\Sender;
use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [
	ConfigAbstractFactory::class => [
		TestHandler::class => [
			'tower.mailer.sender',
		],
		TwigAdapter::class => [
			Twig_Environment::class,
		],
		Sender::class => [
			'tower.mailer.render.twig_adapter',
			'tower.mailer.sender.zend_adapter',
			'tower.mailer.email_provider',
		],
	],
	'dependencies' => [
		'factories' => [
			EmailProvider::class => EmailProviderFactory::class,
		],
		'invokables' => [
			ZendMailAdapter::class,
		],
		'aliases' => [
			'tower.mailer.render.twig_adapter' => TwigAdapter::class,
			'tower.mailer.sender.zend_adapter' => ZendMailAdapter::class,
			'tower.mailer.sender' => Sender::class,
			'tower.mailer.email_provider' => EmailProvider::class,
		],
	],
];