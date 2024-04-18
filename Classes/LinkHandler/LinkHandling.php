<?php

namespace Remind\MatomoLinkHandler\LinkHandler;

use TYPO3\CMS\Core\LinkHandling\LinkHandlingInterface;

class LinkHandling implements LinkHandlingInterface
{
    protected $baseUrn = 't3://matomo';

    public function asString(array $parameters): string
    {
        return $this->baseUrn . '?action=' . $parameters['action'];
    }

    public function resolveHandlerData(array $data): array
    {
        return [
            'action' => $data['action'] ?? '',
        ];
    }
}
