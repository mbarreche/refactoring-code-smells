<p>Message for all subscribers</p>
<?php
/** @var CodelyTv\FeatureFlagsInmutable $flags */
if ($flags->get(\CodelyTv\Flags::NEW_SUBSCRIPTION_PAGE_NAME)): ?>
    <p>Additional message for subscribers with active flag</p>
<?php endif; ?>
