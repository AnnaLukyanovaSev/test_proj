<?php
return [
    'dashboard' => [
        'type' => 2,
        'description' => 'Admin panel',
    ],
    'user' => [
        'type' => 1,
        'description' => 'User',
        'ruleName' => 'userRole',
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Admin',
        'ruleName' => 'userRole',
        'children' => [
            'user',
        ],
    ],
];
