<?php

declare(strict_types=1);

namespace App;


use Baraja\PackageManager\PackageRegistrator;
use Nette\Configurator;

class Booting
{

	/**
	 * @return Configurator
	 */
	public static function boot(): Configurator
	{
		$configurator = new Configurator;

		$configurator->setDebugMode([
			'89.102.20.114', // Hostivar
		]);
		$configurator->enableTracy(__DIR__ . '/../log');

		$configurator->setTimeZone('Europe/Prague');
		$configurator->setTempDirectory(__DIR__ . '/../temp');

		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();

		$packageRegistrator = new PackageRegistrator(
			__DIR__ . '/../',
			__DIR__ . '/../temp'
		);

		$configurator
			->addConfig(__DIR__ . '/config/package.neon')
			->addConfig(__DIR__ . '/config/common.neon')
			->addConfig(__DIR__ . '/config/local.neon');

		$packageRegistrator->runAfterActions($configurator);

		return $configurator;
	}

	/**
	 * @return Configurator
	 */
	public static function bootForTests(): Configurator
	{
		$configurator = self::boot();
		\Tester\Environment::setup();

		return $configurator;
	}

}
