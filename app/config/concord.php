<?php

return [
    'modules' => [
        Modules\Core\Providers\ModuleServiceProvider::class => [
            'migrations' => true
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
