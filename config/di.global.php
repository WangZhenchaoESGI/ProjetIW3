<?php

use \Models\Users;
use \Controller\UsersController;
use \Controller\PagesController;
use \Controller\AdminController;
use \Controller\CaptchaController;
use \VO\DbDriver;
use \VO\DbHost;
use \VO\DbName;
use \VO\DbUser;
use \VO\DbPwd;

/*
return [
    Users::class => function($container) {
        return new Users($container['config']['db']);
    },
    UsersController::class => function($container) {
        $usersModel = $container[Users::class]($container);
        return new UsersController($usersModel);
    },
    PagesController::class => function($container) {
        return new PagesController();
    },
    AdminController::class => function($container) {
        $usersModel = $container[Users::class]($container);
        return new AdminController($usersModel);
    },
];*/

return [
    DbDriver::class =>function($container) {
    return new DbDriver($container['config']['db']['driver']);
    },
    DbHost::class =>function($container) {
        return new DbHost($container['config']['db']['dbhost']);
    },
    DbName::class =>function($container) {
        return new DbName($container['config']['db']['dbname']);
    },
    DbUser::class =>function($container) {
        return new DbUser($container['config']['db']['dbuser']);
    },
    DbPwd::class =>function($container) {
        return new DbPwd($container['config']['db']['dbpwd']);
    },
    Users::class => function($container) {
        return new Users($container['config']['db']);
    },
    UsersController::class => function($container) {
        $usersModel = $container[Users::class]($container);
        return new UsersController($usersModel);
    },
    PagesController::class => function($container) {
        return new PagesController();
    },
    AdminController::class => function($container) {
        $usersModel = $container[Users::class]($container);
        return new AdminController($usersModel);
    },
    CaptchaController::class => function($container) {
        return new CaptchaController();
    },
];