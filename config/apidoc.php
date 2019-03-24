<?php

return [

    /*
     * The output path for the generated documentation.
     */
    'output' => 'public/docs',

    /*
     * The router to be used (Laravel or Dingo).
     */
    'router' => 'laravel',

    /*
     * Generate a Postman collection in addition to HTML docs.
     */
    'postman' => [
        /*
         * Specify whether the Postman collection should be generated.
         */
        'enabled' => true,

        /*
         * The name for the exported Postman collection. Default: config('app.name')." API"
         */
        'name' => null,

        /*
         * The description for the exported Postman collection.
         */
        'description' => null,
    ],

    /*
     * The routes for which documentation should be generated.
     * Each group contains rules defining which routes should be included ('match', 'include' and 'exclude' sections)
     * and rules which should be applied to them ('apply' section).
     */
    'routes' => [
        [
            /*
             * Specify conditions to determine what routes will be parsed in this group.
             * A route must fulfill ALL conditions to pass.
             */
            'match' => [

                /*
                 * Match only routes whose domains match this pattern (use * as a wildcard to match any characters).
                 */
                'domains' => [
                    '*',
                    // 'domain1.*',
                ],

                /*
                 * Match only routes whose paths match this pattern (use * as a wildcard to match any characters).
                 */
                'prefixes' => [
                    'api/v1/*',
                    //'oauth/*'
                    // 'users/*',
                ],

                /*
                 * Match only routes registered under this version. This option is ignored for Laravel router.
                 * Note that wildcards are not supported.
                 */
                'versions' => [
                    'v1',
                ],
            ],

            /*
             * Include these routes when generating documentation,
             * even if they did not match the rules above.
             * Note that the route must be referenced by name here (wildcards are supported).
             */
            'include' => [
                // 'users.index', 'healthcheck*'
            ],

            /*
             * Exclude these routes when generating documentation,
             * even if they matched the rules above.
             * Note that the route must be referenced by name here (wildcards are supported).
             */
            'exclude' => [
                // 'users.create', 'admin.*'
            ],

            /*
             * Specify rules to be applied to all the routes in this group when generating documentation
             */
            'apply' => [
                /*
                 * Specify headers to be added to the example requests
                 */
                'headers' => [
                    'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQ0MjJkMzg2NTMxM2RkNmEwZGI1OTVmNjFiMDMyY2ZlYjEzMTU4ZmQwYzcyNTViNWM2MTllN2QwNDk4ZWEzMWE3NWY5YmVkYWE1NDEzZmUwIn0.eyJhdWQiOiIyIiwianRpIjoiNDQyMmQzODY1MzEzZGQ2YTBkYjU5NWY2MWIwMzJjZmViMTMxNThmZDBjNzI1NWI1YzYxOWU3ZDA0OThlYTMxYTc1ZjliZWRhYTU0MTNmZTAiLCJpYXQiOjE1NTMyNjQ0MjIsIm5iZiI6MTU1MzI2NDQyMiwiZXhwIjoxNTg0ODg2ODIyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.EwkFAqp48dT6l_0RA6b4MlyXzalaiaX7GX4SvJ-j92tkI60XW2U29JoxVH4f4LVnar31JvJ7rfOm0d63j3L7HoQAjAWz3AjrVzPDTnMTqmCUlR9jIenMLT1NBLwtsBKmrCuSzoxNJiZ1pqLfKXpr4PuSby7unOu5BqjZUKlGWsxg6mMHlhE4kxFYHi9xLNbd82-cSrzXZa5LQLahGRAP7HuxHW1DaMt9pWBpUEA7gFvKEAcJYqeT2ms2kBii6kI4e-HQYtmDgZ8KopJrXNAByRRU7bt2D9DHYJIwfLvzWgjGEEAjl0IZW51XDdimrTdSrVfOd6HJuxOY68spdOOFxzWoZcdxQsa7PuIW8ZYfQs9ZL2he4OAd93dFJawj1eoU0GHckquSduaqhGdHPzZ3Ln5LThX9E4AiLLaISArhVQGI_izelts4-nVrKjqmXkES_EMHoXARm-UzywAnGcCykZ3ABdqgZF8Yz2y17Al2pDx_GULpJT4bYzbm1iwLFxOYNuRwTxZ3quNO2u3bsFwQwVqGmQQxzhfHveSG1CiclYIb2FwEBbdnxwwodQPTDG84OWD2Nj1XAT88d-VKeReIH2beH3RAWWDWGcn2R-xDFS8cDQoZs9dKS-oIXa2ie2ktMWFpDYCLScpC2uLrndCtrq9OWtZunjEjNRN1iwpmSto',
                    // 'Api-Version' => 'v2',
                ],

                /*
                 * If no @response or @transformer declarations are found for the route,
                 * we'll try to get a sample response by attempting an API call.
                 * Configure the settings for the API call here,
                 */
                'response_calls' => [
                    /*
                     * API calls will be made only for routes in this group matching these HTTP methods (GET, POST, etc).
                     * List the methods here or use '*' to mean all methods. Leave empty to disable API calls.
                     */
                    'methods' => ['*'],

                    /*
                     * For URLs which have parameters (/users/{user}, /orders/{id?}),
                     * specify what values the parameters should be replaced with.
                     * Note that you must specify the full parameter, including curly brackets and question marks if any.
                     */
                    'bindings' => [
                        // '{user}' => 1
                    ],

                    /*
                     * Environment variables which should be set for the API call.
                     * This is a good place to ensure that notifications, emails
                     * and other external services are not triggered during the documentation API calls
                     */
                    'env' => [
                        'APP_ENV' => 'documentation',
                        'APP_DEBUG' => false,
                        // 'env_var' => 'value',
                    ],

                    /*
                     * Headers which should be sent with the API call.
                     */
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                        // 'key' => 'value',
                    ],

                    /*
                     * Cookies which should be sent with the API call.
                     */
                    'cookies' => [
                        // 'name' => 'value'
                    ],

                    /*
                     * Query parameters which should be sent with the API call.
                     */
                    'query' => [
                        // 'key' => 'value',
                    ],

                    /*
                     * Body parameters which should be sent with the API call.
                     */
                    'body' => [
                        // 'key' => 'value',
                    ],
                ],
            ],
        ],
    ],

    /*
     * Custom logo path. Will be copied during generate command. Set this to false to use the default logo.
     *
     * Change to an absolute path to use your custom logo. For example:
     * 'logo' => resource_path('views') . '/api/logo.png'
     *
     * If you want to use this, please be aware of the following rules:
     * - size: 230 x 52
     */
    'logo' => false,

    /*
     * Configure how responses are transformed using @transformer and @transformerCollection
     * Requires league/fractal package: composer require league/fractal
     *
     * If you are using a custom serializer with league/fractal,
     * you can specify it here.
     *
     * Serializers included with league/fractal:
     * - \League\Fractal\Serializer\ArraySerializer::class
     * - \League\Fractal\Serializer\DataArraySerializer::class
     * - \League\Fractal\Serializer\JsonApiSerializer::class
     *
     * Leave as null to use no serializer or return a simple JSON.
     */
    'fractal' => [
        'serializer' => null,
    ],
];
