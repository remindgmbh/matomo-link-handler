<?php

declare(strict_types=1);

namespace Remind\MatomoLinkHandler\LinkHandler;

use TYPO3\CMS\Frontend\Typolink\AbstractTypolinkBuilder;
use TYPO3\CMS\Frontend\Typolink\LinkResult;
use TYPO3\CMS\Frontend\Typolink\LinkResultInterface;

class LinkBuilder extends AbstractTypolinkBuilder
{
    private const TYPE_MATOMO = 'matomo';

    public function build(
        array &$linkDetails,
        string $linkText,
        string $target,
        array $conf,
    ): LinkResultInterface {
        $action = $linkDetails['action'];
        $url = 't3://matomo?action=' . $action;

        return (new LinkResult(self::TYPE_MATOMO, $url))
            ->withTarget($target)
            ->withLinkConfiguration($conf)
            ->withLinkText($linkText);
    }
}
