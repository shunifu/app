<?php

return [
    'name' => 'Shunifu School App',
    'manifest' => [
        'name' => env('APP_NAME', 'Shunifu School App'),
        'short_name' => env('PWA_SHORT_NAME', 'Shunifu'),
        'start_url' => '/',
        'background_color' => '#FFFFFF',
        'theme_color' =>  env('PWA_THEME_COLOR', '#FFFFFF'),
        'display' => 'standalone',
        'orientation'=> 'any',
   
        'icons' => [
            '72x72' => [
                'path' => env('PWA_PATH_72'),
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' =>  env('PWA_PATH_96'),
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => env('PWA_PATH_128'),
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => env('PWA_PATH_144'),
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => env('PWA_PATH_152'),
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' =>env('PWA_PATH_192'),
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => env('PWA_PATH_384'),
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => config('PWA_PATH_512'),
                'purpose' => 'any'
            ],
        ],
      
        'shortcuts' => [
            [
                'name' => 'Marks',
                'description' => 'Shortcut',
                'url' => '/marks',
                'icons' => [
                    "src" => env('PWA_PATH_72'),
                    "purpose" => "any"
                ]
            ]
        ],
      
    ]
];
