<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

require_once 'index.php';

$localEvent = new \CloudEvents\V1\CloudEvent(
    "1",
    "local",
    "local",
    [
        "message" => [
            "data" => base64_encode(json_encode([
                "orderId" => "1db05ad0938b4fa3ac88d9e15152fb80"
            ]))
        ]
    ]
);

executeEvent($localEvent);