<?php

return [
    'dependencies' => ['core', 'backend'],
    'tags' => [
        'backend.contextmenu',
    ],
    'imports' => [
        '@remind/matomo-link-handler/' => 'EXT:rmnd_matomo_link_handler/Resources/Public/JavaScript/',
    ],
];
