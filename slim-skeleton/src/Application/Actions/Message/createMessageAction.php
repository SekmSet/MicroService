<?php

namespace App\Application\Actions\Message;

use App\Application\Actions\Action;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class createMessageAction extends Action
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
        $formData = $this->getFormData();
        $errors = [];
        $newMessage = "";
        $result = null;

//        $isUserS = $this->request->getAttribute("token")->user_id;
        $isUserS = $this->userRepository->findId($formData->id_userS);
        $isUserR = $this->userRepository->findId($formData->id_userR);

        if($isUserS === null || $isUserR === null ){
            $errors[] = "The sender or receiver does not exist";
        } else {
            $result = $this->messageRepository->createMessage($formData->id_userS, $formData->id_userR, $formData->message);
            if($result){
                $newMessage = "Your message is send";
            } else {
                $newMessage = "Impossible to send your message";
            }
        }

        return $this->respondWithData([
            "newMessage" => $newMessage,
            "errors" => $errors,
            'datas' => $result,
            'message' => "You are one the route : create message in post"
        ]);
    }
}