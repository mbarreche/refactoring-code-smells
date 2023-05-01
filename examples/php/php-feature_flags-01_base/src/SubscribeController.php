<?php

declare(strict_types=1);

namespace CodelyTv;

use CodelyTv\Application\Subscribe;
use CodelyTv\Email\EmailNotifier;
use CodelyTv\Persistence\MySqlConnection;
use Symfony\Component\HttpFoundation\Request;

final class SubscribeController
{
    public function __invoke(Request $request)
    {
        $subscribeUseCase = new Subscribe(
            MySqlConnection::instance(),
            $this->getFeatures($request),
            EmailNotifier::instance()
        );

        $subscribeUseCase->__invoke(
            $request->request->get('email'),
            $request->request->get('name'),
        );
    }

    private function getFeatures(Request $request): FeatureFlags
    {
        $flagHeader = $request->headers->get('X-FLAG');
        $features = FeatureFlags::instance();
        if ($flagHeader === Flags::NEW_SUBSCRIPTION_PAGE_TOKEN) {
            $features->set('new_subscription_page', true);
        }
        if (Debug::instance()->isDebugModeEnabled()) {
            $features->deactivateAll();
        }
        return $features;
    }
}
