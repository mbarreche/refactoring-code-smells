<?php

declare(strict_types=1);

namespace CodelyTv\Persistence;

use CodelyTv\FeatureFlagsInmutable;
use CodelyTv\Flags;

final class MySqlConnection
{
    public function __construct(private FeatureFlagsInmutable $flags)
    {
    }

    public function persist(string $email, ?string $name = null): void
    {
        $subscription = ['email' => $email];

        $flag = $this->flags->get(Flags::NEW_SUBSCRIPTION_PAGE_NAME);
        if ($flag) {
            $subscription['name'] = $name;
        }

        echo json_encode($subscription) . PHP_EOL;
    }
}
