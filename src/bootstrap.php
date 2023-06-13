<?php

use Core\App;
use Core\Container;
use Core\Database;
use Services\NewsApiService;

$container = new Container();

$container->bind('Core\Database', function () {
    $config = require base_path('config.php');

    return (
        new Database(
            $config['database']
        )
    )->connection;
});

$container->bind('Services\NewsApiService', function () {
    $config = require base_path('config.php');

    return (
        new NewsApiService(
            $config['newsapi']
        )
    );
});

App::setContainer($container);