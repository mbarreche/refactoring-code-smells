<?php

declare(strict_types=1);

namespace CodelyTv\Email;

use CodelyTv\FeatureFlagsInmutable;

final class EmailNotifier
{
    public function __construct(private FeatureFlagsInmutable $flags)
    {
    }

    public function sendSubscriptionEmail(string $to)
    {
        $flags = $this->flags;
        echo "Email sent to $to";
        require __DIR__ . '/subscription-email.php';
    }
}
