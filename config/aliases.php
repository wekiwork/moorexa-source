<?php

/**
 * @method ConfigurationSocketInterface configurationSocket
 * 
 * Build configuration socket setting
 * We are linking this method via ConfigurationSocketHandler
 * They read a class, and class a method that in turn pushes the return value the Lightroom\Adapter\Configuration\Environment class.
 * You can acess this configurations via env(string name, mixed value);
 */
$config->configurationSocket([
	'aliase'  => $socket->setClass(Lightroom\Core\BootCoreEngine::class)->setMethod('registerAliases'),
]);


// Application Aliases
$config->aliase([
    Moorexa\View\Engine::class => PATH_TO_EXTRA . '/view-engine.php',
]);