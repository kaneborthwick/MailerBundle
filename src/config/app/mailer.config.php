<?php

return [
	'mailer' => [
		'test_email' => [
			'subject' => 'Test Email',
			'template' => '@email/test.html.twig',
			'enabled' => true,
			'sender' => [
				'name' => 'Tower Advantage Link',
				'address' => 'subs@towersystems.com.au',
			],
		],
	],
];