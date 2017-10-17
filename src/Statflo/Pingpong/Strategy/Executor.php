<?php

namespace Statflo\Pingpong\Strategy;

class Executor
{
    private $strategyList = [];

    public function __construct()
    {
        $this->$strategyList = [
            Blue::class,
            Red::class,
            Reset::class,
        ];
    }

    public function execute($value)
    {
        foreach ($this->strategyList as $strategy)
        {
            if (!$result = (new $strategy)->handle($value)) {
                continue;
            }

            return $result;
        }
    }
}
