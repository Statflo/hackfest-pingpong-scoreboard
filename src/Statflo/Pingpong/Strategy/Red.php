<?php

namespace Statflo\Pingpong\Strategy;

class Red implements Strategy
{
    public function canHandle($value)
    {
        return ($value == 18);
    }

    public function handle($value)
    {
        if (!$this->canHandle($value)) {
            return false;
        }

        // UPDATE https://firebase.google.com/
        return true;
    }
}
