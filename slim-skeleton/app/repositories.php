<?php
declare(strict_types=1);


use App\Model\Message;
use App\Model\User;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => function() {
            return new UserRepository(new User());
        },
        MessageRepository::class => function() {
            return new MessageRepository(new Message());
        },
    ]);
};
