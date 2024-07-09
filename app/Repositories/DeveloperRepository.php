<?php

namespace App\Repositories;

use App\Models\developer;

class DeveloperRepository {
    public $developer_model;

    public function __construct(Developer $developer_model) {
        $this->developer_model = $developer_model; 
    }
    
    public function loadDevelopers(){
        return $this->developer_model->all();
    } 
    
    public function storeDeveloper($data) {
        return $this->developer_model->create($data);
    }
    
    public function showDeveloper($id) {
        return $this->developer_model->where("id", $id)->get();
    }
    
    public function updateDeveloper($id, $data) {
        return $this->developer_model->where("id", $id)->update($data);
    }
    
    public function deleteDeveloper($id) {
        return $this->developer_model->where("id", $id)->delete();
    }
}
