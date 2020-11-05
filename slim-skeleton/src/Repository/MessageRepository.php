<?php

namespace App\Repository;

use App\Model\Message;
use Illuminate\Database\Eloquent\Model;

class MessageRepository extends BaseRepository
{
    public function createMessage($id_userS, $id_userR, $message){
        return $this->create(
            [
                "id_userS" => $id_userS,
                "id_userR" => $id_userR,
                "message" => $message,
            ]);
    }
    public function updateMessage(Object $formData, Message $isId) {
        foreach($formData as $key => $value){
            $isId-> $key = $value;
        }
        return $isId->save();
    }
    public function deleteMessage($messageId): int {
        return $this->destroy($messageId);
    }
    public function findId($value) : ?Message {
        return $this->findBy('id', $value);
    }
    public function findIdS($value) : ?Message {
        return $this->findBy('id_userS', $value);
    }
    public function findIdR($value) : ?Message {
        return $this->findBy('id_userR', $value);
    }

    /**
     * @param $id
     * @return Model
     */
    public function findMessageByIdWithSenderAndReceiver($id): ?Model
    {
        return $this->model->with('sender')->with('receiver')->findOrFail($id);
    }
}