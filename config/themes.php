<?php

return [
    'default' => 'default',

    'themes' => [
        'default' => [
            'views_path' => 'resources/themes/default/views',
            'assets_path' => 'public/themes/default/assets',
            'name' => 'Default'
        ],

         'mamash' => [
             'views_path' => 'resources/themes/mamash/views',
             'assets_path' => 'public/themes/mamash/assets',
             'name' => 'Mamash',
             'parent' => 'default'
         ]
    ]
];