<?php

declare(strict_types=1);

namespace CodelyTv;

use CodelyTv\Application\Subscribe;
use CodelyTv\Email\EmailNotifier;
use CodelyTv\Persistence\MySqlConnection;
use Symfony\Component\HttpFoundation\Request;

final class SubscribeController
{
    public function __construct(private Debug $debug)
    {

    }

    public function __invoke(Request $request)
    {
        $flags = $this->getFeatures($request, $this->debug);
        $subscribeUseCase = new Subscribe(
            new MySqlConnection($flags),
            $flags,
            new EmailNotifier($flags)
        );

        $subscribeUseCase->__invoke(
            $request->request->get('email'),
            $request->request->get('name'),
        );
    }

    private function getFeatures(Request $request, Debug $debug): FeatureFlagsInmutable
    {
        $result = new FeatureFlagsInmutable();
        if ($debug->isDebugModeEnabled()) {
            return $result;
        }

        $flagHeader = $request->headers->get('X-FLAG');
        if ($flagHeader === Flags::NEW_SUBSCRIPTION_PAGE_TOKEN) {
            return new FeatureFlagsInmutable(['new_subscription_page' => true]);
        }
        return $result;
    }
}
