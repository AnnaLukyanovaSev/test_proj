<?php
return [
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
