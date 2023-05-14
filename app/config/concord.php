<?php

return [
    'modules' => [
        Modules\Core\Providers\ModuleServiceProvider::class => [
            'migrations' => false,
            'routes' => false
        ],
        Konekt\AppShell\Providers\ModuleServiceProvider::class => [
            'migrations' => true,
            'ui' => [
                'name' => 'Vanilo',
                'url' => '/admin'
            ]
        ],
    ]
];
