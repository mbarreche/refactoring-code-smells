<?php

declare(strict_types=1);

namespace CodelyTv;

final class Debug
{
    public function __construct(private bool $debugMode)
    {
    }

    public function isDebugModeEnabled(): bool
    {
        return $this->debugMode;
    }
}
