<?php
declare(strict_types=1);

namespace App\Application\Actions\Message;

use App\Application\Actions\Action;
use App\Repository\MessageRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ViewMessageAction extends Action
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

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $messageId = (int) $this->resolveArg('id');

        $message = $this->messageRepository->findOrFail($messageId);
        $this->logger->info("Message of id `${$messageId}` was viewed.");

        return $this->respondWithData($message);
    }
}
