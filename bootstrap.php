<?php

use Core\Database;
use Core\Authenticator;
use Core\Container;
use Core\App;

$container = new Container();

$container->bind(\Core\Database::class, function () {
    include base_path('config.php');
    return new Database($config, $username, $password);
});


$container->bind(\Core\Authenticator::class, function () {
    return new Authenticator();
});

App::setContainer($container);
