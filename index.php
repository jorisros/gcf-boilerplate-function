<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

\Google\CloudFunctions\FunctionsFramework::cloudEvent('executeEvent', 'executeEvent');

function executeEvent(\CloudEvents\V1\CloudEventInterface $event): void
{
    $container = require_once __DIR__ . '/config/dependency_injection.php';

    /** @var \JorisRos\GoogleCloudFunction\BoilerPlateWorker\GoogleFunction  $application */
    $application = $container->get('jorisros.gcf.googlefunction');
    $application->run();
}