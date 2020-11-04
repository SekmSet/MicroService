<?php


namespace App\Application\Actions\Message;

use App\Application\Actions\Action;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class updateMessageAction extends Action
{
    /**
     * @var MessageRepository
     */
    private $messageRepository;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    public function __construct(LoggerInterface $logger, MessageRepository $messageRepository, UserRepository $userRepository)
    {
        parent::__construct($logger);
        $this->messageRepository = $messageRepository;
        $this->userRepository = $userRepository;

    }
    protected function action(): Response
    {
        $messageId = (int) $this->resolveArg('id');
        $formData = $this->getFormData();

        $isId = $this->messageRepository->findId($messageId);
        $isUserS = $this->userRepository->findId($formData->id_userS);
        $isUserR = $this->userRepository->findId($formData->id_userR);

        $update = "";
        $errors = [];

        if($isUserS === null || $isUserR === null || $isId === null){
            $errors[] = "The sender or receiver or your message does not exist";
        } else {
            if( $this->messageRepository->updateMessage($formData, $isId)){
                $update = "Your message is now update";
            } else {
                $update = "Impossible to update your message";
            }
        }

        return $this->respondWithData([
            "errors" => $errors,
            "update" => $update,
            'message' => "You are one the route : update message in put"
        ]);
    }
}