<?php

declare(strict_types=1);

namespace Remind\MatomoLinkHandler\LinkHandler;

use TYPO3\CMS\Core\LinkHandling\LinkHandlingInterface;

class LinkHandling implements LinkHandlingInterface
{
    protected string $baseUrn = 't3://matomo';

    /**
     * @param mixed[] $parameters
     */
    public function asString(array $parameters): string
    {
        return $this->baseUrn . '?action=' . $parameters['action'];
    }

    /**
     * @param mixed[] $data
     * @return mixed[]
     */
    public function resolveHandlerData(array $data): array
    {
        return [
            'action' => $data['action'] ?? '',
        ];
    }
}
