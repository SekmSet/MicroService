<?php


namespace App\Application\Actions\User;

use App\Application\Actions\Action;
use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class updateUserAction extends Action
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
        $formData = $this->getFormData();
        $isId = $this->userRepository->findId($userId);

        $errors = [];
        $update = null;

        if($isId === null){
            $errors[] = "This user does not exist";
        } else {
            if( $this->userRepository->updateUser($formData, $isId)){
                $update = "Your account is now update";
            } else {
                $update = "Impossible to update your account";
            }
        }

        return $this->respondWithData([
            "errors" => $errors,
            "update" => $update,
            'message' => "You are one the route : update user in update $userId"
        ]);
    }
}