<?php

namespace App\Repository;

use App\Model\User;

class UserRepository extends BaseRepository
{
    public function createUser($firstName, $lastName, $username, $email, $phone, $password){
        return $this->create(
            [
                "first_name" => $firstName,
                "last_name" => $lastName,
                "username" => $username,
                "email" => $email,
                "phone" => $phone,
                "password" =>$password
            ]);
    }

    public function updateUser(Object $formData, $isId) {
        foreach($formData as $key => $value){
            $isId-> $key = $value;
        }
        $isId->save();
    }

    public function deleteUser($userId): int {
        return $this->destroy($userId);
    }

    public function findEmail($value) : ?User {
        return $this->findBy('email', $value);
    }

    public function findUsername($value) : ?User {
        return $this->findBy('username', $value);
    }

    public function findId($value) : ?User {
        return $this->findBy('id', $value);
    }
}