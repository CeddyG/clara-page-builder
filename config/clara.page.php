<?php

/**
 * Default config values
 */
return [
    
    'route' => [
        'web' => [
            'middleware' => ['web']
        ],
        'web-admin' => [
            'prefix'    => 'admin',
            'middleware' => ['web', \CeddyG\ClaraSentinel\Http\Middleware\SentinelAccessMiddleware::class]
        ],
        'api' => [
            'prefix'    => 'api/admin',
            'middleware' => ['api', \CeddyG\ClaraSentinel\Http\Middleware\SentinelAccessMiddleware::class.':api']
        ]
    ],
    
    'slider' => [
        'aqua' => [
            'provide'               => 'slider', 
            'slider-id'             => 'aqua',
            'slider-orientation'    => 'horizontal',
            'slider-ticks'          => '[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]',
            'slider-ticks-labels'   => '[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]',
            'slider-min'            => '1',
            'slider-max'            => '12',
            'slider-step'           => '1',
        ],
        'purple' => [
            'provide'               => 'slider', 
            'slider-id'             => 'purple',
            'slider-orientation'    => 'horizontal',
            'slider-ticks'          => '[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]',
            'slider-ticks-labels'   => '[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]',
            'slider-min'            => '1',
            'slider-max'            => '12',
            'slider-step'           => '1',
        ]
    ]
    
];
