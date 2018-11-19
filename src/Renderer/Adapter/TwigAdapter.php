<?php

namespace MailerBundle\Renderer\Adapter;

use Towersystems\Mailer\Model\EmailInterface;
use Towersystems\Mailer\Renderer\Adapter\AdapterInterface;
use Towersystems\Mailer\Renderer\RenderedEmail;
use Twig_Environment as TwigEnvironment;

/**
 *
 */
class TwigAdapter implements AdapterInterface {

	protected $twig;

	/**
	 * [__construct description]
	 * @param TwigEnvironment $twig [description]
	 */
	function __construct(TwigEnvironment $twig) {
		$this->twig = $twig;
	}

	/**
	 * {@inheritdoc}
	 */
	public function render(EmailInterface $email, array $data = []) {
		return $this->getRenderedEmail($email, $data);
	}

	/**
	 * [getRenderedEmail description]
	 * @param  [type] $email [description]
	 * @param  [type] $data  [description]
	 * @return [type]        [description]
	 */
	private function getRenderedEmail($email, $data) {
		$data = $this->twig->mergeGlobals($data);

		$template = $this->twig->loadTemplate($email->getTemplate());
		$subject = $template->renderBlock('subject', $data);
		$body = $template->renderBlock('body', $data);

		return new RenderedEmail($subject, $body);
	}
}