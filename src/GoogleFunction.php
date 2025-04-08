<?php

namespace JorisRos\GoogleCloudFunction\BoilerPlateWorker;

use Monolog\Logger;

class GoogleFunction
{
    public function __construct(
        private Logger $logger,
        private string $name
    ){}

    public function run(): void
    {
        $this->logger->info("Running $this->name");

        try {
            /**
             * Add here your logic
             */
            throw new \Exception("error");
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
        }
    }
}