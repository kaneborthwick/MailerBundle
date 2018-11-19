<?php

namespace PosPlugin\Actions;
use MailerBundle\Handler\TestHandler;

return [
	'routes' => [
		[
			'name' => 'emailer.test_email',
			'path' => '/emailer/test',
			'allowed_methods' => ['GET'],
			'middleware' => [
				TestHandler::class,
			],
		],
	],
];