<?php
namespace App\Logging;

use Monolog\Formatter\JsonFormatter;
use Monolog\Logger;

class AppLogFormatter
{
    /**
     * Customize the given Monolog instance.
     *
     * @param  \Monolog\Logger  $monolog
     * @return void
     */
    public function __invoke($monolog)
    {
        $jsonFormatter = new JsonFormatter();
        $introspectionProcessor = new \Monolog\Processor\IntrospectionProcessor(
            Logger::DEBUG,
            [],
            4
        );

        foreach ($monolog->getHandlers() as $handler) {
            $handler->setFormatter($jsonFormatter);
            $handler->pushProcessor($introspectionProcessor);
        }
    }
}
