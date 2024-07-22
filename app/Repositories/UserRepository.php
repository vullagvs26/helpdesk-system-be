<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public $user_model;

    public function __construct(User $user_model) {
        $this->user_model = $user_model; 
    }

    public function loadUsers(){
        return $this->user_model->all();
    } 
    public function storeUser($data) {
        return $this->user_model->create($data);
    }
    
    public function showUser($id) {
        return $this->user_model->where("id", $id)->get();
    }
}
