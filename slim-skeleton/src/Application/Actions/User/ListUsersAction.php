<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Application\Actions\Action;
use App\Model\User;
use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ListUsersAction extends Action
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * ListUsersAction constructor.
     * @param LoggerInterface $logger
     * @param UserRepository $userRepository
     */
    public function __construct(LoggerInterface $logger, UserRepository $userRepository)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
    }

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $users = $this->userRepository->all();

        $this->logger->info("Users list was viewed.");

        return $this->respondWithData($users);
    }
}
