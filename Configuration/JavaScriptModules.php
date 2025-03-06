<?php

declare(strict_types=1);

return [
    'dependencies' => ['core', 'backend'],
    'imports' => [
        '@remind/matomo-link-handler/' => 'EXT:rmnd_matomo_link_handler/Resources/Public/JavaScript/',
    ],
    'tags' => [
        'backend.contextmenu',
    ],
];
