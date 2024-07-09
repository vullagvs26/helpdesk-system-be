<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{

    protected $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function loadUsers()
    {
        $users = $this->user_repository->loadUsers();
    
        $dataStorage = [];
    
        foreach ($users as $user) {
            $dataStorage[] = [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'email' => $user->email, 
                'position' => $user->position,                           
            ];
         
        }
    
        return $dataStorage;
    }

    public function storeUser($data)
    {
        return $this->user_repository->storeUser($data);
    }

    public function showUser($id)
    {
        return $this->user_repository->showUser($id);
    }

    public function updateUser($id, $data)
    {
        return $this->user_repository->updateUser($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->user_repository->deleteUser($id);
    }


}