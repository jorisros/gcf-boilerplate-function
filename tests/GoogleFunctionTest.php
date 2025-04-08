<?php

namespace JorisRos\GoogleCloudFunction\BoilerPlateWorker;

use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class GoogleFunctionTest extends TestCase
{
    public function testRun()
    {
        $log = new Logger('test');
        $function = new GoogleFunction(
            $log,
            'test',
        );
        $function->run();

        $this->assertEquals("test", $log->getName());
    }
}
