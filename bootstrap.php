<?php

use Core\Container;
use Core\Database;
use Core\App;

$container = new Container();

$container->bind("Core\Database", function () {
    include base_path('config.php');
    return new Database($config, $username, $password);
});

App::setContainer($container);
