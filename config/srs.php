<?php

return [
    'base_url' => env('SRS_BASE_URL', 'https://api-mahasiswa-srs.ut.ac.id/api-srs-mahasiswa'),
    'email' => env('SRS_EMAIL'),
    'password' => env('SRS_PASSWORD'),
    'endpoints' => [
        'login' => '/v1/auth',
        'tutorial' => '/v1/tutorial',
        'tutorial_tutor' => '/v1/tutorial',
    ]
];