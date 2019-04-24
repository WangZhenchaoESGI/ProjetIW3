<?php

return [
    \Models\Users::class => function($container) {
        return new \Models\Users($container['config']['db']);
    },
    \Controller\UsersController::class => function($container) {
        $usersModel = $container[\Models\Users::class]($container);
        return new \Controller\UsersController($usersModel);
    },
    \Controller\PagesController::class => function($container) {
        return new \Controller\PagesController();
    },
    \Controller\AdminController::class => function($container) {
        $usersModel = $container[\Models\Users::class]($container);
        return new \Controller\AdminController($usersModel);
    },
];