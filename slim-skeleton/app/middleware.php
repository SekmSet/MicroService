<?php
declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use Slim\App;

return function (App $app) {
    $app->add(SessionMiddleware::class);
    $app->add(new Tuupola\Middleware\JwtAuthentication([
        "secret" => $_ENV['AUTH_SECRET'],
        "path" => ["/users", "/messages"],
    ]));
};
