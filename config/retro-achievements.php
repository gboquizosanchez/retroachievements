<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | RetroAchievements API Base URL
    |--------------------------------------------------------------------------
    |
    | This value is the base URL of the RetroAchievements API. This value is
    | used to make requests to the API.
    |
    */
    'base_url' => env('RA_BASE_URL', 'https://retroachievements.org/API'),

    'credentials' => [
        /*
        |--------------------------------------------------------------------------
        | RetroAchievements API Key
        |--------------------------------------------------------------------------
        |
        | This value is the API key provided by RetroAchievements.org. You can
        | get an API key by registering an account on the website and
        | generating a key in the settings page.
        |
        */
        'web_api_key' => env('RA_WEB_API_KEY', ''),

        /*
        |--------------------------------------------------------------------------
        | RetroAchievements Username
        |--------------------------------------------------------------------------
        |
        | This value is the username of the account you want to use to interact
        | with the RetroAchievements API.
        |
        | This value is required to use the API.
        |
        */
        'username' => env('RA_USERNAME', ''),
    ],
    'mapping' => [
        /*
        |--------------------------------------------------------------------------
        | Enable DTO Mapping
        |--------------------------------------------------------------------------
        |
        | This value determines if the package should map the DTOs to the
        | RetroAchievements API response. If this value is set to true, the
        | package will map the DTOs to the response. If this value is set to
        | false, the package will return the response as an array.
        |
        */
        'dto' => env('RA_DTO_MAPPING', true),

        /*
        |--------------------------------------------------------------------------
        | Enable Raw Properties
        |--------------------------------------------------------------------------
        | This value determines if the package should return the raw properties
        | when DTO mapping is disabled. If this value is set to true, the package
        | will return the raw properties instead of normalized.
        |
        | This value is only used when DTO mapping is disabled.
        */
        'raw_properties' => env('RA_RAW_PROPERTIES', false),
    ],
];
