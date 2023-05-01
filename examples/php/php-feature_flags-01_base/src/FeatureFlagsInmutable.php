<?php

namespace CodelyTv;

class FeatureFlagsInmutable
{
    public function __construct(private array $flags)
    {
    }

    public function get(string $flagName): bool
    {
        if (!array_key_exists($flagName, $this->flags)) {
            return false;
        }

        return $this->flags[$flagName];
    }
}
