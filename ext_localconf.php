<?php

declare(strict_types=1);

use Remind\MatomoLinkHandler\LinkHandler\LinkBuilder;
use Remind\MatomoLinkHandler\LinkHandler\LinkHandling;

defined('TYPO3') or die;

(function () {
    $GLOBALS['TYPO3_CONF_VARS']['FE']['typolinkBuilder']['matomo'] = LinkBuilder::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['linkHandler']['matomo'] = LinkHandling::class;
})();
