<?php

declare(strict_types=1);

namespace App\Presenters;


use Nette\Application\BadRequestException;
use Nette\Application\Request;

class Error4xxPresenter extends BasePresenter
{

	/**
	 * @throws BadRequestException
	 */
	public function startup(): void
	{
		parent::startup();

		if ($this->getRequest() !== null && !$this->getRequest()->isMethod(Request::FORWARD)) {
			$this->error();
		}
	}

	/**
	 * @param BadRequestException $exception
	 */
	public function renderDefault(BadRequestException $exception): void
	{
		$file = __DIR__ . '/templates/Error/' . $exception->getCode() . '.latte';
		$file = is_file($file) ? $file : __DIR__ . '/templates/Error/4xx.latte';
		$this->template->setFile($file);
		$this->template->error = $exception->getMessage();
	}

}
