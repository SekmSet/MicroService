<?php

namespace App\Application\Actions\Message;

use App\Application\Actions\Action;
use App\Repository\MessageRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class deleteMessageAction extends Action
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
        $messageId = (int) $this->resolveArg('id');
        $errors = [];
        $delete = null;

        $isId = $this->messageRepository->findId($messageId);

        if( $isId === null ){
            $errors[] = "Impossible to delete your message";
        } else {
            if( $this->messageRepository->deleteMessage($messageId) > 0){
                $delete[] = "Your message is deleted";
            } else {
                $delete[] = "Impossible to delete message your message";
            }
        }

        return $this->respondWithData([
            "errors" => $errors,
            "delete" => $delete,
            'message' => "You are one the route : delete message in delete"
        ]);
    }
}