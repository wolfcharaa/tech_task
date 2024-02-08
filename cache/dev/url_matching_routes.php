<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/user' => [[['_route' => 'app_user_createuser', '_controller' => 'App\\Controller\\UserController::createUser'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/([^/]++)/user(?'
                    .'|(*:63)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        63 => [
            [['_route' => 'app_user_index', '_controller' => 'App\\Controller\\UserController::index'], ['user'], ['GET' => 0], null, false, false, null],
            [['_route' => 'app_user_updateuser', '_controller' => 'App\\Controller\\UserController::updateUser'], ['user'], ['PUT' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
