<?php

namespace App\Services;

use App\Repositories\SystemRepository;

class SystemService
{

    protected $system_repository;

    public function __construct(SystemRepository $system_repository)
    {
        $this->system_repository = $system_repository;
    }

    public function loadSystems()
    {
        $systems = $this->system_repository->loadSystems();
    
        $dataStorage = [];
    
        foreach ($systems as $system) {
            $dataStorage[] = [
                'id' => $system->id,
                'system_name' => $system->system_name,
                'published_at' => $system->published_at, 
                'developed_by' => $system->developed_by,  
                'description' => $system->description, 
                'status' => $system->status,                        
            ];
         
        }
    
        return $dataStorage;
    }

    public function storeSystem($data)
    {
        return $this->system_repository->storeSystem($data);
    }

    public function showSystem($id)
    {
        return $this->system_repository->showSystem($id);
    }

    public function updateSystem($id, $data)
    {
        return $this->system_repository->updateSystem($id, $data);
    }

    public function deleteSystem($id)
    {
        return $this->system_repository->deleteSystem($id);
    }


}