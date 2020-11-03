<?php

namespace App\Application\Actions\Message;

use App\Application\Actions\Action;
use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class deleteUserAction extends Action
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(LoggerInterface $logger, UserRepository $userRepository)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
    }

    protected function action(): Response
    {
        $userId = (int) $this->resolveArg('id');

        echo "You are one the route : delete user in delete $userId";
    }
}