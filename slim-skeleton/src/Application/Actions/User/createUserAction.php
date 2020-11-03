<?php

namespace App\Application\Actions\User;

use App\Application\Actions\Action;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;



class createUserAction extends Action
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(LoggerInterface $logger, UserRepository $userRepository, Request $request, Response $response)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
        $this->request = $request;
        $this->response = $response;
    }

    protected function action(): ResponseInterface
    {
        $formData = $this->getFormData();
        $errors = [];
        $newUser = "";

        $isEmail = $this->userRepository->findEmail($formData->email);
        $isUsername = $this->userRepository->findUsername($formData->username);

        if($isEmail !== null || $isUsername !== null ){
            $errors[] = "This email or username is used";
        } else {
          if($this->userRepository->createUser($formData->first_name, $formData->last_name, $formData->username, $formData->email, $formData->phone, $formData->password)){
              $newUser = "Your user account is created";
          } else {
              $newUser = "Impossible ti create your account";
          }
        }

        return $this->respondWithData([
            "newUser" => $newUser,
            "errors" => $errors,
            'datas' => $formData,
            'message' => "You are one the route : create user in post"
        ]);
    }
}