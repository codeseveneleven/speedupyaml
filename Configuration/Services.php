<?php

use EKD\EkdBaseLibrary\Backend\TCA\HeaderIcons;
use EKD\EkdBaseLibrary\EventHandlers\FontawesomeCollectionHandler;
use EKD\EkdBaseLibrary\EventHandlers\GlobalRegistryFontCollectionHandler;
use EKD\EkdBaseLibrary\EventHandlers\ModifyLoginFormViewEventHandler;
use EKD\EkdBaseLibrary\Events\VideoRendererViewEvent;
use EKD\EkdBaseLibrary\Service\RegisterFontIconCollectionService;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator, ContainerBuilder $containerBuilder): void {
	$services = $containerConfigurator->services();
	$services->defaults()
	         ->public()
	         ->autowire()
	         ->autoconfigure();

	$services->load('Code711\\Speedupyaml\\', __DIR__ . '/../Classes/')
	         ->exclude([
		         __DIR__ . '/../Classes/Domain/Model/',
	         ]);

};
