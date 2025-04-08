<?php
declare(strict_types=1);

/**
 * Dependency Injection container setup to have the ease DI in your function
 *
 * This file sets up a lightweight Symfony service container for use in CLI scripts or small tools.
 * It includes support for environment variables via a .env file, configures Monolog logging
 * to stderr for better debugging during development
 *
 * Example usage to register a service:
 *
 * Requirements:
 *   composer require symfony/dependency-injection symfony/dotenv monolog/monolog
 */
$container = new \Symfony\Component\DependencyInjection\ContainerBuilder();

/**
 * For development purposes we can load a .env with the settings
 *
 * Example: You can now use it locally and the service $_ENV['NAME']
 */
if (file_exists('.env')) {
    $dotenv = new Symfony\Component\Dotenv\Dotenv();
    $dotenv->loadEnv('.env');
}

/**
 * Setup for the logger
 */
$container->register('monolog.formatter.json', \Monolog\Formatter\JsonFormatter::class);
$container->register('monolog.handler', \Monolog\Handler\StreamHandler::class)
    ->addArgument('php://stderr')
    ->addMethodCall('setFormatter', [$container->get('monolog.formatter.json')]);

/**
 * Overwrite default log behavior so it is pushed to the terminal while developing your code
 */
if ($_ENV['APP_ENV'] !== 'production') {
    $container->register('monolog.handler', \Monolog\Handler\StreamHandler::class)
        ->addArgument('php://stderr');
}

/**
 * Register the logger
 */
$container->register('monolog.logger', \Monolog\Logger::class)
    ->addArgument('google-function')
    ->addMethodCall('pushHandler', [$container->get('monolog.handler')]);

/**
 * Register the cloud function and inject the logger and an environment variable
 */
$container->register('jorisros.gcf.googlefunction', \JorisRos\GoogleCloudFunction\BoilerPlateWorker\GoogleFunction::class)
    ->addArgument($container->get('monolog.logger'))
    ->addArgument($_ENV['NAME'])
;

return $container;