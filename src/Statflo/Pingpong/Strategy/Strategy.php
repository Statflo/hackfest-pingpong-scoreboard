<?php

namespace Statflo\Pingpong\Strategy;

interface Strategy
{
    public function canHandle($value);

    public function handle($value);
}
