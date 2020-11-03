<?php


namespace App\Application\Actions\Auth;


use App\Application\Actions\Action;
use App\Repository\UserRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use ReallySimpleJWT\Token;

class LoginAction extends Action
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    public function __construct(LoggerInterface $logger, UserRepository $userRepository, ContainerInterface $container)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
        $this->container = $container;
    }

    protected function action(): ResponseInterface
    {
        $formData = $this->getFormData();
        $user = $this->userRepository->findUsername($formData->username); // fetch user

        if($user === null || !password_verify($formData->password, $user->password)) {
            return $this->respondWithData(['error' => 'Impossible to connect']);
        }

        $userId = $user->id;
        $secret = $this->container->get('settings')['auth']['secret'];
        $expiration = time() + 3600;
        $issuer = 'localhost';

        $token =  Token::create($userId, $secret, $expiration, $issuer);

        return $this->respondWithData(['token' => $token]);
    }
}