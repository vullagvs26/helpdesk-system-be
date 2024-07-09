<?php

namespace App\Repositories;

use App\Models\System;

class SystemRepository {
    public $system_model;

    public function __construct(System $system_model) {
        $this->system_model = $system_model; 
    }
    
    public function loadSystems(){
        return $this->system_model->all();
    } 
    
    public function storeSystem($data) {
        return $this->system_model->create($data);
    }
    
    public function showSystem($id) {
        return $this->system_model->where("id", $id)->get();
    }
    
    public function updateSystem($id, $data) {
        return $this->system_model->where("id", $id)->update($data);
    }
    
    public function deleteSystem($id) {
        return $this->system_model->where("id", $id)->delete();
    }
}
