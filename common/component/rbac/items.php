<?php

return [
    'supervisor' => [
        'type' => 1,
        'description' => 'Nazoratchi',
    ],
    'inspector' => [
        'type' => 1,
        'description' => 'Inspektor',
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Admin',
        'children' => [
            'supervisor',
            'inspector',
        ],
    ],
];
