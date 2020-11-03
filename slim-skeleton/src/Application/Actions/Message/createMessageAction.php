<?php

namespace App\Application\Actions\Message;

use App\Application\Actions\Action;
use App\Repository\MessageRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class createMessageAction extends Action
{
    /**
     * @var MessageRepository
     */
    private $messageRepository;

    public function __construct(LoggerInterface $logger, MessageRepository $messageRepository)
    {
        parent::__construct($logger);
        $this->messageRepository = $messageRepository;
    }

    protected function action(): Response
    {
        echo "You are one the route : create message in post";
    }
}