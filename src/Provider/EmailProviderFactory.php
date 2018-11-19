<?php

declare (strict_types = 1);

namespace MailerBundle\Provider;

use Interop\Container\ContainerInterface;
use Towersystems\Mailer\Factory\EmailFactory;
use Towersystems\Mailer\Provider\EmailProvider;

class EmailProviderFactory {
	function __invoke(ContainerInterface $container, $requestedName) {
		$config = $container->get("config");
		$mailerConfig = isset($config["mailer"]) ? $config["mailer"] : [];
		return new EmailProvider(new EmailFactory(), $mailerConfig);
	}
}
