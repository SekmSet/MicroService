<?php
declare(strict_types=1);

use App\Application\Actions\Message\createMessageAction;
use App\Application\Actions\Message\deleteMessageAction;
use App\Application\Actions\User\deleteUserAction;
use App\Application\Actions\Message\ListMessagesAction;
use App\Application\Actions\Message\updateMessageAction;
use App\Application\Actions\User\createUserAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\Message\ViewMessageAction;
use App\Application\Actions\User\updateUserAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
        $group->post('', createUserAction::class);
        $group->delete('/{id}', deleteUserAction::class);
        $group->put('/{id}', updateUserAction::class);
    });

    $app->group('/messages', function (Group $group) {
        $group->get('', ListMessagesAction::class);
        $group->get('/{id}', ViewMessageAction::class);
        $group->post('', createMessageAction::class);
        $group->delete('/{id}', deleteMessageAction::class);
        $group->put('/{id}', updateMessageAction::class);
    });
};
