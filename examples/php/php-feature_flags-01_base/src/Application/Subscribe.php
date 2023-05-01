<?php

declare(strict_types=1);

namespace CodelyTv\Application;

use CodelyTv\Debug;
use CodelyTv\Email\EmailNotifier;
use CodelyTv\FeatureFlags;
use CodelyTv\Flags;
use CodelyTv\Persistence\MySqlConnection;

final class Subscribe
{
    public function __construct(private MySqlConnection $connection, private FeatureFlags $featureFlags, private EmailNotifier $emailNotifier) {

    }

    public function __invoke(string $email, ?string $name = null): void
    {
        $flag = $this->featureFlags->get(Flags::NEW_SUBSCRIPTION_PAGE_NAME);

        if ($flag) {
            // The new subscription added a "name" field
            $this->connection->persist($email, $name);
        } else {
            $this->connection->persist($email);
        }

        $this->emailNotifier->sendSubscriptionEmail($email);
    }
}
