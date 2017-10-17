<?php
use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\InputPinInterface;

use Statflo\Pingpong\Strategy;

class Application
{
    public static function start($configurationList = [])
    {
        if (!count($configurationList)) {
            return;
        }

        // Create a GPIO object
        $gpio = new GPIO();

        foreach ($configurationList as $config) {
            // Retrieve pin 18 and configure it as an input pin
            $pin = $gpio->getInputPin($config['pin']);

            // Configure interrupts for both rising and falling edges
            $pin->setEdge(InputPinInterface::EDGE_BOTH);

            // Create an interrupt watcher
            $interruptWatcher = $gpio->createWatcher();

            // Register a callback to be triggered on pin interrupts
            $interruptWatcher->register($pin, $config['callback']);
        }

        // Watch for interrupts, timeout after 5000ms (5 seconds)
        while ($interruptWatcher->watch(5000));
    }
}

(new Application)->start([
    [
        'pin'      => 18,
        'callback' => function (InputPinInterface $pin, $value) {
            (new Strategy\Executor)->execute($pin);

            return true;
        }
    ],
    [
        'pin'      => 19,
        'callback' => function (InputPinInterface $pin, $value) {
            (new Strategy\Executor)->execute($pin);

            return true;
        }
    ],
    [
        'pin'      => 20,
        'callback' => function (InputPinInterface $pin, $value) {
            (new Strategy\Executor)->execute($pin);

            return true;
        }
    ]
]);
