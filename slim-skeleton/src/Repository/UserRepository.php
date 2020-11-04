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
                "password" => password_hash($password, PASSWORD_BCRYPT, ["cost" => 12])
            ]);
    }

    public function updateUser(Object $formData, User $isId) {
        foreach($formData as $key => $value){
            if($key === "password"){
                $value = password_hash($value, PASSWORD_BCRYPT, ["cost" => 12]);
            }
            $isId-> $key = $value;
        }
        return $isId->save();
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

    public function findUser($username, $password) : ?User {
        return $this->model->where('username',$username)->where('password',$password)->first();
    }
}